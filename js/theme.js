/**
 * Debug
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function ($) {
  $(document).ready(function () {
    /**
     *Debug form Data
     *
     * @return {void}
     */
    window.results_form_data = function (form_data) {
      var object = {};
      form_data.forEach(function (value, key) {
        object[key] = value;
      });
      return object;
    };
  });
})(jQuery);
/**
 * Ajax Childs account
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function ($) {
  $(document).ready(function () {
    window.xhr = false;

    /**
     * Ajax Send datas
     *
     * @return {void}
     */
    function ajax_childs_account_form() {
      if (window.xhr) {
        window.xhr.abort();
      }

      //init
      $('.error').hide();
      $('.woocommerce-message-error').hide();
      $('.woocommerce-message[role=alert]').remove();

      //init
      const form_values = $('#woocommerce-EditChildsAccountForm').serializeArray();

      //ArayData : Init
      const form_data = new FormData();
      $.each(form_values, function (index, field) {
        form_data.append(field.name, field.value);
      });

      //ArayData : medical_treatment
      $('#woocommerce-EditChildsAccountForm input[name^="user__childs_repeater_"]').each(function () {
        let field_name = $(this).attr('name');
        if (field_name.includes('user__child__medical_treatments')) {
          const medical_treatment = $('input[name="' + field_name + '"]:checked').val();
          if (medical_treatment === undefined) {
            form_data.append(field_name, '');
          }
        }
      });

      // Debug
      //console.log(results_form_data(form_data));

      //Send data
      form_data.append('action', 'utbf_ajax_childs_account_form');

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
          if (obj.error !== undefined) {
            console.log(obj.error);
            $.each(obj.error, function (field, errorMessage) {
              console.log(field);
              console.log(errorMessage);
              $('.error.' + field).show();
              $('.error.' + field).html(errorMessage);
            });
            $('html, body').animate({
              scrollTop: $('#woocommerce-EditChildsAccountForm').offset().top - 100
            }, 1);
            $('.woocommerce-message-error').addClass('woocommerce-message');
            $('.woocommerce-message-error').show();
          } else {
            let formData = $("#woocommerce-EditChildsAccountForm").serialize();
            $.post(window.location.href, formData, function (response) {
              location.reload();
              //For scrollTo view file childs-account.js
            });
          }
        },
        error: function (data) {}
      });
    }

    /**
     * Events
     */
    $("#woocommerce-EditChildsAccountForm").on("click", "#EditChildsAccountForm-send", function (event) {
      ajax_childs_account_form();
    });
  });
})(jQuery);
/**
 * Ajax Register Form
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function ($) {
  $(document).ready(function () {
    window.xhr = false;

    /**
     * Ajax Send datas
     *
     * @return {void}
     */
    function ajax_register_form() {
      if (window.xhr) {
        window.xhr.abort();
      }

      //init
      $('.error').hide();
      $('#utbf-register-form').find('.wrapper-loader').css('display', 'flex');
      const form_values = $('#utbf-register-form').serializeArray();

      //ArayData : Init
      const form_data = new FormData();
      $.each(form_values, function (index, field) {
        form_data.append(field.name, field.value);
      });

      //ArayData : Other School
      if ($('#user__child__school').val() != 'Autre') {
        form_data.delete('user__child__other_school');
      }

      //ArayData : medical_treatment
      const medical_treatment = $('input[name="user__child__medical_treatments"]:checked').val();
      if (medical_treatment === undefined) {
        form_data.append('user__child__medical_treatments', '');
      }

      // Debug
      //console.log(results_form_data(form_data));

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
          if (obj.error !== undefined) {
            $.each(obj.error, function (field, errorMessage) {
              $('.error.' + field).show();
              $('.error.' + field).html(errorMessage);
            });
            $('#utbf-register-form-error').css('display', 'flex');
          } else {
            $('#utbf-register-form').hide();
            $('#utbf-register-form-success').css('display', 'flex');
          }
          $('#utbf-register-form').find('.wrapper-loader').hide();
        },
        error: function (data) {}
      });
    }

    /**
     * Events
     */
    $("#utbf-register-form").on("click", "#utbf-register-form-send", function (event) {
      ajax_register_form();
    });
  });
})(jQuery);
/**
 * Childs WooCommerce account
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function ($) {
  $(document).ready(function () {
    /**
     * Scroll To After sucesss
     *
     * @return {void}
     */
    function scroll_top_after_success() {
      setTimeout(function () {
        $('html, body').animate({
          scrollTop: 0
        }, 1);
      }, 200);
    }

    /**
     * Add Child
     *
     * @return {void}
     */
    function add_template_child() {
      //init
      let template = $('#template-add-child').html();
      const count = parseInt($('#ChildsAccountForm').attr('data-count'));
      //Update count
      $("#input_user__childs_repeater").val(count + 1);
      $('#ChildsAccountForm').attr('data-count', count);
      //Change input name
      template = template.replace(/user__childs_repeater_number/g, `user__childs_repeater_${count}`);
      //Append
      $('#woocommerce-EditChildsAccountForm #ChildsAccountForm').append(template);
    }

    /**
     * Events
     */
    $("body").on("click", "#button-add-child", function (event) {
      add_template_child();
    });
    if ($('.woocommerce-message').length > 0) {
      scroll_top_after_success();
    }
  });
})(jQuery);
/**
 * Other School
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function ($) {
  $(document).ready(function () {
    /**
     * Display
     *
     * @param {JQuery<HTMLElement>} that - The jQuery object representing the clicked button. This is used for jQuery-specific operations.
     *
     * @return {void}
     */
    function display_other_school(that) {
      let parent = that.closest('.utbf-user-child-form');
      if (that.val() == 'Autre') {
        parent.find('.user__child__other_school').show();
      } else {
        parent.find('.user__child__other_school').removeClass('show');
        parent.find('.user__child__other_school').hide();
        parent.find('.user__child__other_school').find('input').val('');
      }
    }

    /**
     * Events
     */
    $("body").on("change", ".user__child__school", function (event) {
      display_other_school($(this));
    });
  });
})(jQuery);