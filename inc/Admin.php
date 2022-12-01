<?php
/**
 * @package JasaDemoPlugin
 */

require_once(PLUGIN_PATH . '/inc/Form.php');

class Admin {

    public static function init(): void {
        add_action(
            hook_name: 'admin_menu',
            callback: array('Admin', 'addAdminPage')
        ); // Create the admin page and its menu item

        add_action(
            hook_name: 'admin_menu',
            callback: array('Admin', 'addAdminSubPages')
        ); // Create the admin subpages

	    Form::init( page: 'jasa_demo');
    }

    public static function addAdminPage(): void {
        add_menu_page(
            page_title: 'Jasa Demo',
            menu_title: 'Jasa Demo',
            capability: 'manage_options',
            menu_slug: 'jasa_demo',
            callback: function () { return require_once(PLUGIN_PATH . '/templates/admin.php'); },
            icon_url: 'dashicons-admin-tools',
        );
    }

    public static function addAdminSubPages(): void {
        add_submenu_page(
            parent_slug: 'jasa_demo',
            page_title: 'Dashboard',
            menu_title: 'Dashboard',
            capability: 'manage_options',
            menu_slug: 'menu_subpage',
            callback: function() { return require_once(PLUGIN_PATH . '/templates/dashboard.php'); }
        );
    }
}