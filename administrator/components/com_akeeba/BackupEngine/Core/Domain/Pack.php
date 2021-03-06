<?php
/**
 * Akeeba Engine
 * The modular PHP5 site backup engine
 * @copyright Copyright (c)2006-2017 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU GPL version 3 or, at your option, any later version
 * @package   akeebaengine
 *
 */

namespace Akeeba\Engine\Core\Domain;

// Protection against direct access
defined('AKEEBAENGINE') or die();

use Akeeba\Engine\Archiver\BaseArchiver;
use Akeeba\Engine\Base\Part;
use Akeeba\Engine\Configuration;
use Akeeba\Engine\Factory;
use Akeeba\Engine\Platform;
use Psr\Log\LogLevel;

/* Windows system detection */
if (!defined('_AKEEBA_IS_WINDOWS'))
{
	if (function_exists('php_uname'))
	{
		define('_AKEEBA_IS_WINDOWS', stristr(php_uname(), 'windows'));
	}
	else
	{
		define('_AKEEBA_IS_WINDOWS', DIRECTORY_SEPARATOR == '\\');
	}
}

/**
 * Packing engine. Takes care of putting gathered files (the file list) into
 * an archive.
 */
class Pack extends Part
{
	/** @var array Directories left to be scanned */
	private $directory_list;

	/** @var array Files left to be put into the archive */
	private $file_list;

	/**
	 * Have we finished scanning all subdirectories of the current directory?
	 *
	 * @var   boolean
	 */
	private $done_subdir_scanning = false;

	/**
	 * Have we finished scanning all files of the current directory?
	 *
	 * @var   boolean
	 */
	private $done_file_scanning = true;

	/**
	 * Is the current directory completely excluded?
	 *
	 * @var boolean
	 */
	private $excluded_folder = false;

	/**
	 * Are the current directory's subdirectories excluded?
	 *
	 * @var boolean
	 */
	private $excluded_subdirectories = false;

	/**
	 * Are the current directory's files excluded?
	 *
	 * @var boolean
	 */
	private $excluded_files = false;

	/** @var   string  Path to add to scanned files */
	private $path_prefix;

	/** @var   string  Path to remove from scanned files */
	private $remove_path_prefix;

	/** @var   array   An array of root directories to scan */
	private $root_definitions = array();

	/** @var   integer  How many files have been processed in the current step */
	private $processed_files_counter;

	/** @var   string  Current directory being scanned */
	private $current_directory;

	/** @var   integer|null  The position in the file list scanning */
	private $getFiles_position = null;

	/** @var   integer|null  The position in the folder list scanning */
	private $getFolders_position = null;

	/** @var   string  Current root directory being processed */
	private $root = '[SITEROOT]';

	/** @var   integer  Total root directories to scan, used in percentage calculation */
	private $total_roots = 0;

	/** @var   integer  Total files to process */
	private $total_files = 0;

	/** @var   integer  Total files already processed */
	private $done_files = 0;

	/** @var   integer  Total folders to process */
	private $total_folders = 0;

	/** @var   integer  Total folders already processed */
	private $done_folders = 0;

	/**
	 * Public constructor of the class
	 *
	 * @return   Pack
	 */
	public function __construct()
	{
		parent::__construct();

		Factory::getLog()->log(LogLevel::DEBUG, __CLASS__ . " :: new instance");
	}

