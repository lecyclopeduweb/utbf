/**
 * Page cart : remove Qunatity input
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function($){
    $(document).ready(function(){

        /**
         * remove quantity
         *
         * @return {void}
         */
        function cart__remove_qualtity(){
            $('.wc-block-components-quantity-selector').each(function() {
                $(this).remove();
            });
        }


        /**
         * Events
         */
        if($('body').hasClass('woocommerce-cart')){
            cart__remove_qualtity();
        };

    });
}(jQuery));
