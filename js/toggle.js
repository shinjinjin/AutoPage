$(document).ready(function() {
        $(".toggle").click(function() {
            $(this).toggleClass("active");
            $(".nav").slideToggle();
        });
    });
	//  另外加入 漢堡選單動畫
	var $lastOpened = false;
    $(".toggle").click(function () {
        if ($lastOpened) {
            $lastOpened.removeClass('open');
        }
    });
    $(document).on('click', '.toggle', function (event) {
        var el = $(event.currentTarget);
        event.preventDefault();
        event.stopPropagation();
        if (el.hasClass('open')) {
            el.removeClass('open');
        } else {
            if ($lastOpened) {
                $lastOpened.removeClass('open');
            }
            el.addClass('open');
            $lastOpened = el;
        }
    });