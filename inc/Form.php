<?php

class Form {
	public static string $page;

    public static array $checkboxOptions = array(
        'cptManager',
        'taxonomyManager',
        'mediaWidget',
        'galleryManager',
        'testimonialManager',
        'templateManager',
        'authManager',
        'membershipManager',
        'chatManager'
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

	private static array $fields = array(
		array(
			'id' => 'cptManager',
			'title' => 'Custom Post Type Manager',
			'callback' => array('Form', 'createCheckbox'),
			'section' => 'admin_section',
			'args' => array(
				'label_for' => 'cptManager',
				'class' => 'input-field'
			)
		),
		array(
			'id' => 'taxonomyManager',
			'title' => 'Taxonomy Manager',
			'callback' => array('Form', 'createCheckbox'),
			'section' => 'admin_section',
			'args' => array(
				'label_for' => 'taxonomyManager',
				'class' => 'input-field'
			)
		),
		array(
			'id' => 'mediaWidget',
			'title' => 'Media Widget',
			'callback' => array('Form', 'createCheckbox'),
			'section' => 'admin_section',
			'args' => array(
				'label_for' => 'mediaWidget',
				'class' => 'input-field'
			)
		),
		array(
			'id' => 'galleryManager',
			'title' => 'Gallery Manager',
			'callback' => array('Form', 'createCheckbox'),
			'section' => 'admin_section',
			'args' => array(
				'label_for' => 'galleryManager',
				'class' => 'input-field'
			)
		),
        array(
            'id' => 'testimonialManager',
            'title' => 'Testimonial Manager',
            'callback' => array('Form', 'createCheckbox'),
            'section' => 'admin_section',
            'args' => array(
                'label_for' => 'testimonialManager',
                'class' => 'input-field'
            )
        ),
        array(
            'id' => 'templateManager',
            'title' => 'Template Manager',
            'callback' => array('Form', 'createCheckbox'),
            'section' => 'admin_section',
            'args' => array(
                'label_for' => 'templateManager',
                'class' => 'input-field'
            )
        ),
        array(
            'id' => 'authManager',
            'title' => 'Authentication Manager',
            'callback' => array('Form', 'createCheckbox'),
            'section' => 'admin_section',
            'args' => array(
                'label_for' => 'authManager',
                'class' => 'input-field'
            )
        ),
        array(
            'id' => 'membershipManager',
            'title' => 'Membership Manager',
            'callback' => array('Form', 'createCheckbox'),
            'section' => 'admin_section',
            'args' => array(
                'label_for' => 'membershipManager',
                'class' => 'input-field'
            )
        ),
        array(
            'id' => 'chatManager',
            'title' => 'Chat Manager',
            'callback' => array('Form', 'createCheckbox'),
            'section' => 'admin_section',
            'args' => array(
                'label_for' => 'chatManager',
                'class' => 'input-field'
            )
        )
	);

	public static function init($page): void {
		Form::$page = $page;

		add_action('admin_init', array('Form', 'create')); // Create the admin custom fields
	}

	public static function create(): void {
		foreach(Form::$checkboxOptions as $optionName) {
			register_setting( 'pluginSettings', $optionName, array('Form', 'handleCheckbox'));
		}

		foreach(Form::$sections as $section) {
			add_settings_section( $section['id'], $section['title'], $section['callback'], Form::$page);
		}

		foreach(Form::$fields as $field) {
			add_settings_field( $field['id'], $field['title'], $field['callback'], Form::$page, $field['section'], $field['args']);
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