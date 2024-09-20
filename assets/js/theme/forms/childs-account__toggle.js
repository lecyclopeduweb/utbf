/**
 * Toggle Childs WooCommerce account
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function($){
    $(document).ready(function(){

        /**
         * Display Childs toggle
         *
         * @param {JQuery<HTMLElement>} that - The jQuery object representing the clicked button. This is used for jQuery-specific operations.
         *
         * @return {void}
         */
        function childs_account__toggle(that){

            let number = that.attr('data-child');
            $('.item-child[data-child='+number+']').toggleClass('visible');
            that.toggleClass('active');

        }

        /**
         * Events
         */
        $("#woocommerce-EditChildsAccountForm").on("click", ".toggle-button", function(event) {
            childs_account__toggle($(this));
        });


    });
}(jQuery));
