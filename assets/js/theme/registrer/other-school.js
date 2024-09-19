/**
 * Other School
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function($){
    $(document).ready(function(){

        /**
         * Display
         *
         * @return {void}
         */
        function display_other_school(){
            if($("#user__child__school").val()=='autre'){
                $('#user__child__other_school').show();
            }else{
                $('#user__child__other_school').hide();
            }
        }

        /**
         * Events
         */
        $("#utbf-register-form").on("change", "#user__child__school", function(event) {
            display_other_school();
        });


    });
}(jQuery));
