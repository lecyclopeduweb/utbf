/**
 * Add Childs WooCommerce account
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function($){
    $(document).ready(function(){

        /**
         * Add Child
         *
         * @return {void}
         */
        function childs_account__add(){
            //init
            let template = $('#template-add-child').html();
            const count = parseInt($('#ChildsAccountForm').attr('data-count'));
            //Update count
            $("#input_user__childs_repeater").val(count+1);
            $('#ChildsAccountForm').attr('data-count',count+1);
            //Change input name
            template = template.replace(/user__childs_repeater_number/g, `user__childs_repeater_${count}`);
            template = template.replace(/data_number/g, `${count}`);
            //Append
            $('#woocommerce-EditChildsAccountForm #ChildsAccountForm').append(template);
            //remove hr
            $('#ChildsAccountForm hr[data-child=0]').remove();
        }

        /**
         * Events
         */
        $("body").on("click", "#button-add-child", function(event) {
            childs_account__add();
        });

    });
}(jQuery));
