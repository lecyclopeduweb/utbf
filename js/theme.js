/**
 * Debug
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function ($) {
  $(document).ready(function () {
    window.xhr = false;

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
 * Other School
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function ($) {
  $(document).ready(function () {
    /**
     * Display
     *
     * @return {void}
     */
    function display_other_school() {
      if ($("#user__child__school").val() == 'Autre') {
        $('#user__child__other_school').show();
      } else {
        $('#user__child__other_school').hide();
      }
    }

    /**
     * Events
     */
    $("#utbf-register-form").on("change", "#user__child__school", function (event) {
      display_other_school();
    });
  });
})(jQuery);