	/**
	 * Implements the _prepare() abstract method
	 *
	 * @return  void
	 */
	protected function _prepare()
	{
		Factory::getLog()->log(LogLevel::DEBUG, __CLASS__ . " :: Starting _prepare()");

		// Get a list of directories to include
		Factory::getLog()->log(LogLevel::DEBUG, __CLASS__ . " :: Getting directory inclusion filters");
		$filters = Factory::getFilters();
		$this->root_definitions = $filters->getInclusions('dir');

		$this->total_roots = count($this->root_definitions);

		// Add the mapping text file if there are external directories defined!
		if (count($this->root_definitions) > 1)
		{
			// The site's root is the last directory to be backed up. Um, no,
			// this is not what we need
			$temp = array_pop($this->root_definitions);
			array_unshift($this->root_definitions, $temp);

			// We add a README.txt file in our virtual directory...
			Factory::getLog()->log(LogLevel::DEBUG, "Creating README.txt in the EFF virtual folder");
			$virtualContents = <<<ENDVCONTENT
This directory contains directories above the web site's root you chose to
include in the backup set.  This file helps you figure out which directory
in the backup  set corresponds to  which directory in the  original site's
structure. You'll have to restore these files manually!


ENDVCONTENT;
			$registry = Factory::getConfiguration();
			$counter = 0;
			$effini = "[eff]\n";
			$vdir = trim($registry->get('akeeba.advanced.virtual_folder'), '/') . '/';
			foreach ($this->root_definitions as $dir)
			{
				$counter++;
				// Skip over the first filter, because it's the site's root
				if ($counter == 1)
				{
					continue;
				}
				$test = trim($dir[1]);
				if ($test == '/')
				{
					$counter--;
					continue;
				}
				$virtualContents .= $dir[1] . "\tis the backup of\t" . $dir[0] . "\n";

				$effini .= '"' . $dir[0] . '"="' . $vdir . $dir[1] . '"'."\n";
			}
			// Add the file to our archive

			$archiver = Factory::getArchiverEngine();
			if ($counter > 1)
			{
				$archiver->addVirtualFile('README.txt', $registry->get('akeeba.advanced.virtual_folder'), $virtualContents);
				$archiver->addVirtualFile('eff.ini', $this->installerSettings->installerroot, $effini);
			}
			else
			{
				Factory::getLog()->log(LogLevel::DEBUG, "README.txt was not created; all EFF directories are being backed up to the archive's root");
			}
		}

		// Find the site's root element and shift it into the directory list
		$dir_definition = array_shift($this->root_definitions);
		$count = 0;
		$max_dir_count = count($this->root_definitions);
		while (!is_null($dir_definition[1]) && ($count < $max_dir_count))
		{
			$count++;
			array_push($this->root_definitions, $dir_definition);
			$dir_definition = array_shift($this->root_definitions);
		}

		// Settling with whatever we have, let's put it to use, shall we?
		$this->remove_path_prefix = $dir_definition[0]; // Remove absolute path to directory when storing the file
		if (is_null($dir_definition[1]))
		{
			$this->path_prefix = ''; // No added path for main site
			if (empty($dir_definition[0]))
			{
				$this->root = '[SITEROOT]';
			}
			else
			{
				$this->root = $dir_definition[0];
			}
		}
		else
		{
			$dir_definition[1] = trim($dir_definition[1]);
			if (empty($dir_definition[1]) || $dir_definition[1] == '/')
			{
				$this->path_prefix = '';
			}
			else
			{
				$this->path_prefix = $registry->get('akeeba.advanced.virtual_folder') . '/' . $dir_definition[1];
			}
			$this->root = $dir_definition[0];
		}
		// Translate the root into an absolute path
		$stock_dirs = Platform::getInstance()->get_stock_directories();
		$absolute_dir = substr($this->root, 0);
		if (!empty($stock_dirs))
		{
			foreach ($stock_dirs as $key => $replacement)
			{
				$absolute_dir = str_replace($key, $replacement, $absolute_dir);
			}
		}
		$this->directory_list[] = $absolute_dir;
		$this->remove_path_prefix = $absolute_dir;
		$registry = Factory::getConfiguration();
		$registry->set('volatile.filesystem.current_root', $absolute_dir);

		$this->done_subdir_scanning = true;
		$this->done_file_scanning = true;
		$this->total_files = 0;
		$this->done_files = 0;
		$this->total_folders = 0;
		$this->done_folders = 0;

		$this->setState('prepared');

		Factory::getLog()->log(LogLevel::DEBUG, __CLASS__ . " :: prepared");
	}

