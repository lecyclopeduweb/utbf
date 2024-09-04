<?php

declare (strict_types = 1);

/**
 * Divi Module Register Form
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
function divi_module_register_form()
{
    if(class_exists('ET_Builder_Module'))
    {

        class DiviModuleRegisterForm extends ET_Builder_Module
        {

			/**
			 * __init
			 *
			 * @return void
			 */
            public function init(): void
            {
                $this->name 			= __( 'Register form', UTBF_TEXT_DOMAIN );
                $this->slug 			= 'et_pb_custom_register_form';
                $this->fb_support 	    = true;
            }

			/**
			 * Render
			 *
			 * @param array     $unprocessed_props      unprocessed_props
			 * @param string    $content                content
			 * @param string    $render_slug            render_slug
			 *
			 * @return string
			 */
			public function render($unprocessed_props,$content,$render_slug )
			{


				/* ob_start();

					get_template_part( 'template-parts/divi/modules/faqs/_index',null,[]);
					$template_part = ob_get_contents();

				ob_end_clean();

				return  $template_part; */

				return 'ok';

			}

        }

        new DiviModuleRegisterForm;
    }
}
