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
 * English strings for admin_announcement
 *
 * You can have a rather longer description of the file as well,
 * if you like, and it can span multiple lines.
 *
 * @package    local_admin_announcement
 * @copyright  2018 3iPunt <mitxel@tresipunt.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Anuncios del administrador';
$string['pluginadministration'] = 'Parámetros del anuncio';
$string['privacy:metadata'] = 'El plugin Anuncios del administrador no almacena datos personales';

$string['setting_enabled'] = 'Habilitar anuncio';
$string['setting_enabled_label'] = 'Habilitado';
$string['setting_showoncepersession'] = 'Mostrar anuncio una vez por sesión';
$string['setting_showoncepersession_label'] = 'Habilitado';
$string['setting_type'] = 'Tipo de anuncio';
$string['setting_type_label_warning'] = 'Aviso';
$string['setting_type_label_success'] = 'OK';
$string['setting_type_label_info'] = 'Info';
$string['setting_type_label_error'] = 'Error';
$string['setting_type_label_custom'] = 'Personalizado';
$string['setting_title'] = 'Título del anuncio';
$string['setting_message'] = 'Mensaje del anuncio';
$string['setting_position'] = 'Posición dónde mostrar el anuncio';
$string['setting_position_label_topright'] = 'Arriba a la derecha';
$string['setting_position_label_bottomright'] = 'Abajo a la derecha';
$string['setting_position_label_bottomleft'] = 'Abajo a la izquierda';
$string['setting_position_label_topleft'] = 'Arriba a la izquierda';
$string['setting_position_label_topfull'] = 'Arriba ancho completo';
$string['setting_position_label_bottomfull'] = 'Abajo ancho completo';
$string['setting_position_label_topcenter'] = 'Arriba centrado';
$string['setting_position_label_bottomcenter'] = 'Abajo centrado';
$string['setting_showfromdate'] = 'Mostrar anuncio desde';
$string['setting_showuntildate'] = 'Mostrar anuncio hasta';
$string['setting_saveform_sucess'] = 'Parámetros del anuncio actualizados correctamente';
$string['setting_saveform_error'] = 'Error actualizando los paránetros del anuncio';
$string['setting_enabled_help'] = 'Si está habilitado (y las condiciones se cumplen) se mostrará un anuncio a todos los usuarios en sus respectivas vistas.';
$string['setting_showoncepersession_help'] = 'Si está habilitado, el anuncio se mostrará una única vez por sesión de usuario.';
$string['setting_type_help'] = 'El tipo de anuncio establece la apariencia visual del mismo. Si se selecciona "Personalizado", el anuncio heredará los estilos personalizados en el fichero local/admin_announcement/styles/toast-custom.css';
$string['setting_title_help'] = 'Establece el título del anuncio. Si se deja vacío, no se mostrará.';
$string['setting_message_help'] = 'Establece el mensaje del anuncio.';
$string['setting_position_help'] = 'Establece la posición del anuncio.';
$string['setting_showfromdate_help'] = 'Si se habilita, el anuncio no se mostrará antes de esta fecha.';
$string['setting_showuntildate_help'] = 'Si se habilita, el anuncio no se mostrará después de esta fecha.';
