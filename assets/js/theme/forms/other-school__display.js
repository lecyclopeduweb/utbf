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
         * @param {JQuery<HTMLElement>} that - The jQuery object representing the clicked button. This is used for jQuery-specific operations.
         *
         * @return {void}
         */
        function display_other_school(that){
            let parent = that.closest('.utbf-user-child-form');
            if(that.val()=='Autre'){
                parent.find('.user__child__other_school').show();
            }else{
                parent.find('.user__child__other_school').removeClass('show');
                parent.find('.user__child__other_school').hide();
                parent.find('.user__child__other_school').find('input').val('');
            }
        }

        /**
         * Events
         */
        $("body").on("change", ".user__child__school", function(event) {
            display_other_school($(this));
        });


    });
}(jQuery));
