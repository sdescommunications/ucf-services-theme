// Adds filter method to array objects
// https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/Array/filter

/* jshint ignore:start */
if (!Array.prototype.filter) {
  Array.prototype.filter = function(a) {
    "use strict";
    if (this === void 0 || this === null) throw new TypeError;
    var b = Object(this);
    var c = b.length >>> 0;
    if (typeof a !== "function") throw new TypeError;
    var d = [];
    var e = arguments[1];
    for (var f = 0; f < c; f++) {
      if (f in b) {
        var g = b[f];
        if (a.call(e, g, f, b)) d.push(g)
      }
    }
    return d
  }
}
/* jshint ignore:end */


var WebcomAdmin = {};


WebcomAdmin.__init__ = function($){
  // Allows forms with input fields of type file to upload files
  $('input[type="file"]').parents('form').attr('enctype','multipart/form-data');
  $('input[type="file"]').parents('form').attr('encoding','multipart/form-data');
};


WebcomAdmin.utilityPageSections = function($){
  var cls      = this;
  cls.active   = null;
  cls.parent   = $('.i-am-a-fancy-admin');
  cls.sections = $('.i-am-a-fancy-admin .fields .section');
  cls.buttons  = $('.i-am-a-fancy-admin .sections .section a');
  cls.buttonWrap = $('.i-am-a-fancy-admin .sections');
  cls.sectionLinks = $('.i-am-a-fancy-admin .fields .section a[href^="#"]');

  this.showSection = function(){
    var button  = $(this);
    var href    = button.attr('href');
    var section = $(href);

    if (cls.buttonWrap.find('.section a[href="'+href+'"]') && section.is(cls.sections)) {
      // Switch active styles
      cls.buttons.removeClass('active');
      button.addClass('active');

      cls.active.hide();
      cls.active = section;
      cls.active.show();

      history.pushState({}, '', button.attr('href'));
      var http_referrer = cls.parent.find('input[name="_wp_http_referer"]');
      http_referrer.val(window.location);
      return false;
    }
  };

  this.__init__ = function(){
    cls.active = cls.sections.first();
    cls.sections.not(cls.active).hide();
    cls.buttons.first().addClass('active');
    cls.buttons.click(this.showSection);
    cls.sectionLinks.click(this.showSection);

    if (window.location.hash){
      cls.buttons.filter('[href="' + window.location.hash + '"]').click();
    }

    var fadeTimer = setInterval(function(){
      $('.updated').fadeOut(1000);
      clearInterval(fadeTimer);
    }, 2000);
  };

  if (cls.parent.length > 0){
    cls.__init__();
  }
};


/**
 * Adds file uploader functionality to File fields.
 * Mostly copied from https://codex.wordpress.org/Javascript_Reference/wp.media
 **/
WebcomAdmin.fileUploader = function($) {
  $('.meta-file-wrap').each(function() {
    var frame,
        $container = $(this),
        $field = $container.find('.meta-file-field'),
        $uploadBtn = $container.find('.meta-file-upload'),
        $deleteBtn = $container.find('.meta-file-delete'),
        $previewContainer = $container.find('.meta-file-preview');

    // Add new btn click
    $uploadBtn.on('click', function(e) {
      e.preventDefault();

      // If the media frame already exists, reopen it.
      if (frame) {
        frame.open();
        return;
      }

      // Create a new media frame
      frame = wp.media({
        title: 'Select or Upload a File',
        button: {
          text: 'Use this file'
        },
        multiple: false  // Set to true to allow multiple files to be selected
      });

      // When an image is selected in the media frame...
      frame.on('select', function() {

        // Get media attachment details from the frame state
        var attachment = frame.state().get('selection').first().toJSON();

        // Send the attachment URL to our custom image input field.
        $previewContainer.html( '<img src="' + attachment.iconOrThumb + '"><br>' + attachment.filename );

        // Send the attachment id to our hidden input
        $field.val(attachment.id);

        // Hide the add image link
        $uploadBtn.addClass('hidden');

        // Unhide the remove image link
        $deleteBtn.removeClass('hidden');
      });

      // Finally, open the modal on click
      frame.open();
    });

    // Delete selected btn click
    $deleteBtn.on('click', function(e) {
      e.preventDefault();

      // Clear out the preview image
      $previewContainer.html('No file selected.');

      // Un-hide the add image link
      $uploadBtn.removeClass('hidden');

      // Hide the delete image link
      $deleteBtn.addClass('hidden');

      // Delete the image id from the hidden input
      $field.val('');
    });
  });
};

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

