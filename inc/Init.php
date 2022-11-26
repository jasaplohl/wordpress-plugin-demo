<?php
/**
 * @package JasaDemoPlugin
 */

require_once(PLUGIN_PATH . '/inc/Admin.php');

class Init {
    public static function init(): void {
        Admin::init();

        add_action('init', array('JasaDemoPlugin', 'generateTransactionPostType')); // Create the custom post type
        add_action('admin_enqueue_scripts', array('Init', 'enqueueAssets')); // Load the assets
    }

    public static function pluginActivation(): void {
        flush_rewrite_rules();
    }

    public static function pluginDeactivation(): void {
        flush_rewrite_rules();
    }

    public static function enqueueAssets(): void {
        wp_enqueue_style('myPluginStyle', PLUGIN_URL . 'assets/styles.css');
        wp_enqueue_script('myPluginScript', PLUGIN_URL . 'assets/helper.js');
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
}