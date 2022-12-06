<?php
/**
 * @package JasaDemoPlugin
 */

require_once(PLUGIN_PATH . '/inc/Admin.php');
require_once(PLUGIN_PATH . '/inc/ActionLinks.php');
require_once(PLUGIN_PATH . '/inc/Enqueue.php');
require_once(PLUGIN_PATH . '/inc/CPTController.php');

class Init {
    public static function init(): void {
        ActionLinks::init();
        Admin::init();
        Enqueue::init();

        // Dynamically activate the chosen functionalities
        if(Init::isOptionChecked(optionName: 'cptManager')) {
            CPTController::init();
        }
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

    private static function setDefaultOptions(): void {
        $defaultOptions = array(
            'authManager' => 'on'
        );
        update_option(
            option: 'jasa_demo',
            value: $defaultOptions
        );
    }

    private static function isOptionChecked(string $optionName): bool {
        $settings = get_option(option: 'jasa_demo');
        $checked = $settings[$optionName] ?? '';
        return strcmp($checked, 'on') === 0;
    }
}