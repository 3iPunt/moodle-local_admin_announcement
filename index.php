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

use core\output\notification;
use local_admin_announcement\api;
use local_admin_announcement\form\announcement_settings as announcement_settings_form;

require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/../../lib/adminlib.php');

admin_externalpage_setup('adminannouncementsettings');

$selfurl = new moodle_url('/local/admin_announcement/index.php');
$redirecturl = new moodle_url('/admin/search.php');
$heading = get_string('pluginadministration', 'local_admin_announcement');

$form = new announcement_settings_form(null, (array) api::get_announcement_settings());
if ($form->is_cancelled()) {
    redirect($redirecturl);
} else if ($data = $form->get_data()) {
    if (api::update_announcement_settings($data)) {
        $msg = get_string('setting_saveform_sucess', 'local_admin_announcement');
        redirect($selfurl, $msg, null, notification::NOTIFY_SUCCESS);
    } else {
        $msg = get_string('setting_saveform_error', 'local_admin_announcement');
        redirect($selfurl, $msg, null, notification::NOTIFY_ERROR);
    }
}

echo $OUTPUT->header();
echo $OUTPUT->heading($heading);
$form->display();
echo $OUTPUT->footer();
