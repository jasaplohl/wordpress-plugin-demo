<?php

class Form {
	public static string $page;

	public static array $options = array(
		array(
			'option_group' => 'userGroup',
			'option_name' => 'firstName',
			'callback' => array('Form', 'pluginOptionGroup')
		),
		array(
			'option_group' => 'userGroup',
			'option_name' => 'lastName',
			'callback' => array('Form', 'pluginOptionGroup')
		),
		array(
			'option_group' => 'userGroup',
			'option_name' => 'email',
			'callback' => array('Form', 'pluginOptionGroup')
		),
		array(
			'option_group' => 'userGroup',
			'option_name' => 'email',
			'callback' => array('Form', 'pluginOptionGroup')
		),
		array(
			'option_group' => 'userGroup',
			'option_name' => 'color',
			'callback' => array('Form', 'pluginOptionGroup')
		)
	);

	public static array $sections = array(
		array(
			'id' => 'admin_section',
			'title' => 'Admin section',
			'callback' => array('Form', 'createSettingsSection')
		),
		array(
			'id' => 'common_section',
			'title' => 'Common section',
			'callback' => array('Form', 'createCommonSection')
		)
	);

	private static array $fields = array(
		array(
			'id' => 'firstName',
			'title' => 'First name',
			'callback' => array('Form', 'firstNameFieldCallback'),
			'section' => 'admin_section',
			'args' => array(
				'label_for' => 'firstName',
				'class' => 'input-field'
			)
		),
		array(
			'id' => 'lastName',
			'title' => 'Last name',
			'callback' => array('Form', 'lastNameFieldCallback'),
			'section' => 'admin_section',
			'args' => array(
				'label_for' => 'lastName',
				'class' => 'input-field'
			)
		),
		array(
			'id' => 'email',
			'title' => 'Email',
			'callback' => array('Form', 'emailFieldCallback'),
			'section' => 'admin_section',
			'args' => array(
				'label_for' => 'email',
				'class' => 'input-field'
			)
		),
		array(
			'id' => 'color',
			'title' => 'Color',
			'callback' => array('Form', 'colorFieldCallback'),
			'section' => 'common_section',
			'args' => array(
				'label_for' => 'color',
				'class' => 'input-field'
			)
		)
	);

	public static function init($page): void {
		Form::$page = $page;

		add_action('admin_init', array('Form', 'create')); // Create the admin custom fields
	}

	public static function create(): void {
		foreach(Form::$options as $option) {
			register_setting( $option['option_group'], $option['option_name'], $option['callback']);
		}

		foreach(Form::$sections as $section) {
			add_settings_section( $section['id'], $section['title'], $section['callback'], Form::$page);
		}

		foreach(Form::$fields as $field) {
			add_settings_field( $field['id'], $field['title'], $field['callback'], Form::$page, $field['section'], $field['args']);
		}
	}

	public static function pluginOptionGroup($input) {
		// validation, parsing, authentication etc.
		return $input;
	}

	public static function createSettingsSection(): void {
		echo '<p>User settings.</p>';
	}

	public static function createCommonSection(): void {
		echo '<p>Common settings.</p>';
	}

	public static function firstNameFieldCallback(): void {
		$value = esc_attr(get_option('firstName'));
		echo '
			<input
				type="text"
				class="regular-text"
				name='.'firstName'.'
				value="'.$value.'"
				placeholder="'.'Your first name'.'"
			/>
		';
	}

	public static function lastNameFieldCallback(): void {
		$value = esc_attr(get_option('lastName'));
		echo '
			<input
				type="text"
				class="regular-text"
				name='.'lastName'.'
				value="'.$value.'"
				placeholder="'.'Your last name'.'"
			/>
		';
	}

	public static function emailFieldCallback(): void {
		$value = esc_attr(get_option('email'));
		echo '
			<input
				type="text"
				class="regular-text"
				name='.'email'.'
				value="'.$value.'"
				placeholder="'.'Your email'.'"
			/>
		';
	}

	public static function colorFieldCallback(): void {
		$value = esc_attr(get_option('color'));
		echo '
		<input
			type="text"
			class="regular-text"
			name='.'color'.'
			value="'.$value.'"
			placeholder="'.'Favourite color'.'"
		/>';
	}

}