<?php
/**
 * UTBF Register Form
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 *
 * @since 1.0.0
 */
class UtbfRegisterForm extends ET_Builder_Module {

	public $slug       = 'UTBF_register_form';
	public $vb_support = 'on';

	/**
	 * Module properties initialization
	 *
	 * @since 1.0.0
	 */
	function init() {

		require_once UTBF_DIVI_PATH . '/includes/modules/RegisterForm/RegisterFormInit.php';
		init_utbf_register_form( $this );

	}

	/**
	 * Module's specific fields
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function get_fields() {

		require_once UTBF_DIVI_PATH . '/includes/modules/RegisterForm/RegisterFormFields.php';
		return get_fields_utbf_register_form();

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

		require_once UTBF_DIVI_PATH . '/includes/modules/RegisterForm/RegisterFormRender.php';
		return $this->_render_module_wrapper( render_utbf_register_form( $this->props, $this->content, $render_slug ), $render_slug );

	}

}

new UtbfRegisterForm;
