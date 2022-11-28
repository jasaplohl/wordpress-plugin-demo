<?php
/**
 * @package JasaDemoPlugin
 */

require_once(PLUGIN_PATH . '/inc/Form.php');

class Admin {

    public static function init(): void {
        add_action('admin_menu', array('Admin', 'addAdminPage')); // Create the admin page and its menu item
        add_action('admin_menu', array('Admin', 'addAdminSubPages')); // Create the admin subpages
	    Form::init( 'jasa_demo');
    }

    public static function addAdminPage(): void {
        add_menu_page(
            'Jasa Demo',
            'Jasa Demo',
            'manage_options',
            'jasa_demo',
            function () { return require_once(PLUGIN_PATH . '/templates/admin.php'); },
            'dashicons-admin-tools',
        );
    }

    public static function addAdminSubPages(): void {
        add_submenu_page(
            'jasa_demo',
            'Dashboard',
            'Dashboard',
            'manage_options',
            'menu_subpage',
            function() { return require_once(PLUGIN_PATH . '/templates/dashboard.php'); }
        );
    }
}