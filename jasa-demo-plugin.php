<?php
/**
 * @package JasaDemoPlugin
 *
 * Plugin Name: Jasa Demo Plugin
 * Plugin URI: https://github.com/jasaplohl/wordpress-plugin-demo
 * Description: This is my first WordPress plugin.
 * Version: 1.0.0
 * Author: Jasa Plohl
 * Author URI: https://github.com/jasaplohl
 * License: GPLv2 or later
 * Text Domain: jasa-demo-plugin
 */

/**
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * Copyright 2005-2022 Jasa Plohl.
 */

require_once( plugin_dir_path( __FILE__ ) . 'class.jasa-demo-plugin.php' );

// Make sure we don't expose any info if called directly
function_exists( 'add_action' ) or die('Hi there!  I\'m just a plugin, not much I can do when called directly.');

$jasaDemoPlugin = new JasaDemoPlugin();

register_activation_hook(__FILE__, array('JasaDemoPlugin', 'pluginActivation'));
register_deactivation_hook(__FILE__, array('JasaDemoPlugin', 'pluginDeactivation'));