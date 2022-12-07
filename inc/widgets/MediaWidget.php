<?php
/**
 * @package JasaDemoPlugin
 */

class MediaWidget extends WP_Widget {
    public $id_base = 'media_widget';
    public $name = 'Media Widget';
    public $widget_options = array(
        'classname' => 'media_widget',
        'description' => 'Media Widget',
        'customize_selective_refresh' => true
    );
    public $control_options = array(
        'width' => 400,
        'height' => 350
    );

    public function __construct() {
        parent::__construct(
            id_base: $this->id_base,
            name: $this->name,
            widget_options: $this->widget_options,
            control_options: $this->control_options
        );

        add_action(hook_name: 'widgets_init', callback: function() {
            register_widget(widget: $this);
        });
    }

    public function form($instance) {
        ?>
            <p>Hello world 123 4321</p>
        <?php
    }

    public function update($new_instance, $old_instance) {

    }

    public function widget($args, $instance) {

    }
}