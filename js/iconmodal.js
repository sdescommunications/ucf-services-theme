/* global jQuery, WebcomAdmin */
if ( 'undefined' === typeof WebcomAdmin) { WebcomAdmin = {}; }

/** @see https://github.com/UCF/Students-Theme/blob/87dca3074cb48bef5d811789cf9a07c9eac55cd1/src/js/admin.js#L163-L218 */
WebcomAdmin.iconModal = function($) {
  $('.meta-icon-toggle').on('click', function(e) {
    var fieldId = $(this).parent().parent().find('.meta-icon-field').attr('id'),
        $modalInput = $('#meta-icon-field-id'),
        currentVal = $('#' + fieldId).val();

    if (fieldId && $modalInput) {
      $modalInput.val(fieldId);

      if (currentVal) {
        var $currentIcon = $('i[data-icon-value="' + currentVal + '"]').parent();
        $currentIcon.addClass('selected');
        setTimeout( function() {
          $('#TB_ajaxContent').animate({
            scrollTop: $currentIcon.position().top - 48
          }, 100);
        }, 750);
      }
    }
  });
  
  $('.meta-fa-icon').on('click', function(e) {
    $('.meta-fa-icon').removeClass('selected');
    $(this).addClass('selected');
  });

  $('#meta-icon-search').on('keyup', function() {
    var q = $(this).val();
    if (q === '') {
      $('.meta-fa-icon').show();
    } else {
      $('.meta-fa-icon').hide();
      $('i[class*="' + q + '"]').parent().show();
    }
  });

  $('#meta-icon-submit').on('click', function() {
    var selectedVal  = $('.meta-fa-icon.selected').find('i').attr('data-icon-value'),
        $modalInput = $('#meta-icon-field-id'),
        $field = $('#' + $modalInput.val().replace('[', '\\[').replace(']', '\\]')),
        $iconPreview = $field.parent().find('i');

    if (selectedVal) {
      $field.val(selectedVal);
      if ($iconPreview.length) {
        $iconPreview.attr('class', 'fa ' + selectedVal + ' fa-preview');
      } else {
        $icon = $('<i class="fa ' + selectedVal + ' fa-preview"></i>');
        $field.parent().prepend($icon);
      }
    }

    tb_remove();

  });
};

jQuery(function() {
  WebcomAdmin.iconModal( jQuery );
});
