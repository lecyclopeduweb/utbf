/**
 * Ajax Childs account
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function($){
    $(document).ready(function(){

        window.xhr = false;

        /**
         * scroll Top
         *
         * @return {void}
         */
        function scroll_top_child_account(){
            $('html, body').animate({
                scrollTop: ($('#woocommerce-EditChildsAccountForm').offset().top)-200
            }, 1);
        }

        /**
         * Ajax Send datas
         *
         * @return {void}
         */
        function childs_account__ajax(){

            if (window.xhr) {
                window.xhr.abort();
            }

             //init
            $('.error').hide();
            $('.woocommerce-message').hide();
            $('.woocommerce-notices-wrapper').hide();
            $('.woocommerce-message[role=alert]').remove();

            //init
            const form_values = $('#woocommerce-EditChildsAccountForm').serializeArray();

            //ArayData : Init
            const form_data = new FormData();
            $.each(form_values, function(index, field) {
                form_data.append(field.name, field.value);
            });

            //ArayData : medical_treatment
            $('#woocommerce-EditChildsAccountForm input[name^="user__childs_repeater_"]').each(function () {
                let field_name = $(this).attr('name');
                if (field_name.includes('user__child__medical_treatments')) {
                    const medical_treatment = $('input[name="' + field_name + '"]:checked').val();
                    if (medical_treatment === undefined) {
                        form_data.append(field_name, '');
                    }
                }
            });

            // Debug
            //console.log(results_form_data(form_data));

            //Send data
            form_data.append('action', 'utbf_ajax_childs_account_form');

            //AJAX
            window.xhr = $.ajax({
                url: AJAX_URL.url,
                method: 'POST',
                contentType: false,
                processData: false,
                data: form_data,
                success: function (response) {
                    let obj = jQuery.parseJSON(response);
                    //Error
                    if(obj.error!== undefined){
                        $.each(obj.error, function(field, errorMessage) {
                            $('.error.'+ field).show();
                            $('.error.'+ field).html(errorMessage);
                        });
                        $('.woocommerce-message-error').addClass('woocommerce-message');
                        $('.woocommerce-message-error').show();
                        scroll_top_child_account();
                    //Success
                    }else if(obj.success!== undefined){
                        location.reload();
                    }else{
                        $('.woocommerce-message-error-ajax').addClass('woocommerce-message');
                        $('.woocommerce-message-error-ajax').show();
                        scroll_top_child_account();
                    }
                },
                error: function (data) {
                     $('.woocommerce-message-error-ajax').addClass('woocommerce-message');
                    $('.woocommerce-message-error-ajax').show();
                    scroll_top_child_account();
                }
            });

        }

        /**
         * Events
         */
        $("#woocommerce-EditChildsAccountForm").on("click", "#EditChildsAccountForm-send", function(event) {
            childs_account__ajax();
        });


    });
}(jQuery));
