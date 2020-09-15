$(function(){
    'use strict';

    $(document).on('click', '.field-performance-avatar_image .fileinput-remove-button', function () {
        $('.field-performance-avatar_image .file-drop-zone').append(`<input type="hidden" name="token1" value="1">`);
    });

    $(document).on('click', '.field-performance-banner_image .fileinput-remove-button', function () {
        $('.field-performance-banner_image .file-drop-zone').append(`<input type="hidden" name="token2" value="2">`);
    });

    $(document).on('click', '.fileinput-remove-button', function () {
        $('.file-drop-zone').append(`<input type="hidden" name="token" value="1">`);
    });



    //button disabled
    $(document).on("beforeValidate", "form", function() {
        $(this).find(':submit').attr('disabled', true);
    }).on("afterValidate", "form", function(event, messages, errorAttributes) {
        if (errorAttributes.length > 0) {
            $(this).find(':submit').attr('disabled', false);
        }
    });

});
