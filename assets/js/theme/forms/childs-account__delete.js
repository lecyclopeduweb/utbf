/**
 * Delete Childs WooCommerce account
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function($){
    $(document).ready(function(){

        /**
         * delete Child
         *
         * @param {JQuery<HTMLElement>} that - The jQuery object representing the clicked button. This is used for jQuery-specific operations.
         *
         * @return {void}
         */
        function childs_account__delete(that){
            //init
            let count = parseInt($('#ChildsAccountForm').attr('data-count'));
            //Update count
            $("#input_user__childs_repeater").val(count-1);
            $('#ChildsAccountForm').attr('data-count',count-1);
            //Pos
            let pos = that.attr('data-child');
            //Remove item
            $('#ChildsAccountForm .wrapper-item-child[data-child='+pos+']').remove();
            //reindex
            $('#ChildsAccountForm .wrapper-item-child').each(function(index, element) {
                let child_html =  $(this).html();
                child_html = child_html.replace(/user__childs_repeater_\d+/g, `user__childs_repeater_${index}`);
                child_html = child_html.replace(/data-child="\d*"/g, `data-child="${index}"`);
                $(this).empty();
                $(this).html(child_html);
                $(this).attr('data-child',index);
            });
            //Save data
            childs_account__ajax();
        }

        /**
         * Events
         */
        $("body").on("click", ".item-child-delete", function(event) {
            if(confirm(VAR.confirm_delete_child)){
                childs_account__delete($(this));
            }
        });

    });
}(jQuery));