WebcomAdmin.menuField = function($) {
  var $field = $('.meta-menu-field');
  if ($field.length) {
    var apiURL = WebcomLocal.menuApi;

    var updateMenu = function() {
      $.getJSON(apiURL + '/menus', function(data) {
        for(var i in data) {
          var menu = data[i];
          if ( $field.find( 'option[value=' + menu.ID + ']' ).length === 0 ) {
            $field.append('<option value="' + menu.ID + '">' + menu.name + '</option>');
          }
        }
      });
    };

    var onSelectUpdate = function(e) {
      var $field = $(this),
          value = $field.find('option:selected').val(),
          $edit = $field.parent().find('a.edit-menu');

      if (value) {
        $edit.attr('href', WebcomLocal.menuAdmin + '?action=edit&menu=' + value);
      } else {
        $edit.hide();
      }
    };

    if ( WebcomLocal.menuApi ) {
      setInterval(updateMenu, 5000);
    }

    $field.on('change', onSelectUpdate);
  }
};

WebcomAdmin.shortcodeInterfaceTool = function($) {
  var $cls                   = WebcomAdmin.shortcodeInterfaceTool;
  $cls.shortcodeForm         = $('#select-shortcode-form');
  $cls.shortcodeButton       = $cls.shortcodeForm.find('button');
  $cls.shortcodeSelect       = $cls.shortcodeForm.find('#shortcode-select');
  $cls.shortcodeEditors      = $cls.shortcodeForm.find('#shortcode-editors');
  $cls.shortcodeDescriptions = $cls.shortcodeForm.find('#shortcode-descriptions');

  $cls.shortcodeInsert = function(shortcode, parameters, enclosingText) {
    var text = '[' + shortcode;

    if (parameters) {
      for (var key in parameters) {
        text += " " + key + "=\"" + parameters[key] + "\"";
      }
    }

    text += "]";

    if (enclosingText) {
      text += enclosingText;
    }
    text += "[/" + shortcode + "]";

    send_to_editor(text);
  };

  $cls.shortcodeAction = function() {
    var $selected = $cls.shortcodeSelect.find(':selected');
    if ($selected.length < 1 || $selected.val() === '') { return; }

    var editor = $cls.shortcodeEditors.find('li.shortcode-' + $cls.shortcodeSelected),
        dummyText = $selected.attr('data-enclosing') || null,
        highlightedWysiwigText = tinymce.activeEditor ? tinymce.activeEditor.selection.getContent() : null,
        enclosingText = null;

    if (dummyText && highlightedWysiwigText) {
      enclosingText = highlightedWysiwigText;
    } else {
      enclosingText = dummyText;
    }

    var parameters = {};

    if (editor.length === 1) {
      editor.children().each(function() {
        var $formElement = $(this);
        switch($formElement.prop('tagName')) {
          case 'INPUT':
          case 'TEXTAREA':
          case 'SELECT':
            if ($formElement.prop('type') === 'checkbox') {
              parameters[$formElement.attr('data-parameter')] = String($formElement.prop('checked'));
            } else {
              parameters[$formElement.attr('data-parameter')] = $formElement.val();
            }
            break;
        }
      });
    }

    $cls.shortcodeInsert($selected.val(), parameters, enclosingText);
  };

  $cls.shortcodeSelectAction = function() {
    $cls.shortcodeSelected = $cls.shortcodeSelect.val();
    $cls.shortcodeEditors.find('li').hide();
    $cls.shortcodeDescriptions.find('li').hide();
    $cls.shortcodeEditors.find('.shortcode-' + $cls.shortcodeSelected).show();
    $cls.shortcodeDescriptions.find('.shortcode-' + $cls.shortcodeSelected).show();
  };

  $cls.shortcodeSelectAction();

  $cls.shortcodeSelect.change($cls.shortcodeSelectAction);

  $cls.shortcodeButton.click($cls.shortcodeAction);

};

(function($){
  WebcomAdmin.__init__($);
  WebcomAdmin.utilityPageSections($);
  WebcomAdmin.fileUploader($);
  WebcomAdmin.iconModal($);
  WebcomAdmin.menuField($);
  WebcomAdmin.shortcodeInterfaceTool($);
})(jQuery);
