<?php
defined('_JEXEC') or die('Restricted access');
/**
 * @package             Joomla
 * @subpackage          CoalaWeb Gears
 * @author              Steven Palmer
 * @author url          https://coalaweb.com
 * @author email        support@coalaweb.com
 * @license             GNU/GPL, see /assets/en-GB.license.txt
 * @copyright           Copyright (c) 2017 Steven Palmer All rights reserved.
 *
 * CoalaWeb Gears is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/gpl.html>.
 */
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
jimport('joomla.log.log');

class PlgSystemCwgearsInstallerScript { 

     /** @var string The extension's name */
    protected $_coalaweb_extension = 'cwgears';
    
    /** @var array Plugin that should activated automatically */
    private $cwActivatePlugins = array(
        'plugins' => array(
            'system' => array(
                'cwgears' => 1,
            )
        )
    );
    
    /**
     * Joomla! pre-flight event
     * 
     * @param string $type Installation type (install, update, discover_install)
     * @param JInstaller $parent Parent object
     */
    public function preflight($type, $parent) {
        // Only allow to install on Joomla! 3.6 or later with PHP 5.4 or later
        if (defined('PHP_VERSION')) {
            $version = PHP_VERSION;
        } elseif (function_exists('phpversion')) {
            $version = phpversion();
        } else {
            $version = '5.0.0'; // all bets are off!
        }

        if (!version_compare(JVERSION, '3.6', 'ge')) {
            $msg = "<p>Sorry, you need Joomla! 3.6 or later to install this extension!</p>";

            JLog::add($msg, JLog::WARNING, 'jerror');

            return false;
        }

        if (!version_compare($version, '5.4', 'ge')) {
            $msg = "<p>Sorry, you need PHP 5.4 or later to install this extension!</p>";

            JLog::add($msg, JLog::WARNING, 'jerror');

            return false;
        }
        
        // Workarounds for JInstaller bugs
        if ($type != 'discover_install') {
        }

        return true;
    }

      /**
     * Runs after install, update or discover_update
     * @param string $type install, update or discover_update
     * @param JInstaller $parent 
     */
    function postflight($type, $parent) {
        
        //Activate main plugin only on install
        if ($type == 'install') {       
            $this->_activatePlugin($parent);
        }
        
        // Show the post-installation page
        $this->_renderPostInstallation($parent);

    }
    
        /**
     * Runs on uninstallation
     * 
     * @param JInstaller $parent 
     */
    function uninstall($parent) {
        // Show the post-uninstallation page
        $this->_renderPostUninstallation($parent);
    }
    
    /**
     * Renders the post-installation message
     *
     * @param $parent
     */
    private function _renderPostInstallation($parent)
    {
        ?>

        <?php $rows = 1; ?>
        <style type="text/css">
            .coalaweb {
                font-family: "Trebuchet MS", Helvetica, sans-serif;
                font-size: 13px !important;
                font-weight: 400 !important;
                color: #4D4D4D;
                border: solid #ccc 1px;
                background: #fff;
                -moz-border-radius: 3px;
                -webkit-border-radius: 3px;
                border-radius: 3px;
                *border-collapse: collapse;
                border-spacing: 0;
                width: 100%;
                margin-bottom: 15px !important
            }

            .coalaweb tr:hover {
                background: #E8F6FE;
                -o-transition: all .1s ease-in-out;
                -webkit-transition: all .1s ease-in-out;
                -moz-transition: all .1s ease-in-out;
                -ms-transition: all .1s ease-in-out;
                transition: all .1s ease-in-out
            }

            .coalaweb tr.row1 {
                background-color: #F0F0EE
            }

            .coalaweb td, .coalaweb th {
                border-left: 1px solid #ccc;
                border-top: 1px solid #ccc;
                padding: 10px !important;
                text-align: left
            }

            .coalaweb th {
                border-top: none;
                color: #333 !important;
                text-shadow: 0 1px 1px #FFF;
                border-bottom: 4px solid #1272a5 !important
            }

            .coalaweb td:first-child, .coalaweb th:first-child {
                border-left: none
            }

            .coalaweb th:first-child {
                -moz-border-radius: 3px 0 0;
                -webkit-border-radius: 3px 0 0 0;
                border-radius: 3px 0 0 0
            }

            .coalaweb th:last-child {
                -moz-border-radius: 0 3px 0 0;
                -webkit-border-radius: 0 3px 0 0;
                border-radius: 0 3px 0 0
            }

            .coalaweb th:only-child {
                -moz-border-radius: 6px 6px 0 0;
                -webkit-border-radius: 6px 6px 0 0;
                border-radius: 6px 6px 0 0
            }

            .coalaweb tr:last-child td:first-child {
                -moz-border-radius: 0 0 0 3px;
                -webkit-border-radius: 0 0 0 3px;
                border-radius: 0 0 0 3px
            }

            .coalaweb tr:last-child td:last-child {
                -moz-border-radius: 0 0 3px;
                -webkit-border-radius: 0 0 3px 0;
                border-radius: 0 0 3px 0
            }

            .coalaweb em, .coalaweb strong {
                color: #1272A5;
                font-weight: 700
            }
        </style>
        <link rel="stylesheet" href="../media/coalaweb/components/generic/css/com-coalaweb-base-v2.css" type="text/css">
        <div class="well well-lg">
            <h3>
                <?php echo JText::_('PLG_CWGEARS_POST_INSTALL_TITLE'); ?>
            </h3>
            <div class="alert alert-danger">
                <?php echo JText::_('PLG_CWGEARS_POST_INSTALL_MSG'); ?>
            </div>
            <h3>
                <?php echo JText::_('PLG_CWGEARS_INSTALL_DETAILS_TITLE'); ?>
            </h3>

            <table class="coalaweb">
                <thead align="left">
                <tr>
                    <th class="title" align="left">Main</th>
                    <th width="25%">Status</th>
                </tr>
                </thead>
                <tbody>
                <tr class="row0">
                    <td class="key">
                        <?php echo JText::_('PLG_CWGEARS_TITLE_CORE'); ?>
                    </td>
                    <td>
                        <strong style="color: green">Installed</strong>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
        <?php
    }

