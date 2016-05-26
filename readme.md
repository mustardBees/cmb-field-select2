# CMB2 Field Type: Select2

## Description

[Select2](https://select2.github.io/) field type for [CMB2](https://github.com/WebDevStudios/CMB2 "Custom Metaboxes and Fields for WordPress 2").

This plugin gives you two additional field types based on Select2:

1. The `pw_select` field acts much like the default `select` field. However, it adds typeahead-style search allowing you to quickly make a selection from a large list
2. The `pw_multiselect` field allows you to select multiple values with typeahead-style search. The values can be dragged and dropped to reorder

## Installation

You can install this field type as you would a WordPress plugin:

1. Download the plugin
2. Place the plugin folder in your `/wp-content/plugins/` directory
3. Activate the plugin in the Plugin dashboard

Alternatively, you can include this field type within your plugin/theme. The path to front end assets (JS/CSS) can be filtered using `pw_cmb2_field_select2_asset_path`. See an example where we [load assets from the current active theme](http://link.from.pw/pw_cmb2_field_select2_asset_path).

## Usage

`pw_select` - Select box with with typeahead-style search. Example:
```php
$cmb->add_field( array(
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
) );

```

`pw_multiselect` - Multi-value select box with drag and drop reordering. Example:
```php
$cmb->add_field( array(
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
) );
```

### Placeholder

You can specify placeholder text through the attributes array. Example:
```php
$cmb->add_field( array(
	'name'    => 'Ingredients',
	'id'      => $prefix . 'ingredients',
	'desc'    => 'Select this recipes ingredients.',
	'type'    => 'pw_multiselect',
	'options' => array(
		'flour'  => 'Flour',
		'salt'   => 'Salt',
		'eggs'   => 'Eggs',
		'milk'   => 'Milk',
		'butter' => 'Butter',
	),
	'attributes' => array(
		'placeholder' => 'Select ingredients. Drag to reorder'
	),
) );
```

### Custom Select2 configuration and overriding default configuration options

You can define Select2 configuration options using HTML5 `data-*` attributes. It's worth reading up on the [available options](https://select2.github.io/options.html#data-attributes) over on the Select2 website. Example:
```php
$cmb->add_field( array(
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
	'attributes' => array(
		'data-maximum-selection-length' => '2',
	),
) );
```

## Helper functions

You may want to populate the options array dynamically. Common use cases include listing out posts and taxonomy terms. I've written a number of generic helper functions which can be used to return a CMB2 style array for both [posts](http://link.from.pw/1PkJmWc) and [terms](http://link.from.pw/1TDArjR).

## Limitations/known issues

If you’d like to help out, pull requests are more than welcome!

* This field does not work well as a repeatable field within a repeatable group.
* Yoast SEO also loads Select2. Currently a version behind, there is an issue with the previous version of Select2 and it's ability to position the dropdown relative to the field.

## Screenshots

### Select box

![Image](screenshot-1.png?raw=true)

### Multi-value select box

![Image](screenshot-2.png?raw=true)

![Image](screenshot-3.png?raw=true)

![Image](screenshot-4.png?raw=true)