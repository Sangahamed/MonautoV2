var resizeId;

$(document).ready(function($) {
    "use strict";

    //  Change tab button




    //  File input styling

    if ($("input[type=file].with-preview").length) {
        $("input.file-upload-input").MultiFile({
            list: ".file-upload-previews"
        });
    }

    $(".single-file-input input[type=file]").change(function() {
        previewImage(this);
    });

    $(".has-child a[href='#'].nav-link").on("click", function(e) {
        e.preventDefault();
        if (!$(this).parent().hasClass("hover")) {
            $(this).parent().addClass("hover");
        } else {
            $(this).parent().removeClass("hover");
        }
    });





    //  No UI Slider -------------------------------------------------------------------------------------------------------

    if ($('.ui-slider').length > 0) {


    }

});


function previewImage(input) {
    var ext = $(input).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) === -1) {
        alert('invalid extension!');
    } else {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(input).parents(".profile-image").find(".image").attr("style", "background-image: url('" + e.target.result + "');");
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
}

// Viewport ------------------------------------------------------------------------------------------------------------

var viewport = (function() {
    var viewPorts = ['xs', 'sm', 'md', 'lg'];

    var viewPortSize = function() {
        return window.getComputedStyle(document.body, ':before').content.replace(/"/g, '');
    };

    var is = function(size) {
        if (viewPorts.indexOf(size) === -1) throw "no valid viewport name given";
        return viewPortSize() === size;
    };

    var isEqualOrGreaterThan = function(size) {
        if (viewPorts.indexOf(size) === -1) throw "no valid viewport name given";
        return viewPorts.indexOf(viewPortSize()) >= viewPorts.indexOf(size);
    };

    // Public API
    return {
        is: is,
        isEqualOrGreaterThan: isEqualOrGreaterThan
    }

})();