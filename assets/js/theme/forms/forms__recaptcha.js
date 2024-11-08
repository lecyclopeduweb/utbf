/**
 * Forms Recaptcha
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function($){
    $(document).ready(function(){

        /**
         * recaptcha
         *
         * @param string    form_id             Form ID
         * @param string    submit_function     CallBack function
         *
         * @return {void}
         */
        window.forms_recaptcha = function(form_id,submit_function){

            grecaptcha.ready(function() {
                grecaptcha.execute(VAR.key_google_recaptcha, {action: 'submit'}).then(function(token) {
                    if (!$('input[name="recaptcha_response"]').length) {
                        $('<input>').attr({
                            type: 'hidden',
                            name: 'recaptcha_response',
                            value: token
                        }).appendTo(form_id);
                    } else {
                        $('input[name="recaptcha_response"]').val(token);
                    }

                    if (typeof submit_function === 'function') {
                        submit_function();
                    }
                });
            });

        }

    });
}(jQuery));
