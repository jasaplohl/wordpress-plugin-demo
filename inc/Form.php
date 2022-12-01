<?php

class Form {
	public static string $page;

    /**
     * Map (optionId => optionTitle);
     */
    public static array $checkboxOptions = array(
        'cptManager' => 'Custom Post Type Manager',
        'taxonomyManager' => 'Taxonomy Manager',
        'mediaWidget' => 'Media Widget',
        'galleryManager' => 'Gallery Manager',
        'testimonialManager' => 'Testimonial Manager',
        'templateManager' => 'Template Manager',
        'authManager' => 'Authentication Manager',
        'membershipManager' => 'Membership Manager',
        'chatManager' => 'Chat Manager'
    );

	public static array $sections = array(
		array(
			'id' => 'admin_section',
			'title' => 'Admin section',
			'callback' => array('Form', 'createAdminSection')
		),
		array(
			'id' => 'common_section',
			'title' => 'Common section',
            'callback' => null
		)
	);

	public static function init($page): void {
		Form::$page = $page;

		add_action('admin_init', array('Form', 'create')); // Create the admin custom fields
	}

    /**
     * 1. Register settings (option groups and the names of the options inside the groups).
     * 2. Add settings sections to group the settings options.
     * 3. Add the settings fields (actual input fields).
     */
	public static function create(): void {
        foreach(Form::$sections as $section) {
            add_settings_section( $section['id'], $section['title'], $section['callback'], Form::$page);
        }

		foreach(Form::$checkboxOptions as $id => $title) {
            register_setting( 'pluginSettings', $id, array('Form', 'handleCheckbox'));
            $args = array(
                'label_for' => $id,
                'class' => 'input-field'
            );
            add_settings_field( $id, $title, array('Form', 'createCheckbox'), Form::$page, 'admin_section', $args);
		}
	}

	public static function handleCheckbox($input): bool {
		// validation, parsing, authentication etc.
		return (bool)$input;
	}

	public static function createAdminSection(): void {
		echo '<p>Activate or deactivate the features of the plugin.</p>';
	}

    public static function createCheckbox($args): void {
        $name = $args["label_for"];
        $value = get_option($name);
        echo '
            <input
				type="checkbox"
				name='.$name.'
				'. ($value ? 'checked' : '') .'
			/>
        ';
    }

}