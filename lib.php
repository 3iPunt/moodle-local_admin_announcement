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
 * Library of interface functions and constants for plugin local_admin_announcement
 *
 * All the core Moodle functions, neeeded to allow the module to work
 * integrated in Moodle should be placed here.
 *
 * All the admin_announcement specific functions, needed to implement all the module
 * logic, should go to locallib.php. This will help to save some memory when
 * Moodle is performing actions across all modules.
 *
 * @package    local_admin_announcement
 * @copyright  2018 3iPunt <mitxel@tresipunt.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use local_admin_announcement\api;

defined('MOODLE_INTERNAL') || die();

/**
 * Extends the global navigation tree by adding admin_announcement nodes if there is a relevant content
 *
 * This can be called by an AJAX request so do not rely on $PAGE as it might not be set up properly.
 *
 * @param global_navigation $navigation
 * @throws coding_exception
 * @throws dml_exception
 */
function local_admin_announcement_extend_navigation(global_navigation $navigation) {
    global $PAGE, $SESSION;

    if (!isset($SESSION->local_admin_announcement_shown)) {
        $SESSION->local_admin_announcement_shown = false;
    }

    $settings = api::get_announcement_settings();

    if (api::announcement_can_be_shown($settings)) {
        // Add toastr library styles
        $PAGE->requires->css('/local/admin_announcement/lib/toastr.min.css');

        if ($settings->type === 'custom') {
            // Custom toast
            $toastrsettings = [
                'type' => 'warning',
                'toastClass' => 'toast toast-custom',
                'title' => $settings->title,
                'message' => $settings->message,
                'positionClass' => $settings->position,
            ];

            // Add custom toast styles
            $PAGE->requires->css('/local/admin_announcement/styles/toast-custom.css');
        } else {
            // Default toast
            $toastrsettings = [
                'type' => $settings->type,
                'title' => $settings->title,
                'message' => $settings->message,
                'positionClass' => $settings->position,
            ];
        }

        $PAGE->requires->js_call_amd('local_admin_announcement/showtoastr', 'init', [$toastrsettings]);

        if (!$SESSION->local_admin_announcement_shown) {
            $SESSION->local_admin_announcement_shown = true;
        }
    }
}

/**
 * Extends the settings navigation with the admin_announcement settings
 *
 * This function is called when the context for the page is a admin_announcement module. This is not called by AJAX
 * so it is safe to rely on the $PAGE.
 *
 * @param settings_navigation $navigation
 * @param context $context
 */
function local_admin_announcement_extend_settings_navigation(settings_navigation $navigation, context $context) {
    // empty
}
