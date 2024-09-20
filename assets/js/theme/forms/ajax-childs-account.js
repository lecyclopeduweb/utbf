/**
 * Ajax Childs account
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function($){
    $(document).ready(function(){

        window.xhr = false;

        /**
         * Ajax Send datas
         *
         * @return {void}
         */
        function ajax_childs_account_form(){

            if (window.xhr) {
                window.xhr.abort();
            }

             //init
            $('.error').hide();
            $('.woocommerce-message-error').hide();
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
                        console.log(obj.error);
                        $.each(obj.error, function(field, errorMessage) {
                            console.log(field);
                            console.log(errorMessage);
                                $('.error.'+ field).show();
                                $('.error.'+ field).html(errorMessage);
                        });
                        $('html, body').animate({
                            scrollTop: ($('#woocommerce-EditChildsAccountForm').offset().top)-100
                        }, 1);
                        $('.woocommerce-message-error').addClass('woocommerce-message');
                        $('.woocommerce-message-error').show();
                    }else{
                        let formData = $("#woocommerce-EditChildsAccountForm").serialize();
                        $.post(window.location.href, formData, function(response) {
                            location.reload();
                            //For scrollTo view file childs-account.js
                        });
                    }
                },
                error: function (data) {
                }
            });

        }

        /**
         * Events
         */
        $("#woocommerce-EditChildsAccountForm").on("click", "#EditChildsAccountForm-send", function(event) {
            ajax_childs_account_form();
        });


    });
}(jQuery));
