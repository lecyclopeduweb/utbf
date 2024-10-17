<?php

declare (strict_types = 1);

namespace AppUtbf\WooCommerce;

use AppUtbf\Users\Childs;
/**
 * SingleProduct
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class SingleProduct
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        add_shortcode('utbf_single_product_user_form', [$this, 'user_form']);

    }

    /**
     * User Form
     *
     * @return string
     */
    public function user_form():string
    {

        $childs = new Childs;

        ob_start();

            get_template_part( 'template-parts/woocommerce/single-product/user-form',null,[
                'childs' => $childs->get_childs(),
            ]);
            $template_part = ob_get_contents();

        ob_end_clean();

        return  $template_part;

    }

}
