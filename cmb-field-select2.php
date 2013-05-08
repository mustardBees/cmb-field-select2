<?php
	
	/*
		Plugin Name: CMB Field Type: Select2
		Plugin URI: https://github.com/mustardBees/cmb-field-select2
		Description: Select2 field type for Custom Metaboxes and Fields for WordPress
		Version: 0.1
		Author: Phil Wylie
		Author URI: http://www.philwylie.co.uk/
	*/
	
	
	
	/**
	 * Render our interface
	 */
	function pw_select2_field( $field, $meta ) {
		wp_enqueue_script( 'pw-select2-field-js', plugin_dir_url( __FILE__ ) . 'js/select2/select2.min.js', array( 'jquery-ui-sortable' ), '3.2' );
		wp_enqueue_script( 'pw-select2-field-init', plugin_dir_url( __FILE__ ) . 'js/select2-init.js', array( 'pw-select2-field-js' ), '1.0' );
		wp_enqueue_style( 'pw-select2-field-css', plugin_dir_url( __FILE__ ) . 'js/select2/select2.css' );
		wp_enqueue_style( 'pw-select2-field-mods', plugin_dir_url( __FILE__ ) . 'css/select2.css' );
		
		$options = array();
		
		if ( isset( $field['options'] ) && ! empty( $field['options'] ) ) {
			foreach ( $field['options'] as $option ) {
				$options[] = array(
					'id' => $option['value'],
					'text' => $option['name']
				);
			}
		}
		
		wp_localize_script( 'pw-select2-field-init', $field['id'] . '_data', $options );
		
		if ( ! empty( $meta ) ) {
			$meta = implode( ',', $meta );
		}
		
		echo '<input type="hidden" name="' . $field['id'] . '" id="' . $field['id'] . '" data-placeholder="' . $field['desc'] . '" class="select2" value="' . $meta . '" />';
	}
	add_filter( 'cmb_render_select2', 'pw_select2_field', 10, 2 );
	
	
	/**
	 * Split latitude/longitude values into two meta fields
	 */
	function pw_select2_field_validation( $new ) {
		if ( empty( $new ) ) {
			$new = '';
		} else {
			$new = explode( ',', $new );
		}
		
		return $new;
	}
	add_filter( 'cmb_validate_select2', 'pw_select2_field_validation', 10, 3 );
	