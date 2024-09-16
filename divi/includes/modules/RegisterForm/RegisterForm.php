<?php
/**
 * Parent module (module which has module item / child module) with FULL builder support
 * This module appears on Visual Builder and requires react component to be provided
 * Due to full builder support, all advanced options (except button options) are added by default
 *
 * @since 1.0.0
 */
class UTBF_Register_Form extends ET_Builder_Module {
	// Module slug (also used as shortcode tag)
	public $slug       = 'UTBF_register_form';

	// Full Visual Builder support
	public $vb_support = 'on';


	/**
	 * Module properties initialization
	 *
	 * @since 1.0.0
	 */
	function init() {
		// Module name
		$this->name                    = __( 'UTBF Register form', UTBF_TEXT_DOMAIN );

		// Module Icon
		// Load customized svg icon and use it on builder as module icon. If you don't have svg icon, you can use
		// $this->icon for using etbuilder font-icon. (See CustomCta / UTBF_CTA class)
		$this->icon_path               =  plugin_dir_path( __FILE__ ) . 'icon.svg';

		// Toggle settings
		$this->settings_modal_toggles  = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => __( 'Text', UTBF_TEXT_DOMAIN ),
				),
			),
		);
	}

	/**
	 * Module's specific fields
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function get_fields() {
		return array(
			'title' => array(
				'label'           => __( 'Title', UTBF_TEXT_DOMAIN ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => __( 'Text entered here will appear as title.', UTBF_TEXT_DOMAIN ),
				'toggle_slug'     => 'main_content',
			),
		);
	}

	/**
	 * Render module output
	 *
	 * @since 1.0.0
	 *
	 * @param array  $attrs       List of unprocessed attributes
	 * @param string $content     Content being processed
	 * @param string $render_slug Slug of module that is used for rendering output
	 *
	 * @return string module's rendered output
	 */
	function render( $attrs, $content = null, $render_slug ) {
		// Module specific props added on $this->get_fields()
		$title = $this->props['title'];

		// Render module content
		$output = sprintf(
			'<h2 class="dicm-title">%1$s</h2>
			<div class="dicm-content">%2$s</div>',
			esc_html( $title ),
			et_sanitized_previously( $this->content )
		);

		// Render wrapper
		// 3rd party module with no full VB support has to wrap its render output with $this->_render_module_wrapper().
		// This method will automatically add module attributes and proper structure for parallax image/video background
		return $this->_render_module_wrapper( $output, $render_slug );
	}
}

new UTBF_Register_Form;
