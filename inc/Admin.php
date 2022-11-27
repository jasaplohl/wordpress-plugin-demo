<?php
/**
 * @package JasaDemoPlugin
 */

class Admin {
    public static function init(): void {
        add_action('admin_menu', array('Admin', 'addAdminPage')); // Create the admin page and its menu item
        add_action('admin_menu', array('Admin', 'addAdminSubPages')); // Create the admin subpages
    }

    public static function addAdminPage(): void {
        add_menu_page(
            'Jasa Demo',
            'Jasa Demo',
            'manage_options',
            'jasa_demo',
            function () { require_once(PLUGIN_PATH . '/templates/admin.php'); },
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
            function() { require_once(PLUGIN_PATH . '/templates/dashboard.php'); }
        );
    }
}