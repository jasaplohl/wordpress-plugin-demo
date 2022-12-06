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
        );

        // Initialize the dashboard form.
	    Form::init( page: 'jasa_demo');
    }

    /**
     * Creates the admin page and its menu item.
     * @return void
     */
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
}