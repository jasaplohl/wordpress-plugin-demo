<?php

class JasaDemoPlugin {
    public static function init(){
        add_action('init', array('JasaDemoPlugin', 'generateTransactionPostType'));
        add_action('admin_enqueue_scripts', array('JasaDemoPlugin', 'enqueueAssets'));
    }

    public static function pluginActivation(): void {
        flush_rewrite_rules();
    }

    public static function pluginDeactivation(): void {
        flush_rewrite_rules();
    }

    private static function generateTransactionPostType(): void {
        register_post_type(
            'transactions',
            array(
                'public' => true,
                'label' => 'Transactions',
                'menu_icon' => 'dashicons-money-alt'
            )
        );
    }

    private static function enqueueAssets() {
        wp_enqueue_style('myPluginStyle', plugins_url('/assets/styles.css', __FILE__));
        wp_enqueue_script('myPluginScript', plugins_url('/assets/helper.js', __FILE__));
    }
}