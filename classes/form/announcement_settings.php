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

namespace local_admin_announcement\form;

use coding_exception;
use HTML_QuickForm_Error;
use moodleform;
use MoodleQuickForm;

defined('MOODLE_INTERNAL') || die();

/** @noinspection PhpUndefinedVariableInspection */
/** @noinspection PhpIncludeInspection */
require_once($CFG->libdir . '/formslib.php');

class announcement_settings extends moodleform {
    /**
     * @throws HTML_QuickForm_Error
     * @throws coding_exception
     */
    protected function definition() {
        /** @var MoodleQuickForm $mform */
        $mform = $this->_form;

        $namestr = get_string('setting_enabled', 'local_admin_announcement');
        $labelstr = get_string('setting_enabled_label', 'local_admin_announcement');
        $mform->addElement('advcheckbox', 'enabled', $namestr, $labelstr, null, array(0, 1));
        $mform->setDefault('enabled', $this->_customdata['enabled']);
        $mform->setType('enabled', PARAM_BOOL);
        $mform->addHelpButton('enabled', 'setting_enabled', 'local_admin_announcement');

        $namestr = get_string('setting_showoncepersession', 'local_admin_announcement');
        $labelstr = get_string('setting_showoncepersession_label', 'local_admin_announcement');
        $mform->addElement('advcheckbox', 'showoncepersession', $namestr, $labelstr, null, array(0, 1));
        $mform->setDefault('showoncepersession', $this->_customdata['showoncepersession']);
        $mform->setType('showoncepersession', PARAM_BOOL);
        $mform->addHelpButton('showoncepersession', 'setting_showoncepersession', 'local_admin_announcement');
        $mform->disabledIf('showoncepersession', 'enabled', 'eq', 0);

        $namestr = get_string('setting_type', 'local_admin_announcement');
        $options = [
            'warning' => get_string('setting_type_label_warning', 'local_admin_announcement'),
            'success' => get_string('setting_type_label_success', 'local_admin_announcement'),
            'info' => get_string('setting_type_label_info', 'local_admin_announcement'),
            'error' => get_string('setting_type_label_error', 'local_admin_announcement'),
            'custom' => get_string('setting_type_label_custom', 'local_admin_announcement'),
        ];

        asort($options);

        $mform->addElement('select', 'type', $namestr, $options);
        $mform->setDefault('type', $this->_customdata['type']);
        $mform->setType('type', PARAM_ALPHA);
        $mform->disabledIf('type', 'enabled', 'eq', 0);
        $mform->addHelpButton('type', 'setting_type', 'local_admin_announcement');

        $namestr = get_string('setting_title', 'local_admin_announcement');
        $mform->addElement('text', 'title', $namestr);
        $mform->setDefault('title', $this->_customdata['title']);
        $mform->setType('title', PARAM_TEXT);
        $mform->addHelpButton('title', 'setting_title', 'local_admin_announcement');
        $mform->disabledIf('title', 'enabled', 'eq', 0);

        $namestr = get_string('setting_message', 'local_admin_announcement');
        $mform->addElement('textarea', 'message', $namestr, 'wrap="virtual" rows="10" cols="50"');
        $mform->setDefault('message', $this->_customdata['message']);
        $mform->setType('message', PARAM_TEXT);
        $mform->addHelpButton('message', 'setting_message', 'local_admin_announcement');
        $mform->disabledIf('message', 'enabled', 'eq', 0);

        $namestr = get_string('setting_position', 'local_admin_announcement');
        $options = [
            'toast-top-right' => get_string('setting_position_label_topright', 'local_admin_announcement'),
            'toast-bottom-right' => get_string('setting_position_label_bottomright', 'local_admin_announcement'),
            'toast-bottom-left' => get_string('setting_position_label_bottomleft', 'local_admin_announcement'),
            'toast-top-left' => get_string('setting_position_label_topleft', 'local_admin_announcement'),
            'toast-top-full-width' => get_string('setting_position_label_topfull', 'local_admin_announcement'),
            'toast-bottom-full-width' => get_string('setting_position_label_bottomfull', 'local_admin_announcement'),
            'toast-top-center' => get_string('setting_position_label_topcenter', 'local_admin_announcement'),
            'toast-bottom-center' => get_string('setting_position_label_bottomcenter', 'local_admin_announcement'),
        ];
        $mform->addElement('select', 'position', $namestr, $options);
        $mform->setDefault('position', $this->_customdata['position']);
        $mform->setType('position', PARAM_ALPHAEXT);
        $mform->addHelpButton('position', 'setting_position', 'local_admin_announcement');
        $mform->disabledIf('position', 'enabled', 'eq', 0);

        $namestr = get_string('setting_showfromdate', 'local_admin_announcement');
        $mform->addElement('date_time_selector', 'showfromdate', $namestr, array('optional' => true));
        $mform->setDefault('showfromdate', $this->_customdata['showfromdate']);
        $mform->setType('showfromdate', PARAM_INT);
        $mform->addHelpButton('showfromdate', 'setting_showfromdate', 'local_admin_announcement');
        $mform->disabledIf('showfromdate', 'enabled', 'eq', 0);

        $namestr = get_string('setting_showuntildate', 'local_admin_announcement');
        $mform->addElement('date_time_selector', 'showuntildate', $namestr, array('optional' => true));
        $mform->setDefault('showuntildate', $this->_customdata['showuntildate']);
        $mform->setType('showuntildate', PARAM_INT);
        $mform->addHelpButton('showuntildate', 'setting_showuntildate', 'local_admin_announcement');
        $mform->disabledIf('showuntildate', 'enabled', 'eq', 0);

        $this->add_action_buttons(true);
    }
}
