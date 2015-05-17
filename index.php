<?php
/*
Plugin Name: CMB Field Type: Suggest
Plugin URI: https://github.com/estin1985/cmb-field-suggest
Description: Suggest field type for CMB2
Version: 1.0.0
Author: Jared Melchert
Author URI: https://github.com/estin1985
License: GPLv2+
*/
class CMB2_SuggestField {

	const VERSION = '0.1.0';

	public $options = array();

	public function hooks() {
		add_action( 'cmb2_after_init', array( $this, 'prepare_fields'));
		add_action( 'wp_ajax_cmb-suggestions', array( $this, 'do_suggest' ) );
		add_filter( 'cmb2_render_suggest', array( $this, 'render_suggest_field'), 10, 5 );
		add_filter( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ));
	}

	public function prepare_fields() {
		foreach(CMB2_Boxes::get_all() as $cmb) {
			foreach( $cmb->prop('fields') as $field_data) {
				if($field_data['type'] === 'suggest') {
					$field_data['options'] = is_array($field_data['options']) ? $field_data['options'] : array();
					$this->options[ $field_data['id'] ] = $field_data['options'];
				}
			}
		}
	}

	public function do_suggest() {
		if (array_key_exists( $_GET['field'], $this->options ) ) {
			foreach($this->options[ $_GET['field'] ] as $opt) {
				if (0 === stripos($opt, $_GET['q']) ) {
					echo $opt ."\n";
				}
			}
			die();
		}
	}

	public function render_suggest_field($field, $value, $object_id, $object_type, $field_type_object) {
		echo $field_type_object->input( array(
			'type'  => 'text',
			'class' => 'regular-text suggest',
		) );
	}

	public function admin_enqueue_scripts($hook) {
		if ( in_array( $hook, array( 'comment.php', 'post.php', 'post-new.php', 'page-new.php', 'page.php' ), true ) ) {
			wp_enqueue_script( 'suggest_field', plugin_dir_url( __FILE__ ).'/suggest_field.js', 'suggest', self::VERSION, true);
		}
	}
}

$cmb_suggest_field = new CMB2_SuggestField();
$cmb_suggest_field->hooks();
