# CMB Field Type: Select2

## Description

[Select2](http://ivaynberg.github.io/select2/) field type for [CMB2](https://github.com/WebDevStudios/CMB2 "Custom Metaboxes and Fields for WordPress 2").

**Running an older version of CMB? Check the [previous releases](https://github.com/mustardBees/cmb-field-select2/releases).**

This plugin gives you two CMB field types based on the Select2 script:

1. The `pw_select` field acts much like the default `select` field. However, it adds typeahead-style search allowing you to quickly make a selection from a large list
2. The `pw_multiselect` field allows you to select multiple values with typeahead-style search. The values can be dragged and dropped to reorder

## Installation

You can install this field type as you would a WordPress plugin:

1. Download the plugin
2. Place the plugin folder in your `/wp-content/plugins/` directory
3. Activate the plugin in the Plugin dashboard

Alternatively, you can place the plugin folder in with your theme/plugin. After you call CMB:

```php
require_once 'init.php';
```

Add another line to include the `cmb-field-select2.php` file. Something like:

```php
require_once 'cmb-field-select2/cmb-field-select2.php';
```

## Usage

`pw_select` - Select box with with typeahead-style search. Example:
```php
array(
	'name'    => 'Cooking time',
	'id'      => $prefix . 'cooking_time',
	'desc'    => 'Cooking time',
	'type'    => 'pw_select',
	'options' => array(
		'5'  => '5 minutes',
		'10' => '10 minutes',
		'30' => 'Half an hour',
		'60' => '1 hour',
	),
),
```

`pw_multiselect` - Multi-value select box with drag and drop reordering. Example:
```php
array(
	'name'    => 'Ingredients',
	'id'      => $prefix . 'ingredients',
	'desc'    => 'Select ingredients. Drag to reorder.',
	'type'    => 'pw_multiselect',
	'options' => array(
		'flour'  => 'Flour',
		'salt'   => 'Salt',
		'eggs'   => 'Eggs',
		'milk'   => 'Milk',
		'butter' => 'Butter',
	),
),
```

## Screenshots

### Select box

![Image](screenshot-1.png?raw=true)

### Multi-value select box

![Image](screenshot-2.png?raw=true)

![Image](screenshot-3.png?raw=true)

![Image](screenshot-4.png?raw=true)