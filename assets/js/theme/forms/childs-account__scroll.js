/**
 * Scroll Childs WooCommerce account
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function($){
    $(document).ready(function(){

        /**
         * Scroll To After sucesss
         *
         * @return {void}
         */
        function childs_account__scroll(){

            setTimeout(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 1);
            }, 200);
        }

        /**
         * Events
         */
        if ($('.woocommerce-message').length > 0) {
            childs_account__scroll();
        }


    });
}(jQuery));
