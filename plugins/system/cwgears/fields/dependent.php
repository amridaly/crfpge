<?php

defined('_JEXEC') or die('Restricted access');

/**
 * @package             Joomla
 * @subpackage          CoalaWeb Dependent Element
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

JFormHelper::loadFieldClass('note');

/**
 * Form Field class for CoalaWeb extensions
 * Checks and displays messages related to dependencies
 */
class JFormFieldDependent extends JFormFieldNote
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  11.1
     */
    protected $type = 'Dependent';

    /**
     * Method to get the field label markup.
     *
     * @return  string  The field label markup.
     *
     * @since   11.1
     */
    protected function getLabel()
    {
        if (empty($this->element['label']) || empty($this->element['description'])) {
            return '';
        }

        $description = (string)$this->element['description'];
        $label = (string)$this->element['label'];

        $html = array();

        $arr = explode("_", $description);

        switch ($arr[0]) {
            case "com":
                $url = JPATH_ADMINISTRATOR . '/' . 'components/' . $description . '/version.php';
                $check = JComponentHelper::isEnabled($description, true);
                break;
            case "mod":
                $url = JPATH_SITE . '/' . 'modules/' . $description . '/version.php';
                break;
            case "plg":
                $url = JPATH_SITE . '/' . 'plugins/' . $arr[1] . '/' . $arr[2] . '/version.php';
                $check = JPluginHelper::isEnabled($arr[1], $arr[2], true);
                break;
        }

        if (!file_exists($url) || !$check) {
            $html[] = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>' . JText::_($label . '_MSG_DEPENDENT');
            return '</div>' . implode('', $html);
        } else {
            return '';
        }
    }

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     *
     * @since   11.1
     */
    protected function getInput()
    {
        return '';
    }
}
