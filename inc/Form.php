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

		add_action(hook_name: 'admin_init', callback: array('Form', 'create')); // Create the admin custom fields
	}

    /**
     * 1. Register settings (option groups and the names of the options inside the groups).
     * 2. Add settings sections to group the settings options.
     * 3. Add the settings fields (actual input fields).
     */
	public static function create(): void {
        $optionName = Form::$page;

        register_setting(
            option_group: 'pluginSettings',
            option_name: $optionName,
            args: array('Form', 'handleCheckbox')
        );

        foreach(Form::$sections as $section) {
            add_settings_section(
                id: $section['id'],
                title: $section['title'],
                callback: $section['callback'],
                page: Form::$page
            );
        }

		foreach(Form::$checkboxOptions as $id => $title) {
            $args = array(
                'option_name' => $optionName,
                'label_for' => $id,
                'class' => 'input-field'
            );
            add_settings_field(
                id: $id,
                title: $title,
                callback: array('Form', 'createCheckbox'),
                page: Form::$page,
                section: 'admin_section',
                args: $args
            );
		}
	}

	public static function handleCheckbox($input): array {
		// validation, parsing, authentication etc.
        $data = array();

        foreach (Form::$checkboxOptions as $id => $title) {
            $data[$id] = isset($input[$id]);
        }

		return $data;
	}

	public static function createAdminSection(): void {
		echo '<p>Activate or deactivate the features of the plugin.</p>';
	}

    public static function createCheckbox($args): void {
        $option = $args["option_name"];
        $name = $args["label_for"];
        $value = get_option(option: $option); // array of values from the options table
        $checked = $value[$name];
        echo '
            <input
				type="checkbox"
				name='. $option . '[' . $name . ']' .'
				'. ($checked ? 'checked' : '') .'
			/>
        ';
    }

}