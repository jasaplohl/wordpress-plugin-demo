<?php
/**
 * @package JasaDemoPlugin
 */

require_once(PLUGIN_PATH . '/inc/Admin.php');
require_once(PLUGIN_PATH . '/inc/ActionLinks.php');
require_once(PLUGIN_PATH . '/inc/Enqueue.php');
require_once(PLUGIN_PATH . '/inc/controllers/CPTController.php');
require_once(PLUGIN_PATH . '/inc/controllers/TaxonomyController.php');
require_once(PLUGIN_PATH . '/inc/controllers/MediaWidgetController.php');

$FEATURES = array(
    'cptManager' => array(
        'title' => 'Custom Post Type Manager',
        'controller' => CPTController::class
    ),
    'taxonomyManager' => array(
        'title' => 'Taxonomy Manager',
        'controller' => TaxonomyController::class
    ),
    'mediaWidget' => array(
        'title' => 'Media Widget',
        'controller' => MediaWidgetController::class
    )
);

class Init {
    public static function init(): void {
        global $FEATURES;

        ActionLinks::init();
        Admin::init();
        Enqueue::init();

        // Dynamically activate the chosen features
        foreach ($FEATURES as $key => $value) {
            if(Init::isOptionChecked(optionName: $key)) {
                $value['controller']::init();
            }
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
            'cptManager' => 'on'
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