<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Add a page/pages to admin menu.
 *
 * @package     local_admin_announcement
 * @copyright   2018 3iPunt <mitxel@tresipunt.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    // Add new category.
    $namestr = new lang_string('pluginname', 'local_admin_announcement');
    $category = new admin_category('adminannouncement', $namestr);
    /** @noinspection PhpUndefinedVariableInspection */
    $ADMIN->add('root', $category);

    // Add new settings page within the recently created category.
    $namestr = new lang_string('pluginadministration', 'local_admin_announcement');
    $url = new moodle_url('/local/admin_announcement/index.php');
    $settingspage = new admin_externalpage('adminannouncementsettings', $namestr, $url);
    $ADMIN->add('adminannouncement', $settingspage);
}
