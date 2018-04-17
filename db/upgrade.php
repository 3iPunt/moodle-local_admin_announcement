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
 * This file keeps track of upgrades to the admin_announcement module
 *
 * Sometimes, changes between versions involve alterations to database
 * structures and other major things that may break installations. The upgrade
 * function in this file will attempt to perform all the necessary actions to
 * upgrade your older installation to the current version. If there's something
 * it cannot do itself, it will tell you what you need to do.  The commands in
 * here will all be database-neutral, using the functions defined in DLL libraries.
 *
 * @package    local_admin_announcement
 * @copyright  2018 3iPunt <mitxel@tresipunt.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Execute admin_announcement upgrade from the given old version
 *
 * @param int $oldversion
 * @return bool
 * @throws ddl_exception
 * @throws downgrade_exception
 * @throws upgrade_exception
 * @throws dml_exception
 */
function xmldb_local_admin_announcement_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2018041701) {
        $table = new xmldb_table('local_admin_announcement');

        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null);
        $table->add_field('enabled', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL, null, null, 'id');
        $table->add_field('showoncepersession', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL, null, null, 'enabled');
        $table->add_field('type', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, '0', 'showoncepersession');
        $table->add_field('title', XMLDB_TYPE_TEXT, null, null, null, null, null, 'type');
        $table->add_field('message', XMLDB_TYPE_TEXT, null, null, null, null, null, 'title');
        $table->add_field('position', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, 'message');
        $table->add_field('showfromdate', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'position');
        $table->add_field('showuntildate', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'showfromdate');
        $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, 'showuntildate');
        $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, 'timemodified');

        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

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

        // Assign savepoint reached.
        upgrade_plugin_savepoint(true, 2018041701, 'local', 'admin_announcement');
    }

    return true;
}
