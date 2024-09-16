<?php
/**
 * Divi Custom Modules
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @since 1.0.0
 */
class UtbfDiviCustomModules extends DiviExtension {

	/**
	 * The gettext domain for the extension's translations.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $gettext_domain = UTBF_TEXT_DOMAIN;

	/**
	 * The extension's WP Plugin name.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $name = 'divi-custom-modules';

	/**
	 * The extension's version
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * UTBF_DiviCustomModules constructor.
	 *
	 * @param string $name
	 * @param array  $args
	 */
	public function __construct( $name = 'divi-custom-modules', $args = array() ) {
		$this->plugin_dir              = plugin_dir_path( __FILE__ );
		$this->plugin_dir_url          = plugin_dir_url( $this->plugin_dir );
		$this->_builder_js_data        = array(
			'i10n' => array(
				'UTBF_cta_all_options' => array(
					'basic_fields'         => esc_html__( 'Basic Fields', UTBF_TEXT_DOMAIN ),
					'text'                 => esc_html__( 'Text', UTBF_TEXT_DOMAIN ),
					'textarea'             => esc_html__( 'Textarea', UTBF_TEXT_DOMAIN ),
					'select'               => esc_html__( 'Select', UTBF_TEXT_DOMAIN ),
					'toggle'               => esc_html__( 'Toggle', UTBF_TEXT_DOMAIN ),
					'multiple_buttons'     => esc_html__( 'Multiple Buttons', UTBF_TEXT_DOMAIN ),
					'multiple_checkboxes'  => esc_html__( 'Multiple Checkboxes', UTBF_TEXT_DOMAIN ),
					'input_range'          => esc_html__( 'Input Range', UTBF_TEXT_DOMAIN ),
					'input_datetime'       => esc_html__( 'Input Date Time', UTBF_TEXT_DOMAIN ),
					'input_margin'         => esc_html__( 'Input Margin', UTBF_TEXT_DOMAIN ),
					'checkboxes_category'  => esc_html__( 'Checkboxes Category', UTBF_TEXT_DOMAIN ),
					'select_sidebar'       => esc_html__( 'Select Sidebar', UTBF_TEXT_DOMAIN ),
					'code_fields'          => esc_html__( 'Code Fields', UTBF_TEXT_DOMAIN ),
					'codemirror'           => esc_html__( 'Codemirror', UTBF_TEXT_DOMAIN ),
					'prop_value'           => esc_html__( 'Prop value: ', UTBF_TEXT_DOMAIN ),
					'rendered_prop_value'  => esc_html__( 'Rendered prop value: ', UTBF_TEXT_DOMAIN ),
					'form_fields'          => esc_html__( 'Form Fields', UTBF_TEXT_DOMAIN ),
					'option_list'          => esc_html__( 'Option List', UTBF_TEXT_DOMAIN ),
					'option_list_checkbox' => esc_html__( 'Option List Checkbox', UTBF_TEXT_DOMAIN ),
					'option_list_radio'    => esc_html__( 'Option List Radio', UTBF_TEXT_DOMAIN ),
					'typography_fields'    => esc_html__( 'Typography Fields', UTBF_TEXT_DOMAIN ),
					'select_font_icon'     => esc_html__( 'Select Font Icon', UTBF_TEXT_DOMAIN ),
					'select_text_align'    => esc_html__( 'Select Text Align', UTBF_TEXT_DOMAIN ),
					'select_font'          => esc_html__( 'Select Font', UTBF_TEXT_DOMAIN ),
					'color_fields'         => esc_html__( 'Color Fields', UTBF_TEXT_DOMAIN ),
					'color'                => esc_html__( 'Color', UTBF_TEXT_DOMAIN ),
					'color_alpha'          => esc_html__( 'Color Alpha', UTBF_TEXT_DOMAIN ),
					'upload_fields'        => esc_html__( 'Upload Fields', UTBF_TEXT_DOMAIN ),
					'upload'               => esc_html__( 'Upload', UTBF_TEXT_DOMAIN ),
					'advanced_fields'      => esc_html__( 'Advanced Fields', UTBF_TEXT_DOMAIN ),
					'tab_1_text'           => esc_html__( 'Tab 1 Text', UTBF_TEXT_DOMAIN ),
					'tab_2_text'           => esc_html__( 'Tab 2 Text', UTBF_TEXT_DOMAIN ),
					'presets_shadow'       => esc_html__( 'Presets Shadow', UTBF_TEXT_DOMAIN ),
					'preset_affected_1'    => esc_html__( 'Preset Affected 1', UTBF_TEXT_DOMAIN ),
					'preset_affected_2'    => esc_html__( 'Preset Affected 2', UTBF_TEXT_DOMAIN ),
				),
			),
		);

		parent::__construct( $name, $args );
	}
}

new UtbfDiviCustomModules;