	protected function _run()
	{
		if ($this->getState() == 'postrun')
		{
			Factory::getLog()->log(LogLevel::DEBUG, __CLASS__ . " :: Already finished");
			$this->setStep("-");
			$this->setSubstep("");

			return true;
		}

		// If I'm done scanning files and subdirectories and there are no more files to pack get the next
		// directory. This block is triggered in the first step in a new root.
		if (empty($this->file_list) && $this->done_subdir_scanning && $this->done_file_scanning)
		{
			$this->progressMarkFolderDone();

			if (!$this->getNextDirectory())
			{
				if ($this->getNextRoot())
				{
					if (!$this->getNextDirectory())
					{
						return true;
					}
				}
				else
				{
					return true;
				}
			}
		}

		/**
		 * Automated tests override
		 *
		 * If the file .akeeba_engine_automated_tests_error file is present in the site's root I will throw an error.
		 */
		list($root, $translated_root, $dir) = $this->getCleanDirectoryComponents();

		if (@file_exists($translated_root . '/.akeeba_engine_automated_tests_error'))
		{
			$this->setError("Akeeba Engine automated tests: I am throwing an error because the file .akeeba_engine_automated_tests_error is present in the site's root folder.");

			return false;
		}

		// If I'm not done scanning for files and the file list is empty then scan for more files
		if (!$this->done_file_scanning && empty($this->file_list))
		{
			$result = $this->scanFiles();
		}
		// If I have files left, pack them
		elseif (!empty($this->file_list))
		{
			$result = $this->pack_files();
		}
		// If I'm not done scanning subdirectories, go ahead and scan some more of them
		elseif (!$this->done_subdir_scanning)
		{
			$result = $this->scanSubdirs();
		}
		/**
		 * If we have excluded contained files or subdirectories BUT NOT the entire folder itself AND there are
		 * no files in this directory THEN add an empty directory to the archive.
		 **/
		elseif (
			($this->excluded_files || $this->excluded_subdirectories)
			&&
			!$this->excluded_folder
			&&
			empty($this->file_list)
		)
		{
			Factory::getLog()->log(LogLevel::INFO, "Empty directory " . $this->current_directory . ' (files and directories are filtered)');

			$archiver = Factory::getArchiverEngine();

			if ($this->current_directory != $this->remove_path_prefix)
			{
				$archiver->addFile($this->current_directory, $this->remove_path_prefix, $this->path_prefix);
			}

			// Error propagation
			$this->propagateFromObject($archiver);
		}

		// Do I have an error?
		if ($this->getError())
		{
			return false;
		}

		return true;
	}

	/**
	 * Implements the _finalize() abstract method
	 *
	 */
	protected function _finalize()
	{
		Factory::getLog()->log(LogLevel::INFO, "Finalizing archive");
		$archive = Factory::getArchiverEngine();
		$archive->finalize();
		// Error propagation
		$this->propagateFromObject($archive);
		if ($this->getError())
		{
			return false;
		}

		Factory::getLog()->log(LogLevel::DEBUG, "Archive is finalized");

		$this->setState('finished');
	}

	// ============================================================================================
	// PRIVATE METHODS
	// ============================================================================================

	/**
	 * Gets the next directory to scan from the stack. It also applies folder
	 * filters (directory exclusion, subdirectory exclusion, file exclusion),
	 * updating the operation toggle properties of the class.
	 *
	 * @return   boolean  True if we found a directory, false if the directory
	 *                    stack is empty. It also returns true if the folder is
	 *                    filtered (we are told to skip it)
	 */
	protected function getNextDirectory()
	{
		// Reset the file / folder scanning positions
		$this->getFiles_position = null;
		$this->getFolders_position = null;
		$this->done_file_scanning = false;
		$this->done_subdir_scanning = false;
		$this->excluded_folder = false;
		$this->excluded_subdirectories = false;
		$this->excluded_files = false;

		if (count($this->directory_list) == 0)
		{
			// No directories left to scan
			return false;
		}
		else
		{
			// Get and remove the last entry from the $directory_list array
			$this->current_directory = array_pop($this->directory_list);
			$this->setStep($this->current_directory);
			$this->processed_files_counter = 0;
		}

		list($root, $translated_root, $dir) = $this->getCleanDirectoryComponents();

		// Get a filters instance
		$filters = Factory::getFilters();

		// Apply DEF (directory exclusion filters)
		// Note: the !empty($dir) prevents the site's root from being filtered out
		if ($filters->isFiltered($dir, $root, 'dir', 'all') && !empty($dir))
		{
			Factory::getLog()->log(LogLevel::INFO, "Skipping directory " . $this->current_directory);
			$this->done_subdir_scanning = true;
			$this->done_file_scanning = true;
			$this->excluded_folder = true;

			return true;
		}

		// Apply Skip Contained Directories Filters
		if ($filters->isFiltered($dir, $root, 'dir', 'children'))
		{
			$this->excluded_subdirectories = true;

			Factory::getLog()->log(LogLevel::INFO, "Skipping subdirectories of directory " . $this->current_directory);

			$this->done_subdir_scanning = true;
		}

		// Apply Skipfiles
		if ($filters->isFiltered($dir, $root, 'dir', 'content'))
		{
			$this->excluded_files = true;

			Factory::getLog()->log(LogLevel::INFO, "Skipping files of directory " . $this->current_directory);

			$this->done_file_scanning = true;

			// When the files of a folder are skipped we will have to add some
			// files anyway if they are present. These are files used to
			// prevent direct access to the folder.

			// Try to find and include .htaccess and index.htm(l) files
			// # Fix 2.4: Do not add DIRECTORY_SEPARATOR if we are on the site's root and it's an empty string
			$ds = ($this->current_directory == '') || ($this->current_directory == '/') ? '' : DIRECTORY_SEPARATOR;
			$checkForTheseFiles = array(
				$this->current_directory . $ds . '.htaccess',
				$this->current_directory . $ds . 'web.config',
				$this->current_directory . $ds . 'index.html',
				$this->current_directory . $ds . 'index.htm',
				$this->current_directory . $ds . 'robots.txt'
			);
			$this->processed_files_counter = 0;

			foreach ($checkForTheseFiles as $fileName)
			{
				if (@file_exists($fileName))
				{
					// Fix 3.3 - We have to also put them through other filters, ahem!
					if (!$filters->isFiltered($fileName, $root, 'file', 'all'))
					{
						$this->file_list[] = $fileName;
						$this->processed_files_counter++;
					}
				}
			}
		}

		return true;
	}

