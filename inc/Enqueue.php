<?php

class Enqueue {
    public static function init(): void {
        add_action('admin_enqueue_scripts', array('Enqueue', 'enqueueAssets')); // Load the assets
    }

    public static function enqueueAssets(): void {
        wp_enqueue_style('myPluginStyle', PLUGIN_URL . 'assets/styles.css');
        wp_enqueue_script('myPluginScript', PLUGIN_URL . 'assets/bundle.js');
    }
}