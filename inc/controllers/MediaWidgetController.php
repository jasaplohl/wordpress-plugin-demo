<?php
/**
 * @package JasaDemoPlugin
 */

require_once(PLUGIN_PATH . '/inc/widgets/MediaWidget.php');

class MediaWidgetController {

    public static function init(): void {
        $mediaWidget = new MediaWidget();
    }
}