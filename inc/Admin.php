<?php
/**
 * @package JasaDemoPlugin
 */

require_once(PLUGIN_PATH . '/inc/Form.php');

class Admin {

    public static array $menuSubPages = array(
        'taxonomy_manager' => array(
            'title' => 'Taxonomy Manager',
            'callback' => array('Admin', 'taxonomyManager')
        ),
        'mediaWidget' => array(
            'title' => 'Media Widget',
            'callback' => array('Admin', 'mediaWidget')
        )
    );

    public static function init(): void {
        // Create the admin page and its menu item
        add_action(
            hook_name: 'admin_menu',
            callback: array('Admin', 'addAdminPage')
        );

        // Create the admin subpages
        add_action(
            hook_name: 'admin_menu',
            callback: array('Admin', 'addAdminSubPages')
        );

        // Initialize the dashboard form.
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
        foreach (Admin::$menuSubPages as $key => $value) {
            add_submenu_page(
                parent_slug: 'jasa_demo',
                page_title: $value['title'],
                menu_title: $value['title'],
                capability: 'manage_options',
                menu_slug: $key,
                callback: $value['callback']
            );
        }
    }

    public static function taxonomyManager() {
        return require_once(PLUGIN_PATH . '/templates/taxonomy_manager.php');
    }

    public static function mediaWidget() {
        return require_once(PLUGIN_PATH . '/templates/media_widget.php');
    }
}