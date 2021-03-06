<?php
/**
 * @package Freestyle Joomla
 * @author Freestyle Joomla
 * @copyright (C) 2013 Freestyle Joomla
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

if (!defined("DS")) define('DS', DIRECTORY_SEPARATOR);

if (file_exists(JPATH_SITE.DS.'components'.DS.'com_fsf'.DS.'helper'.DS.'j3helper.php'))
{
	
	require_once( JPATH_SITE.DS.'components'.DS.'com_fsf'.DS.'helper'.DS.'j3helper.php' );

	jimport('joomla.application.component.helper');


	// Load the base adapter.
	require_once JPATH_ADMINISTRATOR . '/components/com_finder/helpers/indexer/adapter.php';

	class plgFinderFSF_FAQ extends FinderIndexerAdapter
	{
		protected $context = 'FSF_FAQ';

		protected $extension = 'com_fsf';

		protected $layout = 'faq';

		protected $type_title = 'FSF_FINDER_FSF_FAQ';

		protected $table = '#__fsf_faq_faq';

		public function __construct(&$subject, $config)
		{
			parent::__construct($subject, $config);
			$this->loadLanguage();
		}

		public function index(FinderIndexerResult $item, $format = 'html')
		{
			// Check if the extension is enabled
			if (JComponentHelper::isEnabled($this->extension) == false)
			{
				return;
			}

			$item->body = FinderIndexerHelper::prepareContent($item->getElement('body'));
			$item->summary = FinderIndexerHelper::prepareContent($item->getElement('body'));
			
			$item->addTaxonomy('Type', 'FSF_FINDER_FAQ');
			$item->url = 'index.php?option=com_fsf&view=faq&faqid=' . $item->getElement('id');
			
			$item->route = $item->url;
			$item->state = $item->getElement('pub');
			$item->access = 1;

			// Get content extras.
			FinderIndexerHelper::getContentExtras($item);

			// Index the item.
			if (FSFJ3Helper::IsJ3())
			{
				$this->indexer->index($item);
			} else {
				FinderIndexer::index($item);
			}
		}

		protected function setup()
		{
			return true;
		}

		protected function getListQuery($sql = null)
		{
			$db = JFactory::getDbo();
			// Check if we can use the supplied SQL query.
			$sql = $sql instanceof JDatabaseQuery ? $sql : $db->getQuery(true);
			$sql->select('a.id, a.question as title, a.question as alias, a.answer as body, a.published as pub, a.access, a.language');
			$sql->from('#__fsf_faq_faq AS a');
			
			return $sql;
		}
	}

}