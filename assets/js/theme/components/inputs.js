/**
 * Inputs Components
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function($){
    $(document).ready(function(){

        /**
         * Limit Input type number
         *
         * @param {JQuery<HTMLElement>} that - The jQuery object representing the clicked button. This is used for jQuery-specific operations.
         *
         * @return {void}
         */
        function limit_inputs_number(that){
            that.val(that.val().replace(/[^0-9]/g, ""));
        }

        /**
         * Events
         */
        $("body").on("input", "input[type=number]", function(event) {
            limit_inputs_number($(this));
        });

    });
}(jQuery));
