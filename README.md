# CMB Field Type: Suggest

## Description

[Suggest](https://github.com/estin1985/CMB2-Suggest-Field) field type for [CMB2](https://github.com/WebDevStudios/CMB2 "Custom Metaboxes and Fields for WordPress 2").

This plugin creates a text input that uses wordpress' inbuilt suggest system:

1. The `suggest` field renders a normal text input field. However, it adds autocomplete suggestions based on the 'options' key.

## Installation

You can install this field type as you would a WordPress plugin:

1. Download the plugin
2. Place the plugin folder in your `/wp-content/plugins/` directory
3. Activate the plugin in the Plugin dashboard

## Usage

`suggest` - Text input with auto suggestions. Example:
```php
array(
	'name'    => 'Cooking time',
	'id'      => $prefix . 'cooking_time',
	'desc'    => 'Cooking time',
	'type'    => 'suggest',
	'options' => array(
		'5'  => '5 minutes',
		'10' => '10 minutes',
		'30' => 'Half an hour',
		'60' => '1 hour',
	),
),
```
