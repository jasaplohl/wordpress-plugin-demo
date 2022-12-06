<?php
/**
 * @package JasaDemoPlugin
 */

class CPTController {
    public static function init(): void {
        add_action(
            hook_name: 'init',
            callback: array('CPTController', 'generatePostTypes')
        ); // Create the custom post type

        // Create the admin subpage
        add_action(
            hook_name: 'admin_menu',
            callback: array('CPTController', 'addSubPage')
        );
    }

    public static function generatePostTypes(): void {
        register_post_type(
            post_type: 'transactions',
            args: array(
                'public' => true,
                'labels' => array(
                    'name' => 'Transactions',
                    'singular_name' => 'Transaction'
                ),
                'menu_icon' => 'dashicons-money-alt',
                'has_archive' => true
            )
        );
    }

    public static function addSubPage(): void {
        add_submenu_page(
            parent_slug: 'jasa_demo',
            page_title: 'CPT Manager',
            menu_title: 'CPT Manager',
            capability: 'manage_options',
            menu_slug: 'cpt_manager',
            callback: function() { return require_once(PLUGIN_PATH . '/templates/cpt_manager.php'); }
        );
    }
}