    /**
     * Renders the post-uninstallation message
     *
     * @param $status
     * @param $parent
     */
    private function _renderPostUninstallation($parent)
    {
        ?>
        <?php $rows = 0; ?>
        <style type="text/css">
            .coalaweb {
                font-family: "Trebuchet MS", Helvetica, sans-serif;
                font-size: 13px !important;
                font-weight: 400 !important;
                color: #4D4D4D;
                border: solid #ccc 1px;
                background: #fff;
                -moz-border-radius: 3px;
                -webkit-border-radius: 3px;
                border-radius: 3px;
                *border-collapse: collapse;
                border-spacing: 0;
                width: 100%;
                margin-bottom: 15px !important
            }

            .coalaweb tr:hover {
                background: #E8F6FE;
                -o-transition: all .1s ease-in-out;
                -webkit-transition: all .1s ease-in-out;
                -moz-transition: all .1s ease-in-out;
                -ms-transition: all .1s ease-in-out;
                transition: all .1s ease-in-out
            }

            .coalaweb tr.row1 {
                background-color: #F0F0EE
            }

            .coalaweb td, .coalaweb th {
                border-left: 1px solid #ccc;
                border-top: 1px solid #ccc;
                padding: 10px !important;
                text-align: left
            }

            .coalaweb th {
                border-top: none;
                color: #333 !important;
                text-shadow: 0 1px 1px #FFF;
                border-bottom: 4px solid #1272a5 !important
            }

            .coalaweb td:first-child, .coalaweb th:first-child {
                border-left: none
            }

            .coalaweb th:first-child {
                -moz-border-radius: 3px 0 0;
                -webkit-border-radius: 3px 0 0 0;
                border-radius: 3px 0 0 0
            }

            .coalaweb th:last-child {
                -moz-border-radius: 0 3px 0 0;
                -webkit-border-radius: 0 3px 0 0;
                border-radius: 0 3px 0 0
            }

            .coalaweb th:only-child {
                -moz-border-radius: 6px 6px 0 0;
                -webkit-border-radius: 6px 6px 0 0;
                border-radius: 6px 6px 0 0
            }

            .coalaweb tr:last-child td:first-child {
                -moz-border-radius: 0 0 0 3px;
                -webkit-border-radius: 0 0 0 3px;
                border-radius: 0 0 0 3px
            }

            .coalaweb tr:last-child td:last-child {
                -moz-border-radius: 0 0 3px;
                -webkit-border-radius: 0 0 3px 0;
                border-radius: 0 0 3px 0
            }

            .coalaweb em, .coalaweb strong {
                color: #1272A5;
                font-weight: 700
            }
        </style>
        <div class="well well-lg">
            <h3> CoalaWeb Gears Uninstallation Status</h3>

            <table class="coalaweb">
                <thead align="left">
                <tr>
                    <th class="title" align="left">Main</th>
                    <th width="25%">Status</th>
                </tr>
                </thead>
                <tbody>
                <tr class="row0">
                    <td class="key">
                        <?php echo JText::_('PLG_CWGEARS_TITLE_CORE'); ?>
                    </td>
                    <td>
                        <strong style="color: green">Uninstalled</strong>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <?php
    }

    /**
     * Activate if main extension is a plugin on install
     *
     * @param JInstaller $parent
     */
    private function _activatePlugin($parent) {
        $db = JFactory::getDbo();

        if (count($this->cwActivatePlugins['plugins'])) {
            foreach ($this->cwActivatePlugins['plugins'] as $folder => $plugins) {
                if (count($plugins)) {
                    foreach ($plugins as $plugin => $published) {

                        if ($published) {
                            $query = $db->getQuery(true)
                                    ->update($db->qn('#__extensions'))
                                    ->set($db->qn('enabled') . ' = ' . $db->q('1'))
                                    ->where($db->qn('element') . ' = ' . $db->q($plugin))
                                    ->where($db->qn('folder') . ' = ' . $db->q($folder));
                            $db->setQuery($query);

                            try {
                                $db->execute();
                            } catch (Exception $e) {
                                // Nothing
                            }
                        }
                    }
                }
            }
        }
    }
    
}
