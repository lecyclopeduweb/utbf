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

		global $wpdb;

		//Classroom
        $select_classroom = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE post_type = 'acf-field' AND post_excerpt = 'user__child__classroom'");
		$classroom =(!empty($select_classroom))?((!empty($select_classroom[0]->post_content))? unserialize($select_classroom[0]->post_content)['choices']: []): [];

		//school
        $select_school = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE post_type = 'acf-field' AND post_excerpt = 'user__child__school'");
		$school =(!empty($select_school))?((!empty($select_school[0]->post_content))? unserialize($select_school[0]->post_content)['choices']: []): [];

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
