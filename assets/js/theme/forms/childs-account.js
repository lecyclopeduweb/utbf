/**
 * Childs WooCommerce account
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
        function scroll_top_after_success(){

            setTimeout(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 1);
            }, 200);
        }

        /**
         * Add Child
         *
         * @return {void}
         */
        function add_template_child(){
            //init
            let template = $('#template-add-child').html();
            const count = parseInt($('#ChildsAccountForm').attr('data-count'));
            //Update count
            $("#input_user__childs_repeater").val(count+1);
            $('#ChildsAccountForm').attr('data-count',count);
            //Change input name
            template = template.replace(/user__childs_repeater_number/g, `user__childs_repeater_${count}`);
            //Append
            $('#woocommerce-EditChildsAccountForm #ChildsAccountForm').append(template);
        }

        /**
         * Events
         */
        $("body").on("click", "#button-add-child", function(event) {
            add_template_child();
        });
        if ($('.woocommerce-message').length > 0) {
            scroll_top_after_success();
        }


    });
}(jQuery));
