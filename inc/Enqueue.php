<?php
/**
 * @package JasaDemoPlugin
 */

class Enqueue {
    public static function init(): void {
        add_action(
            hook_name: 'admin_enqueue_scripts',
            callback: array('Enqueue', 'enqueueAssets')
        ); // Load the assets
    }

    public static function enqueueAssets(): void {
        wp_enqueue_style(
            handle: 'myPluginStyle',
            src: PLUGIN_URL . 'dist/styles.css'
        );
        wp_enqueue_script(
            handle: 'myPluginScript',
            src: PLUGIN_URL . 'dist/bundle.js'
        );
    }
}