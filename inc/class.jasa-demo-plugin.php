<?php
/**
 * @package JasaDemoPlugin
 */

class JasaDemoPlugin {
    public static function init(): void {
        add_action('init', array('JasaDemoPlugin', 'generateTransactionPostType')); // Create the custom post type
        add_action('admin_enqueue_scripts', array('JasaDemoPlugin', 'enqueueAssets')); // Load the assets

        // Admin
        add_action('admin_menu', array('JasaDemoPlugin', 'addAdminPage')); // Create the admin page and its menu item
        add_filter('plugin_action_links_'.PLUGIN_BASENAME, array('JasaDemoPlugin', 'adminUrl')); // Admin url on the plugin list item
    }

    public static function pluginActivation(): void {
        flush_rewrite_rules();
    }

    public static function pluginDeactivation(): void {
        flush_rewrite_rules();
    }

    public static function generateTransactionPostType(): void {
        register_post_type(
            'transactions',
            array(
                'public' => true,
                'label' => 'Transactions',
                'menu_icon' => 'dashicons-money-alt'
            )
        );
    }

    public static function enqueueAssets(): void {
        wp_enqueue_style('myPluginStyle', PLUGIN_URL . 'assets/styles.css');
        wp_enqueue_script('myPluginScript', PLUGIN_URL . 'assets/helper.js');
    }

    public static function addAdminPage(): void {
        add_menu_page(
            'Jasa Demo Plugin',
            'JasaDemo',
            'manage_options',
            'jasa_demo',
            array('JasaDemoPlugin', 'adminPage'),
            'dashicons-admin-tools'
        );
    }

    public static function adminPage(): void {
        require_once(PLUGIN_DIR_PATH . '/templates/admin.php');
    }

    public static function adminUrl($actions) {
        $actions[] = '<a href="admin.php?page=jasa_demo">Admin dashboard</a>';
        return $actions;
    }
}