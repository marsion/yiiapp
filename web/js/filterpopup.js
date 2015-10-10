function dump(obj) {
    var out = "";
    if (obj && typeof(obj) == "object") {
        for (var i in obj) {
            out += i + ": " + obj[i] + "\n";
        }
    } else {
        out = obj;
    }
    alert(out);
};

$(document).ready(function () {
    $('.filterPopupButton').click(function () {
        if ($('.filterPopup').is(':visible')) {
            $('.filterPopup').fadeOut();
        } else {
            var popup = $('.filterPopup');
            var button = $('.filterPopupButton');
            var popupHeight = popup.outerHeight();
            var buttonHeight = button.outerHeight();
            var normalTop = popupHeight / 2 - buttonHeight / 2;

            var topOffsetWindow = button.offset().top - $(window).scrollTop() - 20;
            var bottomOffsetWindow = $(window).height() - ( topOffsetWindow + buttonHeight) -40;

            var top;
            if (topOffsetWindow < normalTop) {
                top = (topOffsetWindow > 0) ? topOffsetWindow * -1 : 0;
            } else if (bottomOffsetWindow < normalTop) {
                top = (bottomOffsetWindow > 0) ? (popupHeight - bottomOffsetWindow - buttonHeight) * -1
                    : (popupHeight - buttonHeight) * -1;
            } else {
                top = normalTop * -1;
            }
            var right = button.outerWidth() + 30 + 'px';
            popup.css({'right': right, 'top': top});
            popup.fadeIn();
        }

    });


});

$(document).ready(function () {
    $('.filterPopupCloseIcon').click(function () {
        if ($('.filterPopup').is(':visible')) {
            $('.filterPopup').fadeOut();
        }
    })
});
