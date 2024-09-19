/**
 * Debug
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function($){
    $(document).ready(function(){

        window.xhr = false;

        /**
         *Debug form Data
         *
         * @return {void}
         */
        window.results_form_data = function(form_data){
            var object = {};
            form_data.forEach(function(value, key) {
                object[key] = value;
            });
            return object;
        }



    });
}(jQuery));
