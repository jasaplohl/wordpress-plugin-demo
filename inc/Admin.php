<?php
/**
 * @package JasaDemoPlugin
 */

class Admin {
    public static function init(): void {
        add_action('admin_menu', array('Admin', 'addAdminPage')); // Create the admin page and its menu item
        add_filter('plugin_action_links_'.PLUGIN_BASENAME, array('Admin', 'adminUrl')); // Admin url on the plugin list item
    }

    public static function addAdminPage(): void {
        add_menu_page(
            'Jasa Demo Plugin',
            'JasaDemo',
            'manage_options',
            'jasa_demo',
            array('Admin', 'adminPage'),
            'dashicons-admin-tools'
        );
    }

    public static function adminPage(): void {
        require_once(PLUGIN_PATH . '/templates/admin.php');
    }

    public static function adminUrl($actions) {
        $actions[] = '<a href="admin.php?page=jasa_demo">Admin dashboard</a>';
        return $actions;
    }
}