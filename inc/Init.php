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

        add_action(
            hook_name: 'init',
            callback: array('Init', 'generateTransactionPostType')
        ); // Create the custom post type
    }

    public static function pluginActivation(): void {
        flush_rewrite_rules();

        if(!get_option('jasa_demo')) {
            Init::setDefaultOptions();
        }
    }

    public static function pluginDeactivation(): void {
        flush_rewrite_rules();
    }

    public static function generateTransactionPostType(): void {
        register_post_type(
            post_type: 'transactions',
            args: array(
                'public' => true,
                'label' => 'Transactions',
                'menu_icon' => 'dashicons-money-alt'
            )
        );
    }

    private static function setDefaultOptions(): void {
        $defaultOptions = array(
            'cptManager' => 'on',
            'authManager' => 'on'
        );
        update_option(
            option: 'jasa_demo',
            value: $defaultOptions
        );
    }
}