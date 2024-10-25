/**
 * Buttons
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function($){
    $(document).ready(function(){

        /**
         * Opens or closes the select menu
         *
         * @return {void}
         */
        function addClassMenu() {
            $('.select-items').addClass('select-show'); // Show the select items
        }

        /**
         * Handles the selection of an item in the menu
         *
         * @param {JQuery<HTMLElement>} item - The jQuery element representing the selected item.
         * @return {void}
         */
        function selectItem(item) {
            $('.select-selected').text(item.text()); // Update the displayed text
            $('.select-items').removeClass('select-show'); // Hide the select items
        }

        // Events
        // Handles the opening of the menu on click
        $('.select-selected').on('click', addClassMenu);

        // Handles the selection of an item on click
        $('.select-item').on('click', function() {
            selectItem($(this)); // Pass the clicked item to the function
        });

        $(document).on('click', function(event) {
            if (!$(event.target).closest('.select-selected, .select-items').length) {
                $('.select-items').removeClass('select-show'); // Hide the select items
            }
        });


    });
}(jQuery));
