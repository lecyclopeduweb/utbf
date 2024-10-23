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
 * Add Select Childs WooCommerce Single Product
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function ($) {
  $(document).ready(function () {
    /**
     * Init max Qty
     *
     * @return {void}
     */
    function childs_single_product__init_max_qty() {
      $('body.single-product input.qty').attr('max', CHILDS.count);
    }

    /**
     * Controle QTY
     *
     * @return {int}
     */
    function childs_single_product__controle_qty() {
      //init
      let qty = parseInt($('body.single-product input.qty').val(), 10);
      let childsCount = parseInt(CHILDS.count, 10);

      //Limite Max Qty
      if (qty > childsCount) {
        $('body.single-product input.qty').val(childsCount);
        qty = childsCount;
      }
      //Limite Qty Negative
      if (Number(qty) < 0) {
        $('body.single-product input.qty').val(1);
        qty = 1;
      }
      return qty;
    }

    /**
     * Add Select Child
     *
     * @return {void}
     */
    function childs_single_product__addRemove_select() {
      //init
      let selectChildHtml = $('.single-product-childs').find('.single-product-childs__item').first().prop('outerHTML');
      let countSelectChild = $('.single-product-childs').children().length;
      let qty = childs_single_product__controle_qty();

      //Add || Remove select
      if (qty > countSelectChild) {
        let numberAddSelect = qty - countSelectChild;
        let regex = new RegExp('childs\\[0\\]', 'g');
        let regex2 = new RegExp('<span class="number">1<\\/span>', 'g');
        for (let i = 0; i < numberAddSelect; i++) {
          let updatedHtml = selectChildHtml.replace(regex, "childs[" + countSelectChild + "]").replace(regex2, '<span class="number">' + (countSelectChild + 1) + '</span>');
          $('.single-product-childs').append(updatedHtml);
          countSelectChild++;
        }
      } else {
        let numberRemoveSelect = countSelectChild - qty;
        if (numberRemoveSelect > 0) {
          $('.single-product-childs').children().slice(-numberRemoveSelect).remove();
        }
      }
    }

    /**
     * Events
     */
    childs_single_product__init_max_qty();
    $("body.single-product").on("change", "input.qty", function (event) {
      childs_single_product__addRemove_select();
    });
  });
})(jQuery);
/**
 * Add Childs WooCommerce account
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function ($) {
  $(document).ready(function () {
    /**
     * Add Child
     *
     * @return {void}
     */
    function childs_account__add() {
      //init
      let template = $('#template-add-child').html();
      const count = parseInt($('#ChildsAccountForm').attr('data-count'));
      //Update count
      $("#input_user__childs_repeater").val(count + 1);
      $('#ChildsAccountForm').attr('data-count', count + 1);
      //Change input name
      template = template.replace(/user__childs_repeater_number/g, `user__childs_repeater_${count}`);
      template = template.replace(/data_number/g, `${count}`);
      //Append
      $('#woocommerce-EditChildsAccountForm #ChildsAccountForm').append(template);
      //remove hr
      $('#ChildsAccountForm hr[data-child=0]').remove();
    }

    /**
     * Events
     */
    $("body").on("click", "#button-add-child", function (event) {
      childs_account__add();
    });
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
     * scroll Top
     *
     * @return {void}
     */
    function scroll_top_child_account() {
      $('html, body').animate({
        scrollTop: $('#woocommerce-EditChildsAccountForm').offset().top - 200
      }, 1);
    }

    /**
     * Ajax Send datas
     *
     * @return {void}
     */
    function childs_account__ajax() {
      if (window.xhr) {
        window.xhr.abort();
      }

      //init
      $('.error').hide();
      $('.woocommerce-message').hide();
      $('.woocommerce-notices-wrapper').hide();
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
            $.each(obj.error, function (field, errorMessage) {
              $('.error.' + field).show();
              $('.error.' + field).html(errorMessage);
            });
            $('.woocommerce-message-error').addClass('woocommerce-message');
            $('.woocommerce-message-error').show();
            scroll_top_child_account();
            //Success
          } else if (obj.success !== undefined) {
            location.reload();
          } else {
            $('.woocommerce-message-error-ajax').addClass('woocommerce-message');
            $('.woocommerce-message-error-ajax').show();
            scroll_top_child_account();
          }
        },
        error: function (data) {
          $('.woocommerce-message-error-ajax').addClass('woocommerce-message');
          $('.woocommerce-message-error-ajax').show();
          scroll_top_child_account();
        }
      });
    }

    /**
     * Events
     */
    $("#woocommerce-EditChildsAccountForm").on("click", "#EditChildsAccountForm-send", function (event) {
      childs_account__ajax();
    });
  });
})(jQuery);
/**
 * Delete Childs WooCommerce account
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function ($) {
  $(document).ready(function () {
    /**
     * delete Child
     *
     * @param {JQuery<HTMLElement>} that - The jQuery object representing the clicked button. This is used for jQuery-specific operations.
     *
     * @return {void}
     */
    function childs_account__delete(that) {
      //init
      const count = parseInt($('#ChildsAccountForm').attr('data-count'));
      //Update count
      $("#input_user__childs_repeater").val(count - 1);
      $('#ChildsAccountForm').attr('data-count', count - 1);
      //Pos
      const pos = that.attr('data-child');
      //Remove item
      $('#ChildsAccountForm .wrapper-item-child[data-child=' + pos + ']').remove();
      //reindex
      $('#ChildsAccountForm .wrapper-item-child').each(function (index, element) {
        let child_html = $(this).html();
        child_html = child_html.replace(/user__childs_repeater_\d+/g, `user__childs_repeater_${index}`);
        child_html = child_html.replace(/data-child="\d*"/g, `data-child="${index}"`);
        $(this).empty();
        $(this).html(child_html);
        $(this).attr('data-child', index);
      });
      //Remove hr
      $('#ChildsAccountForm hr[data-child=' + pos + ']').remove();
    }

    /**
     * Events
     */
    $("body").on("click", ".item-child-delete", function (event) {
      if (confirm(VAR.confirm_delete_child)) {
        childs_account__delete($(this));
      }
    });
  });
})(jQuery);
/**
 * Scroll Childs WooCommerce account
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
    function childs_account__scroll() {
      setTimeout(function () {
        $('html, body').animate({
          scrollTop: 0
        }, 1);
      }, 200);
    }

    /**
     * Events
     */
    if ($('.woocommerce-message').length > 0) {
      childs_account__scroll();
    }
  });
})(jQuery);
/**
 * Toggle Childs WooCommerce account
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function ($) {
  $(document).ready(function () {
    /**
     * Display Childs toggle
     *
     * @param {JQuery<HTMLElement>} that - The jQuery object representing the clicked button. This is used for jQuery-specific operations.
     *
     * @return {void}
     */
    function childs_account__toggle(that) {
      let number = that.attr('data-child');
      $('.item-child[data-child=' + number + ']').toggleClass('visible');
      that.toggleClass('active');
    }

    /**
     * Events
     */
    $("#woocommerce-EditChildsAccountForm").on("click", ".toggle-button", function (event) {
      childs_account__toggle($(this));
    });
  });
})(jQuery);
/**
 * Ajax Legal Guardian account
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function ($) {
  $(document).ready(function () {
    window.xhr = false;

    /**
     * scroll Top
     *
     * @return {void}
     */
    function scroll_top_legal_guardian_account() {
      $('html, body').animate({
        scrollTop: $('#woocommerce-EditLegalGuardianAccountForm').offset().top - 200
      }, 1);
    }

    /**
     * Ajax Send datas
     *
     * @return {void}
     */
    function legal_guardian_account__ajax() {
      if (window.xhr) {
        window.xhr.abort();
      }

      //init
      $('.error').hide();
      $('.woocommerce-message').hide();
      $('.woocommerce-notices-wrapper').hide();
      $('.woocommerce-message[role=alert]').remove();

      //init
      const form_values = $('#woocommerce-EditLegalGuardianAccountForm').serializeArray();

      //ArayData : Init
      const form_data = new FormData();
      $.each(form_values, function (index, field) {
        form_data.append(field.name, field.value);
      });

      // Debug
      //console.log(results_form_data(form_data));

      //Send data
      form_data.append('action', 'utbf_ajax_legal_guardian_account_form');

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
            $('.woocommerce-message-error').addClass('woocommerce-message');
            $('.woocommerce-message-error').show();
            scroll_top_legal_guardian_account();
            //Success
          } else if (obj.success !== undefined) {
            location.reload();
          } else {
            $('.woocommerce-message-error-ajax').addClass('woocommerce-message');
            $('.woocommerce-message-error-ajax').show();
            scroll_top_legal_guardian_account();
          }
        },
        error: function (data) {
          $('.woocommerce-message-error-ajax').addClass('woocommerce-message');
          $('.woocommerce-message-error-ajax').show();
          scroll_top_legal_guardian_account();
        }
      });
    }

    /**
     * Events
     */
    $("#woocommerce-EditLegalGuardianAccountForm").on("click", "#EditLegalGuardianAccountForm-send", function (event) {
      legal_guardian_account__ajax();
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
    function register__ajax() {
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
      register__ajax();
    });
  });
})(jQuery);