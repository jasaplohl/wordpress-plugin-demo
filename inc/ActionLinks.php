<?php
/**
 * @package JasaDemoPlugin
 */

class ActionLinks {
    public static function init(): void {
        add_filter(
            hook_name: 'plugin_action_links_'.PLUGIN_BASENAME,
            callback: array('ActionLinks', 'addUrls')
        ); // Admin url on the plugin list item
    }

    public static function addUrls($actions) {
        $actions[] = '<a href="admin.php?page=jasa_demo">Admin dashboard</a>';
        return $actions;
    }
}