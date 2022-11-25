<?php

class JasaDemoPlugin {
    public static function init($basename): void {
        add_action('init', array('JasaDemoPlugin', 'generateTransactionPostType')); // Create the custom post type
        add_action('admin_enqueue_scripts', array('JasaDemoPlugin', 'enqueueAssets')); // Load the assets
        add_action('admin_menu', array('JasaDemoPlugin', 'addAdminPage')); // Create the admin page and its menu item
        add_filter("plugin_action_links_$basename", array('JasaDemoPlugin', 'adminUrl'));
    }

    public static function initFilters(): void {
        add_filter('plugin_action_links_' . plugin_basename(__FILE__), array('JasaDemoPlugin', 'adminUrl'));
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
        wp_enqueue_style('myPluginStyle', plugins_url('../assets/styles.css', __FILE__));
        wp_enqueue_script('myPluginScript', plugins_url('../assets/helper.js', __FILE__));
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
        require_once(plugin_dir_path(__FILE__) . '../templates/admin.php');
    }

    public static function adminUrl($actions) {
        $actions[] = '<a href="admin.php?page=jasa_demo">Admin dashboard</a>';
        return $actions;
    }
}