	/**
	 * Try to add some files from the $file_list into the archive
	 *
	 * @return   boolean   True if there were files packed, false otherwise
	 *                     (empty filelist or fatal error)
	 */
	protected function pack_files()
	{
		// Get a reference to the archiver and the timer classes
		$archiver = Factory::getArchiverEngine();
		$timer = Factory::getTimer();
		$configuration = Factory::getConfiguration();

		// If post-processing after part creation is enabled, make sure we do post-process each part before moving on
		if ($configuration->get('engine.postproc.common.after_part', 0) && !empty($archiver->finishedPart))
		{
			if (self::postProcessDonePartFile($this, $archiver, $configuration))
			{
				return true;
			}
		}

		// If the archiver has work to do, make sure it finished up before continuing
		if ($configuration->get('volatile.engine.archiver.processingfile', false))
		{
			Factory::getLog()->log(LogLevel::DEBUG, "Continuing file packing from previous step");
			$result = $archiver->addFile('', '', '');
			$this->propagateFromObject($archiver);

			if ($this->getError())
			{
				return false;
			}

			// If that was the last step for packing this file, mark a file done
			if (!$configuration->get('volatile.engine.archiver.processingfile', false))
			{
				$this->progressMarkFileDone();
			}
		}

		// Did it finish, or does it have more work to do?
		if ($configuration->get('volatile.engine.archiver.processingfile', false))
		{
			// More work to do. Let's just tell our parent that we finished up successfully.
			return true;
		}

		// Normal file backup loop; we keep on processing the file list, packing files as we go.
		if (count($this->file_list) == 0)
		{
			// No files left to pack. Return true and let the engine loop
			$this->progressMarkFolderDone();

			return true;
		}
		else
		{
			Factory::getLog()->log(LogLevel::DEBUG, "Packing files");
			$packedSize = 0;
			$numberOfFiles = 0;

			list($usec, $sec) = explode(" ", microtime());
			$opStartTime = ((float)$usec + (float)$sec);

			$largeFileThreshold = Factory::getConfiguration()->get('engine.scan.common.largefile', 10485760);

			while ((count($this->file_list) > 0))
			{
				$file = @array_shift($this->file_list);
				$size = 0;
				if (file_exists($file))
				{
					$size = @filesize($file);
				}
				// Anticipatory file size algorithm
				if (($numberOfFiles > 0) && ($size > $largeFileThreshold))
				{
					if (!Factory::getConfiguration()->get('akeeba.tuning.nobreak.beforelargefile', 0))
					{
						// If the file is bigger than the big file threshold, break the step
						// to avoid potential timeouts
						$this->setBreakFlag();
						Factory::getLog()->log(LogLevel::INFO, "Breaking step _before_ large file: " . $file . " - size: " . $size);
						// Push the file back to the list.
						array_unshift($this->file_list, $file);

						// Return true and let the engine loop
						return true;
					}
				}

				// Proactive potential timeout detection
				// Rough estimation of packing speed in bytes per second
				list($usec, $sec) = explode(" ", microtime());

				$opEndTime = ((float)$usec + (float)$sec);

				if (($opEndTime - $opStartTime) == 0)
				{
					$_packSpeed = 0;
				}
				else
				{
					$_packSpeed = $packedSize / ($opEndTime - $opStartTime);
				}

				// Estimate required time to pack next file. If it's the first file of this operation,
				// do not impose any limitations.
				$_reqTime = ($_packSpeed - 0.01) <= 0 ? 0 : $size / $_packSpeed;

				// Do we have enough time?
				if ($timer->getTimeLeft() < $_reqTime)
				{
					if (!Factory::getConfiguration()->get('akeeba.tuning.nobreak.proactive', 0))
					{
						array_unshift($this->file_list, $file);
						Factory::getLog()->log(LogLevel::INFO, "Proactive step break - file: " . $file . " - size: " . $size . " - req. time " . sprintf('%2.2f', $_reqTime));
						$this->setBreakFlag();

						return true;
					}
				}

				$packedSize += $size;
				$numberOfFiles++;
				$ret = $archiver->addFile($file, $this->remove_path_prefix, $this->path_prefix);

				// If no more processing steps are required, mark a done file
				if (!$configuration->get('volatile.engine.archiver.processingfile', false))
				{
					$this->progressMarkFileDone();
				}

				// Error propagation
				$this->propagateFromObject($archiver);

				if ($this->getError())
				{
					return false;
				}

				// If this was the first file packed and we've already gone past
				// the large file size threshold break the step. Continuing with
				// more operations after packing such a big file is increasing
				// the risk to hit a timeout.
				if (($packedSize > $largeFileThreshold) && ($numberOfFiles == 1))
				{
					if (!Factory::getConfiguration()->get('akeeba.tuning.nobreak.afterlargefile', 0))
					{
						Factory::getLog()->log(LogLevel::INFO, "Breaking step *after* large file: " . $file . " - size: " . $size);
						$this->setBreakFlag();

						return true;
					}
				}

				// If we have to continue processing the file, break the file packing loop forcibly
				if ($configuration->get('volatile.engine.archiver.processingfile', false))
				{
					return true;
				}
			}

			// True if we have more files, false if we're done packing
			return (count($this->file_list) > 0);
		}
	}

