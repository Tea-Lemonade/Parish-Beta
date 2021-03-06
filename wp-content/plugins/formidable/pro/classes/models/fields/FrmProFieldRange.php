<?php

/**
 * @since 3.0
 */
class FrmProFieldRange extends FrmFieldType {

	/**
	 * @var string
	 * @since 3.0
	 */
	protected $type = 'range';

	protected $is_tall = true;

	protected function field_settings_for_type() {
		$settings = array(
			'invalid' => true,
			'range'   => true,
			'default_value' => true,
		);

		FrmProFieldsHelper::fill_default_field_display( $settings );
		return $settings;
	}

	protected function builder_text_field() {
		if ( is_object( $this->field ) ) {
			$min  = FrmField::get_option( $this->field, 'minnum' );
			$max  = FrmField::get_option( $this->field, 'maxnum' );
			$step = FrmField::get_option( $this->field, 'step' );
		} else {
			$min  = 0;
			$max  = 100;
			$step = 1;
		}

		return '<input type="range" name="' . esc_attr( $this->html_name() ) . '" id="' . esc_attr( $this->html_id() ) . '" value="' . esc_attr( $this->get_field_column('default_value') ) . '" min="' . esc_attr( $min ) . '" max="' . esc_attr( $max ) . '" step="' . esc_attr( $step ) . '" />';
	}

	protected function extra_field_opts() {
		return array(
			'minnum' => 0,
			'maxnum' => 100,
			'step'   => 1,
		);
	}

	public function front_field_input( $args, $shortcode_atts ) {
		$input_html = $this->get_field_input_html_hook( $this->field );
		$this->add_aria_description( $args, $input_html );

		$default = $this->get_field_column('default_value');
		$starting_value = ( '' === $this->field['value'] || false === $this->field['value'] ) ? $default : $this->field['value'];

		$input = '<div class="frm_range_container">';
		$input .= '<input type="range" id="' . esc_attr( $args['html_id'] ) . '" name="' . esc_attr( $args['field_name'] ) . '" value="' . esc_attr( $this->field['value'] ) . '" data-frmrange ' . $input_html . '/>';
		$output = '<span class="frm_range_value">' . esc_html( $starting_value ) . '</span>';
		$input .= apply_filters( 'frm_range_output', $output, array( 'field' => $this->field ) );
		$input .= '</div>';

		return $input;
	}
}
