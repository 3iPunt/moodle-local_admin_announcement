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
 * @package    local_admin_announcement
 * @copyright  2018 3iPunt <mitxel@tresipunt.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_admin_announcement;

use dml_exception;
use moodle_page;
use stdClass;

defined('MOODLE_INTERNAL') || die();

/**
 * Class api
 * @package local_admin_announcement
 */
class api {
    /**
     * @param stdClass $settings
     * @return bool
     */
    public static function announcement_can_be_shown($settings) {
        global $SESSION, $PAGE;

        if (!isset($PAGE) || !($PAGE instanceof moodle_page)) {
            // If $PAGE is not correctly instanced we won't be able to load our plugin CSS + JS.
            return false;
        }

        if (!$settings->enabled) {
            return false;
        }

        if ($settings->showoncepersession && $SESSION->local_admin_announcement_shown) {
            return false;
        }

        $now = time();
        if (!empty($settings->showfromdate) && $now < $settings->showfromdate) {
            return false;
        }

        if (!empty($settings->showuntildate) && $now > $settings->showuntildate) {
            return false;
        }

        return true;
    }

    /**
     * @param stdClass $newsettings
     * @return bool
     * @throws dml_exception
     */
    public static function update_announcement_settings($newsettings) {
        global $DB;

        $settings = self::get_announcement_settings();
        $settings->enabled = $newsettings->enabled;
        $settings->showoncepersession = $newsettings->showoncepersession;
        $settings->type = $newsettings->type;
        $settings->title = $newsettings->title;
        $settings->message = $newsettings->message;
        $settings->position = $newsettings->position;
        $settings->showfromdate = $newsettings->showfromdate;
        $settings->showuntildate = $newsettings->showuntildate;
        $settings->timemodified = time();

        return $DB->update_record('local_admin_announcement', $settings);
    }

    /**
     * Returns the settings row in the table
     * @throws dml_exception
     */
    public static function get_announcement_settings() {
        global $DB;

        $settings = $DB->get_records('local_admin_announcement');

        return reset($settings);
    }
}