	/**
	 * Implements the getProgress() percentage calculation based on how many
	 * roots we have fully backed up and how much of the current root we
	 * have backed up.
	 */
	public function getProgress()
	{
		if (empty($this->total_roots))
		{
			return 0;
		}

		// Get the overall percentage (based on databases fully dumped so far)
		$remaining_steps = count($this->root_definitions);
		$remaining_steps++;
		$overall = 1 - ($remaining_steps / $this->total_roots);

		// How much is this step worth?
		$this_max = 1 / $this->total_roots;

		// Get the percentage done of the current root. Hey, the calculation *is* dodgy, I know it!
		$local = 0;
		if ($this->total_files > 0)
		{
			$local += 0.05 * $this->done_files / $this->total_files;
		}
		if ($this->total_folders > 0)
		{
			$local += 0.95 * $this->done_folders / $this->total_folders;
		}

		$percentage = $overall + $local * $this_max;
		if ($percentage < 0)
		{
			$percentage = 0;
		}
		if ($percentage > 1)
		{
			$percentage = 1;
		}

		return $percentage;
	}

	protected function progressAddFile()
	{
		$this->total_files++;
	}

	protected function progressMarkFileDone()
	{
		$this->done_files++;
	}

	protected function progressAddFolder()
	{
		$this->total_folders++;
	}

	protected function progressMarkFolderDone()
	{
		$this->done_folders++;
	}

