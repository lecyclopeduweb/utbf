/**
 * Change display user-edit.php
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function ($) {
  $(document).ready(function () {
    /**
     * Change tabs
     *
     * @param {JQuery<HTMLElement>} that - The jQuery object representing the clicked button. This is used for jQuery-specific operations.
     *
     * @return {void}
     */
    function change_tabs(that) {
      let link = that.attr('data-link');
      $('.nav-tab').removeClass('nav-tab-active');
      that.addClass('nav-tab-active');
      $('h2, .form-table').hide();
      if (link == 'infos') {
        $('#h2-rich_editing, #form-table-user_login,#form-table-email,#h2-pass1,#form-table-pass1').show();
      } else if (link == 'addresses') {
        $('#h2-billing_first_name, #h2-copy_billing, #form-table-billing_first_name, #form-table-copy_billing, #form-table-billing_phone_2, #form-table-shipping_phone_2').show();
      } else if (link == 'legal_guardian') {
        $('#h2-user__legal_guardian__last_name, #form-table-user__legal_guardian__last_name').show();
      } else if (link == 'childs') {
        $('#h2-user__childs_repeater, #form-table-user__childs_repeater').show();
      }
    }

    /**
     * Add ID
     *
     * @return {void}
     */
    function add_ids_your_profile() {
      $('.form-table').each(function () {
        var first_id = null;
        $(this).find('label').each(function () {
          var current_id = $(this).attr('for');
          if (current_id) {
            first_id = current_id;
            return false;
          }
        });

        //For ACF
        if (first_id.indexOf('acf-field') !== -1) {
          $(this).find('tbody tr').each(function () {
            var current_id = $(this).attr('data-name');
            if (current_id) {
              first_id = current_id;
              return false;
            }
          });
        }
        if (first_id) {
          // Add the ID to the <h2> before the table
          $(this).prev('h2').attr('id', 'h2-' + first_id);

          // Add an ID to the table based on the first ID of the <tr>
          $(this).attr('id', 'form-table-' + first_id);
        }
      });
    }

    /**
     * Events
     */
    if ($("#your-profile").length) {
      add_ids_your_profile();
      $("body").off("click", ".nav-tab").on("click", ".nav-tab", function (event) {
        event.preventDefault();
        change_tabs($(this));
      });
    }
  });
})(jQuery);