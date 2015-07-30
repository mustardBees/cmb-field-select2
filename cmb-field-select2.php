<?php
/*
Plugin Name: CMB Field Type: Select2
Plugin URI: https://github.com/mustardBees/cmb-field-select2
Description: Select2 field type for Custom Metaboxes and Fields for WordPress
Version: 2.0.4
Author: Phil Wylie
Author URI: http://www.philwylie.co.uk/
License: GPLv2+
*/

if ( ! class_exists( 'CMB_Field_Select2', false ) ) {

	class CMB_Field_Select2 {
	
		/**
		 * URL to this file
		 * @var   string
		 * @since 2.0.4
		 */
		private $PW_SELECT2_URL;
		
		/**
		 * Current version number
		 * @var   string
		 * @since 2.0.4
		 */
		const PW_SELECT2_VERSION = '2.0.4';
		
		function __construct() {
			$this->PW_SELECT2_URL = plugin_dir_url( __FILE__ );
			
			add_filter( 'cmb2_render_pw_select', array( $this, 'pw_select2_render' ), 10, 5 );
			add_filter( 'cmb2_render_pw_multiselect', array( $this, 'pw_multiselect_render' ), 10, 5 );
			add_filter( 'cmb2_types_esc_pw_multiselect', array( $this, 'pw_multiselect_escape' ), 10, 2 );
			add_filter( 'cmb2_sanitize_pw_multiselect', array( $this, 'pw_multiselect_sanitize' ), 10, 2 );
		}
		
		/**
		 * Set up all of the filters and scripts
		 *
		 * @since  2.0.4
		 * @return CMB_Field_Select2_204 Single instance object
		 */
		public static function initiate() {
			
			// Just here so that everything will load
			
		}
		
		/**
		 * Enqueue scripts and styles, call requested select box field
		 */
		public function pw_select2_enqueue() {
			wp_enqueue_script( 'pw-select2-field-js', $this->PW_SELECT2_URL . 'js/select2/select2.min.js', array( 'jquery-ui-sortable' ), '3.5.1' );
			wp_enqueue_script( 'pw-select2-field-init', $this->PW_SELECT2_URL . 'js/select2-init.js', array( 'pw-select2-field-js' ), self::PW_SELECT2_VERSION );
			wp_enqueue_style( 'pw-select2-field-css', $this->PW_SELECT2_URL . 'js/select2/select2.css', array(), '3.5.1' );
			wp_enqueue_style( 'pw-select2-field-mods', $this->PW_SELECT2_URL . 'css/select2.css', array(), self::PW_SELECT2_VERSION );
		}
		
		/**
		 * Render select box field
		 */
		public function pw_select2_render( $field, $value, $object_id, $object_type, $field_type_object ) {
			$this->pw_select2_enqueue();
		
			echo $field_type_object->select( array(
				'class'   => 'cmb2_select select2',
				// Append an empty option (used by the placeholder)
				'options' => '<option></option>' . $field_type_object->concat_items(),
				// Use description as placeholder
				'desc'    => $field->args( 'desc' ) && ! empty( $value ) ? $field_type_object->_desc( true ) : '',
				'data-placeholder' => $field->args( 'desc' ),
			) );
		}
		
		/**
		 * Render multi-value select input field
		 */
		public function pw_multiselect_render( $field, $value, $object_id, $object_type, $field_type_object ) {
			$this->pw_select2_enqueue();
		
			$options = array();
		
			foreach ( (array) $field->options() as $opt_value => $opt_label ) {
				$options[] = array(
					'id' => $opt_value,
					'text' => $opt_label
				);
			}
		
			wp_localize_script( 'pw-select2-field-init', $field_type_object->_id() . '_data', $options );
		
			echo $field_type_object->input( array(
				'type'  => 'hidden',
				'class' => 'select2',
				// Use description as placeholder
				'desc'  => $field->args( 'desc' ) && ! empty( $value ) ? $field_type_object->_desc( true ) : '',
				'data-placeholder' => esc_attr( $field->args( 'description' ) ),
			) );
		
		}
		
		
		public function pw_multiselect_escape( $check, $meta_value ) {
			return ! empty( $meta_value ) ? implode( ',', $meta_value ) : $check;
		}
		
		
		public function pw_multiselect_sanitize( $check, $meta_value ) {
		
			if ( ! empty( $meta_value ) ) {
				return explode( ',', $meta_value );
			}
		
			return $check;
		}
	
	}

	// Make it so...
	$cmb_field_select2 = new CMB_Field_Select2();

}