	/**
	 * Returns the site root, the translated site root and the translated current directory
	 *
	 * @return array
	 */
	protected function getCleanDirectoryComponents()
	{
		$fsUtils = Factory::getFilesystemTools();

		// Break directory components
		if (Factory::getConfiguration()->get('akeeba.platform.override_root', 0))
		{
			$siteroot = Factory::getConfiguration()->get('akeeba.platform.newroot', '[SITEROOT]');
		}
		else
		{
			$siteroot = '[SITEROOT]';
		}

		$root = $this->root;

		if ($this->root == $siteroot)
		{
			$translated_root = $fsUtils->translateStockDirs($siteroot, true);
		}
		else
		{
			$translated_root = $this->remove_path_prefix;
		}

		$dir = $fsUtils->TrimTrailingSlash($this->current_directory);

		if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN')
		{
			$translated_root = $fsUtils->TranslateWinPath($translated_root);
			$dir = $fsUtils->TranslateWinPath($dir);
		}

		if (substr($dir, 0, strlen($translated_root)) == $translated_root)
		{
			$dir = substr($dir, strlen($translated_root));
		}
		elseif (in_array(substr($translated_root, -1), array('/', '\\')))
		{
			$new_translated_root = rtrim($translated_root, '/\\');
			if (substr($dir, 0, strlen($new_translated_root)) == $new_translated_root)
			{
				$dir = substr($dir, strlen($new_translated_root));
			}
		}

		if (substr($dir, 0, 1) == '/')
		{
			$dir = substr($dir, 1);
		}

		return array($root, $translated_root, $dir);
	}

	/**
	 * Steps the subdirectory scanning of the current directory
	 *
	 * @return  boolean  True on success, false on fatal error
	 */
	protected function scanSubdirs()
	{
		$engine = Factory::getScanEngine();

		list($root, $translated_root, $dir) = $this->getCleanDirectoryComponents();

		// Get a filters instance
		$filters = Factory::getFilters();

		if (is_null($this->getFolders_position))
		{
			Factory::getLog()->log(LogLevel::INFO, "Scanning directories of " . $this->current_directory);
		}
		else
		{
			Factory::getLog()->log(LogLevel::INFO, "Resuming scanning directories of " . $this->current_directory);
		}

		// Get subdirectories
		$subdirectories = $engine->getFolders($this->current_directory, $this->getFolders_position);

		// Error propagation
		$this->propagateFromObject($engine);

		// If the list contains "too many" items, please break this step!
		if (Factory::getConfiguration()->get('volatile.breakflag', false))
		{
			// Log the step break decision, for debugging reasons
			Factory::getLog()->log(LogLevel::INFO, "Large directory " . $this->current_directory . " while scanning for subdirectories; I will resume scanning in next step.");

			// Return immediately, marking that we are not done yet!
			return true;
		}

		// Error control
		if ($this->getError())
		{
			return false;
		}

		// Start adding the subdirectories
		if (!empty($subdirectories) && is_array($subdirectories))
		{
			$dereferenceSymlinks = Factory::getConfiguration()->get('engine.archiver.common.dereference_symlinks');

			// If we have to treat symlinks as real directories just add everything
			if ($dereferenceSymlinks)
			{
				// Treat symlinks to directories as actual directories
				foreach ($subdirectories as $subdirectory)
				{
					$this->directory_list[] = $subdirectory;
					$this->progressAddFolder();
				}
			}
			// If we are told not to dereference symlinks we'll need to check each subdirectory thoroughly
			else
			{
				// Treat symlinks to directories as simple symlink files (ONLY WORKS WITH CERTAIN ARCHIVERS!)
				foreach ($subdirectories as $subdirectory)
				{
					if (is_link($subdirectory))
					{
						// Symlink detected; apply directory filters to it
						if (empty($dir))
						{
							$dirSlash = $dir;
						}
						else
						{
							$dirSlash = $dir . '/';
						}

						$check = $dirSlash . basename($subdirectory);
						Factory::getLog()->log(LogLevel::DEBUG, "Directory symlink detected: $check");

						if (_AKEEBA_IS_WINDOWS)
						{
							$check = Factory::getFilesystemTools()->TranslateWinPath($check);
						}

						// Do I need this? $dir contains a path relative to the root anyway...
						$check = ltrim(str_replace($translated_root, '', $check), '/');

						// Check for excluded symlinks (note that they are excluded as DIRECTORIES in the GUI)
						if ($filters->isFiltered($check, $root, 'dir', 'all'))
						{
							Factory::getLog()->log(LogLevel::INFO, "Skipping directory symlink " . $check);
						}
						else
						{
							Factory::getLog()->log(LogLevel::DEBUG, 'Adding folder symlink: ' . $check);
							$this->file_list[] = $subdirectory;
							$this->progressAddFile();
						}
					}
					else
					{
						$this->directory_list[] = $subdirectory;
						$this->progressAddFolder();
					}
				}
			}
		}

		// If the scanner nullified the next position to scan, we're done
		// scanning for subdirectories
		if (is_null($this->getFolders_position))
		{
			$this->done_subdir_scanning = true;
		}

		return true;
	}

