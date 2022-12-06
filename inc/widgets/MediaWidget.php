<?php
/**
 * @package JasaDemoPlugin
 */

class MediaWidget extends WP_Widget {
    public function __construct($id_base, $name, $widget_options = array(), $control_options = array())
    {
        parent::__construct(
            id_base: $id_base,
            name: $name,
            widget_options: $widget_options,
            control_options: $control_options
        );

        add_action(hook_name: 'widgets_init', callback: function() {
            register_widget(widget: $this);
        });
    }


}