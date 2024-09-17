/**
 * Ajax Register Form
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
        function ajax_register_form(){

            if (window.xhr) {
                window.xhr.abort();
            }

            //init
            $('.error').hide();
            $('#utbf-register-form').find('.wrapper-loader').css('display','flex');
            $('#utbf-register-form').find('.loader-overlay').show();

            const form_values = $('#utbf-register-form').serializeArray();

            //ArayData
            var form_data = new FormData();
            $.each(form_values, function(index, field) {
                form_data.append(field.name, field.value);
            });

            //Send data
            form_data.append('action', 'utbf_ajax_register_form');

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
                    }else{
                        $('#utbf-register-form').hide();
                        $('#utbf-register-form-success').css('display','flex');
                    }
                    $('#utbf-register-form').find('.wrapper-loader').hide();
                    $('#utbf-register-form').find('.loader-overlay').hide();
                },
                error: function (data) {
                }
            });

        }

        /**
         * Events
         */
        $("#utbf-register-form").on("click", "#utbf-register-form-send", function(event) {
            ajax_register_form();
        });


    });
}(jQuery));