	/**
	 * Steps the files scanning of the current directory
	 *
	 * @return  boolean  True on success, false on fatal error
	 */
	protected function scanFiles()
	{
		$engine = Factory::getScanEngine();

		list($root, $translated_root, $dir) = $this->getCleanDirectoryComponents();

		// Get a filters instance
		$filters = Factory::getFilters();

		if (is_null($this->getFiles_position))
		{
			Factory::getLog()->log(LogLevel::INFO, "Scanning files of " . $this->current_directory);
			$this->processed_files_counter = 0;
		}
		else
		{
			Factory::getLog()->log(LogLevel::INFO, "Resuming scanning files of " . $this->current_directory);
		}

		// Get file listing
		$fileList = $engine->getFiles($this->current_directory, $this->getFiles_position);

		// Error propagation
		$this->propagateFromObject($engine);

		// If the list contains "too many" items, please break this step!
		if (Factory::getConfiguration()->get('volatile.breakflag', false))
		{
			// Log the step break decision, for debugging reasons
			Factory::getLog()->log(LogLevel::INFO, "Large directory " . $this->current_directory . " while scanning for files; I will resume scanning in next step.");

			// Return immediately, marking that we are not done yet!
			return true;
		}

		// Error control
		if ($this->getError())
		{
			return false;
		}

		// Do I have an unreadable directory?
		if (($fileList === false))
		{
			$this->setWarning('Unreadable directory ' . $this->current_directory);

			$this->done_file_scanning = true;
		}
		// Directory was readable, process the file list
		else
		{
			if (is_array($fileList) && !empty($fileList))
			{
				// Add required trailing slash to $dir
				if (!empty($dir))
				{
					$dir .= '/';
				}

				// Scan all directory entries
				foreach ($fileList as $fileName)
				{
					$check = $dir . basename($fileName);

					if (_AKEEBA_IS_WINDOWS)
					{
						$check = Factory::getFilesystemTools()->TranslateWinPath($check);
					}

					// Do I need this? $dir contains a path relative to the root anyway...
					$check = ltrim(str_replace($translated_root, '', $check), '/');
					$byFilter = '';
					$skipThisFile = $filters->isFilteredExtended($check, $root, 'file', 'all', $byFilter);

					if ($skipThisFile)
					{
						Factory::getLog()->log(LogLevel::INFO, "Skipping file $fileName (filter: $byFilter)");
					}
					else
					{
						$this->file_list[] = $fileName;
						$this->processed_files_counter++;
						$this->progressAddFile();
					}
				}
			}
		}

		// If the scanner engine nullified the next position we are done
		// scanning for files
		if (is_null($this->getFiles_position))
		{
			$this->done_file_scanning = true;
		}

		// If the directory was genuinely empty we will have to add an empty
		// directory entry in the archive, otherwise this directory will never
		// be restored.
		if ($this->done_file_scanning && ($this->processed_files_counter == 0))
		{
			Factory::getLog()->log(LogLevel::INFO, "Empty directory " . $this->current_directory);

			$archiver = Factory::getArchiverEngine();

			if ($this->current_directory != $this->remove_path_prefix)
			{
				$archiver->addFile($this->current_directory, $this->remove_path_prefix, $this->path_prefix);
			}

			// Error propagation
			$this->propagateFromObject($archiver);

			// Check for errors
			if ($this->getError())
			{
				return false;
			}

			unset($archiver);
		}

		return true;
	}

