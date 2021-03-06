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
 * Provides code to be executed during the module installation
 *
 * This file replaces the legacy STATEMENTS section in db/install.xml,
 * lib.php/modulename_install() post installation hook and partially defaults.php.
 *
 * @package    local_admin_announcement
 * @copyright  2018 3iPunt <mitxel@tresipunt.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Post installation procedure
 *
 * @see upgrade_plugins_modules()
 */
function xmldb_local_admin_announcement_install() {
    global $DB;
    // Add default settings values.
    if (!$DB->get_records('local_admin_announcement')) {
        $now = time();
        $DB->insert_record('local_admin_announcement', (object) [
            'enabled' => 0,
            'showoncepersession' => 0,
            'type' => 'warning',
            'title' => '',
            'message' => '',
            'position' => 'toast-top-right',
            'showfromdate' => null,
            'showuntildate' => null,
            'timemodified' => $now,
            'timecreated' => $now,
        ]);
    }
}

/**
 * Post installation recovery procedure
 *
 * @see upgrade_plugins_modules()
 */
function xmldb_local_admin_announcement_install_recovery() {
}
