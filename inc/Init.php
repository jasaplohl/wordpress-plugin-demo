<?php
/**
 * @package JasaDemoPlugin
 */

require_once(PLUGIN_PATH . '/inc/Admin.php');
require_once(PLUGIN_PATH . '/inc/ActionLinks.php');
require_once(PLUGIN_PATH . '/inc/Enqueue.php');

class Init {
    public static function init(): void {
        Admin::init();
        ActionLinks::init();
        Enqueue::init();

        add_action('init', array('Init', 'generateTransactionPostType')); // Create the custom post type
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
}