	/**
	 * Try to determine the next root folder to scan
	 *
	 * @return  boolean  True if there was a new root to scan
	 */
	protected function getNextRoot()
	{
		// We have finished with our directory list. Hmm... Do we have extra directories?
		if (count($this->root_definitions) > 0)
		{
			Factory::getLog()->log(LogLevel::DEBUG, "More off-site directories detected");
			$registry = Factory::getConfiguration();
			$dir_definition = array_shift($this->root_definitions);

			$this->remove_path_prefix = $dir_definition[0]; // Remove absolute path to directory when storing the file

			if (is_null($dir_definition[1]))
			{
				$this->path_prefix = ''; // No added path for main site
			}
			else
			{
				$dir_definition[1] = trim($dir_definition[1]);

				if (empty($dir_definition[1]) || $dir_definition[1] == '/')
				{
					$this->path_prefix = '';
				}
				else
				{
					$this->path_prefix = $registry->get('akeeba.advanced.virtual_folder') . '/' . $dir_definition[1];
				}
			}

			$this->done_scanning = false; // Make sure we process this file list!
			$this->root = $dir_definition[0];

			// Translate the root into an absolute path
			$stock_dirs = Platform::getInstance()->get_stock_directories();
			$absolute_dir = substr($this->root, 0);

			if (!empty($stock_dirs))
			{
				foreach ($stock_dirs as $key => $replacement)
				{
					$absolute_dir = str_replace($key, $replacement, $absolute_dir);
				}
			}

			$this->directory_list[] = $absolute_dir;
			$this->remove_path_prefix = $absolute_dir;

			$registry->set('volatile.filesystem.current_root', $absolute_dir);

			$this->total_files = 0;
			$this->done_files = 0;
			$this->total_folders = 0;
			$this->done_folders = 0;

			Factory::getLog()->log(LogLevel::INFO, "Including new off-site directory to " . $dir_definition[1]);

			return true;
		}
		else
		// Nope, we are completely done!
		{
			$this->setState('postrun');

			return false;
		}
	}

	/**
	 * Immediate post-processing of a part file that's just been completed
	 *
	 * @param   Part           $domain         The backup domain object calling us
	 * @param   BaseArchiver   $archiver       The archiver engine
	 * @param   Configuration  $configuration  Reference to the Factory configuration object
	 *
	 * @return  bool
	 */
	public static function postProcessDonePartFile(Part $domain, BaseArchiver $archiver, Configuration $configuration)
	{
		$filename = array_shift($archiver->finishedPart);
		Factory::getLog()->log(LogLevel::INFO, 'Preparing to post process ' . basename($filename));

        $timer     = Factory::getTimer();
        $startTime = $timer->getRunningTime();
		$post_proc = Factory::getPostprocEngine();
		$result    = $post_proc->processPart($filename);
		$domain->propagateFromObject($post_proc);

		if ($result === false)
		{
			$domain->setWarning('Failed to process file ' . basename($filename));

			Factory::getLog()->log(LogLevel::WARNING, 'Error received from the post-processing engine:');
			Factory::getLog()->log(LogLevel::WARNING, implode("\n", array_merge($domain->getWarnings(), $domain->getErrors())));
		}
		elseif($result === true)
		{
			// Add this part's size to the volatile storage
			$volatileTotalSize = $configuration->get('volatile.engine.archiver.totalsize', 0);
			$volatileTotalSize += (int)@filesize($filename);
			$configuration->set('volatile.engine.archiver.totalsize', $volatileTotalSize);

			Factory::getLog()->log(LogLevel::INFO, 'Successfully processed file ' . basename($filename));
		}
        else
        {
            // More work required
            Factory::getLog()->log(LogLevel::INFO, 'More post-processing steps required for file ' . $filename);
            $configuration->set('volatile.postproc.filename', $filename);

            // Let's push back the file into the archiver stack
            array_unshift($archiver->finishedPart, $filename);

            // Do we need to break the step?
            $endTime  = $timer->getRunningTime();
            $stepTime = $endTime - $startTime;
            $timeLeft = $timer->getTimeLeft();

            if ($timeLeft < $stepTime)
            {
                // We predict that running yet another step would cause a timeout
                $configuration->set('volatile.breakflag', true);
            }
            else
            {
                // We have enough time to run yet another step
                $configuration->set('volatile.breakflag', false);
            }
        }

		// Should we delete the file afterwards?
		if (
			$configuration->get('engine.postproc.common.delete_after', false)
			&& $post_proc->allow_deletes
			&& ($result === true)
		)
		{
			Factory::getLog()->log(LogLevel::DEBUG, 'Deleting already processed file ' . basename($filename));
			Platform::getInstance()->unlink($filename);
		}
        else
        {
            Factory::getLog()->log(LogLevel::DEBUG, 'Not removing processed file ' . $filename);
        }

		if ($post_proc->break_after && ($result === true))
		{
			$configuration->set('volatile.breakflag', true);

			return true;
		}

		// This is required to let the backup continue even after a post-proc failure
		$domain->resetErrors();
		$domain->setState('running');

		return false;
	}
}