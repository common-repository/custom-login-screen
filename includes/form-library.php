<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'HRS_FormLibrary' ) ) :

Class HRS_FormLibrary {

	function __construct() { /* silent is golden */ }

	public function print_select( $arr_data = array(), $name = '', $value = '', $attr = '' ) {
		$print_select = "";
		$print_select.= sprintf( "<select name='%s' %s>", 
			esc_attr( $name ), 
			$attr 
		);

		foreach ( $arr_data as $data ) {
			$selected = $data[ 'value' ] == $value ? 'selected' : '';

			$print_select.= sprintf( "<option value='%s' %s>%s</option>", 
				esc_attr( $data[ 'value' ] ), 
				esc_attr( $selected ), 
				esc_html( $data[ 'label' ] ) 
			);
		}

		$print_select.= "</select>";

		echo $print_select;
	}

	public function print_multiselect( $arr_data = array(), $name = '', $value = array(), $attr = '' ) {
		$print_select = "";
		$print_select.= sprintf( "<select name='%s' multiple='multiple' %s>",
			esc_attr( $name ),
			$attr
		);

		foreach ($arr_data as $data) {
			$selected = in_array( $data[ 'value' ], $value ) ? 'selected' : '';

			$print_select.= sprintf( "<option value='%s' %s>%s</option>",
				esc_attr( $data[ 'value' ] ),
				esc_attr( $selected ),
				esc_html( $data[ 'label' ] )
			);
		}

		$print_select.= "</select>";

		echo $print_select;
	}

	public function print_radio( $arr_data = array(), $name = '', $value = '', $attr = '' ) {
		$print_select = "";

		foreach ( $arr_data as $data ) {
			$selected = $data[ 'value' ] == $value ? 'checked' : '';

			$print_select.= sprintf( "<input type='radio' name='%s' value='%s' %s %s>%s<br>",
				esc_attr( $name ),
				esc_attr( $data[ 'value' ] ),
				esc_attr( $selected ),
				$attr,
				esc_html( $data[ 'label' ] )
			);
		}

		echo $print_select;
	}

	public function print_checkbox( $arr_data = array(), $attr = '' ) {
		$print_select = "";

		foreach ( $arr_data as $data ) {
			$selected = $data[ 'value' ] == $data[ 'saved_value' ] ? 'checked' : '';

			$print_select.= sprintf( "<input type='checkbox' name='%s' value='%s' %s %s>%s<br>",
				esc_attr( $data[ 'name' ] ),
				esc_attr( $data[ 'value' ] ),
				esc_attr( $selected ),
				$attr,
				esc_html( $data[ 'label' ] )
			);
		}

		echo $print_select;
	}

	public function print_checkbox_naked( $arr_data = array(), $attr = '' ) {
		$print_select = "";

		foreach ( $arr_data as $data ) {
			$selected = $data[ 'value' ] == $data[ 'saved_value' ] ? 'checked' : '';

			// $print_select.= "<input type='checkbox' name='{$data['name']}' value='{$data['value']}' $selected $attr>";

			$print_select.= sprintf( "<input type='checkbox' name='%s' value='%s' %s %s>",
				esc_attr( $data[ 'name' ] ),
				esc_attr( $data[ 'value' ] ),
				esc_attr( $selected ),
				$attr
			);
		}

		echo $print_select;
	}
}

endif;
