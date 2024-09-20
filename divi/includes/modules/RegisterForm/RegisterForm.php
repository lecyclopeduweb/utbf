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

		//Theme settings : classroom
		$classroom = [];
		if( have_rows('theme_settings_classroom','option') ):
			while( have_rows('theme_settings_classroom','option') ) : the_row();
				$classroom[] = get_sub_field('classroom');
			endwhile;
		endif;

		//Theme settings : School
		$school = [];
		if( have_rows('theme_settings_school','option') ):
			while( have_rows('theme_settings_school','option') ) : the_row();
				$school[] = get_sub_field('school');
			endwhile;
		endif;

		ob_start();

			$args = [
				'props'   		=> $this->props,
				'content' 		=> $this->content,
				'slug'    		=> $render_slug,
				'classroom'    	=> $classroom,
				'school'    	=> $school,
			];
			include UTBF_DIVI_PATH . '/includes/modules/RegisterForm/RegisterFormRender.php';

			$template = ob_get_contents();

		ob_end_clean();

		return $this->_render_module_wrapper($template, $render_slug);

	}

}

new UtbfRegisterForm;
