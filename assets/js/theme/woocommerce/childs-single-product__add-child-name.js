/**
 * Add Select Childs WooCommerce Single Product
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function($){
    $(document).ready(function(){


        /**
         * Add Child name
         *
         * @param {JQuery<HTMLElement>} that - The jQuery object representing the clicked button. This is used for jQuery-specific operations.
         *
         * @return {void}
         */
        function childs_single_product__add_child_name(that){

            let parent = that.closest('.single-product-childs__name');
            let first_name = that.find('option:selected').attr('first-name');
            let last_name = that.find('option:selected').attr('last-name');
            let birthday = that.find('option:selected').attr('birthday');
            let medical_treatments = that.find('option:selected').attr('medical-treatments');
            let specific_aspects = that.find('option:selected').attr('specific-aspects');
            let recommendations = that.find('option:selected').attr('recommendations');

            parent.find('.child-first-name').val(first_name);
            parent.find('.child-last-name').val(last_name);
            parent.find('.child-birthday').val(birthday);
            parent.find('.child-medical-treatments').val(medical_treatments);
            parent.find('.child-specific-aspects').val(specific_aspects);
            parent.find('.child-recommendations').val(recommendations);

        }

        /**
         * Events
         */
        $("body.single-product").on("change", "select.child-name", function(event) {
            childs_single_product__add_child_name($(this));
        });

    });
}(jQuery));
