/**
 * Ajax Legal Guardian account
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
        function scroll_top_legal_guardian_account(){
            $('html, body').animate({
                scrollTop: ($('#woocommerce-EditLegalGuardianAccountForm').offset().top)-200
            }, 1);
        }

        /**
         * Ajax Send datas
         *
         * @return {void}
         */
        function legal_guardian_account__ajax(){

            if (window.xhr) {
                window.xhr.abort();
            }

             //init
            $('.error').hide();
            $('.woocommerce-message').hide();
            $('.woocommerce-notices-wrapper').hide();
            $('.woocommerce-message[role=alert]').remove();

            //init
            const form_values = $('#woocommerce-EditLegalGuardianAccountForm').serializeArray();

            //ArayData : Init
            const form_data = new FormData();
            $.each(form_values, function(index, field) {
                form_data.append(field.name, field.value);
            });

            // Debug
            //console.log(results_form_data(form_data));

            //Send data
            form_data.append('action', 'utbf_ajax_legal_guardian_account_form');

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
                        scroll_top_legal_guardian_account();
                    //Success
                    }else if(obj.success!== undefined){
                        location.reload();
                    }else{
                        $('.woocommerce-message-error-ajax').addClass('woocommerce-message');
                        $('.woocommerce-message-error-ajax').show();
                        scroll_top_legal_guardian_account();
                    }
                },
                error: function (data) {
                     $('.woocommerce-message-error-ajax').addClass('woocommerce-message');
                    $('.woocommerce-message-error-ajax').show();
                    scroll_top_legal_guardian_account();
                }
            });

        }

        /**
         * Events
         */
        $("#woocommerce-EditLegalGuardianAccountForm").on("click", "#EditLegalGuardianAccountForm-send", function(event) {
            legal_guardian_account__ajax();
        });


    });
}(jQuery));
