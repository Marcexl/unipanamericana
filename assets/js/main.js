"use strict";
$(document).ready(function(){
    var o = $(window);
    $(".Header").addClass("Header-home");
    var a = $(".Header-home");
    o.on("load scroll", function () {
        60 < o.scrollTop() ? a.addClass("show-back") : a.removeClass("show-back");
    });
    var e = $(".Header").outerHeight(),
        l = $(".go-to"),
        t = $("body, html");
    l.on({
        click: function (o) {
            o.preventDefault(),
                (function (o) {
                    var a = $(o).offset().top - e;
                    t.animate({ scrollTop: a }, 800, "swing");
                })($(this).attr("href"));
        },
    }),
        $(".owl-carousel").owlCarousel({ loop: !0, margin: 10, nav: !1, dots: !0, items: 1, autoplay: !0, autoplayTimeout: 6e3, autoplaySpeed: 1e3 });
    var s = $(".Pop");
    $("#close-modal").on("click", function () {
        s.addClass("close");
    });
});
