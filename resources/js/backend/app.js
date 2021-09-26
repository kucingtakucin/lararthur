require('./bootstrap');

(function ($) {
    "use strict";
    $(document).on('click', function (e) {
        var outside_space = $(".outside");
        if (!outside_space.is(e.target) &&
            outside_space.has(e.target).length === 0) {
            $(".menu-to-be-close").removeClass("d-block");
            $('.menu-to-be-close').css('display', 'none');
        }
    })

    $('.prooduct-details-box .close').on('click', function (e) {
        var tets = $(this).parent().parent().parent().parent().addClass('d-none');
        console.log(tets);
    })

    /*----------------------------------------
     passward show hide
     ----------------------------------------*/
    $('.show-hide').show();
    $('.show-hide span').addClass('show');

    $('.show-hide span').click(function () {
        if ($(this).hasClass('show')) {
            $('input#password[name="password"]').prop('type', 'text');
            $('input#confirm-password[name="password_confirmation"]').prop('type', 'text');
            $(this).removeClass('show');
        } else {
            $('input#password[name="password"]').prop('type', 'password');
            $('input#confirm-password[name="password_confirmation"]').prop('type', 'text');
            $(this).addClass('show');
        }
    });

    $('form#form-login button[type="submit"]').on('click', function () {
        $('.show-hide span').addClass('show');
        $('.show-hide').parent().find('input#password[name="password"]').prop('type', 'password');
    });

    $('form#form-register button[type="submit"]').on('click', function () {
        $('.show-hide span').addClass('show');
        $('.show-hide').parent().find('input#password[name="password"]').prop('type', 'password');
        $('.show-hide').parent().find('input#password-confirm[name="password_confirmation"]').prop('type', 'password');
    });

    /*=====================
      02. Background Image js
      ==========================*/
    $(".bg-center").parent().addClass('b-center');
    $(".bg-img-cover").parent().addClass('bg-size');
    $('.bg-img-cover').each(function () {
        var el = $(this),
            src = el.attr('src'),
            parent = el.parent();
        parent.css({
            'background-image': 'url(' + src + ')',
            'background-size': 'cover',
            'background-position': 'center',
            'display': 'block'
        });
        el.hide();
    });

    $(".mega-menu-container").css("display", "none");
    $(".header-search").click(function () {
        $(".search-full").addClass("open");
    });
    $(".close-search").click(function () {
        $(".search-full").removeClass("open");
        $("body").removeClass("offcanvas");
    });
    $(".mobile-toggle").click(function () {
        $(".nav-menus").toggleClass("open");
    });
    $(".mobile-toggle-left").click(function () {
        $(".left-header").toggleClass("open");
    });
    $(".bookmark-search").click(function () {
        $(".form-control-search").toggleClass("open");
    })
    $(".filter-toggle").click(function () {
        $(".product-sidebar").toggleClass("open");
    });
    $(".toggle-data").click(function () {
        $(".product-wrapper").toggleClass("sidebaron");
    });
    $(".form-control-search input").keyup(function (e) {
        if (e.target.value) {
            $(".page-wrapper").addClass("offcanvas-bookmark");
        } else {
            $(".page-wrapper").removeClass("offcanvas-bookmark");
        }
    });
    $(".search-full input").keyup(function (e) {
        console.log(e.target.value);
        if (e.target.value) {
            $("body").addClass("offcanvas");
        } else {
            $("body").removeClass("offcanvas");
        }
    });

    $('body').keydown(function (e) {
        if (e.keyCode == 27) {
            $('.search-full input').val('');
            $('.form-control-search input').val('');
            $('.page-wrapper').removeClass('offcanvas-bookmark');
            $('.search-full').removeClass('open');
            $('.search-form .form-control-search').removeClass('open');
            $("body").removeClass("offcanvas");
        }
    });

    if (eval(localStorage.getItem('darkMode'))) {
        $('.mode i').addClass('fa-lightbulb-o').removeClass('fa-moon-o')
        $('body').addClass('dark-only')
        $('div.login-card').addClass('bg-dark')
        $('div.login-main').addClass('bg-dark')

    } else {
        $('.mode i').addClass('fa-moon-o').removeClass('fa-lightbulb-o')
        $('body').removeClass('dark-only')
        $('div.login-card').removeClass('bg-dark')
        $('div.login-main').removeClass('bg-dark')
    }

    $(".mode").on("click", function () {
        $('.mode i').toggleClass("fa-moon-o").toggleClass("fa-lightbulb-o");
        $('body').toggleClass("dark-only");
        $('div.login-card').toggleClass('bg-dark')
        $('div.login-main').toggleClass('bg-dark')

        if ($('body').hasClass('dark-only')) {
            localStorage.setItem('darkMode', true)
        } else {
            localStorage.setItem('darkMode', false)
        }
    });

})(jQuery);

$('.loader-wrapper').fadeOut('slow', function () {
    $(this).remove();
});

$(window).on('scroll', function () {
    if ($(this).scrollTop() > 600) {
        $('.tap-top').fadeIn();
    } else {
        $('.tap-top').fadeOut();
    }
});



$('.tap-top').click(function () {
    $("html, body").animate({
        scrollTop: 0
    }, 600);
    return false;
});

function toggleFullScreen() {
    if ((document.fullScreenElement && document.fullScreenElement !== null) ||
        (!document.mozFullScreen && !document.webkitIsFullScreen)) {
        if (document.documentElement.requestFullScreen) {
            document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
            document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
    }
}

(function ($, window, document, undefined) {
    "use strict";
    var $ripple = $(".js-ripple");
    $ripple.on("click.ui.ripple", function (e) {
        var $this = $(this);
        var $offset = $this.parent().offset();
        var $circle = $this.find(".c-ripple__circle");
        var x = e.pageX - $offset.left;
        var y = e.pageY - $offset.top;
        $circle.css({
            top: y + "px",
            left: x + "px"
        });
        $this.addClass("is-active");
    });
    $ripple.on(
        "animationend webkitAnimationEnd oanimationend MSAnimationEnd",
        function (e) {
            $(this).removeClass("is-active");
        });


})(jQuery, window, document);


// active link

$(".chat-menu-icons .toogle-bar").click(function () {
    $(".chat-menu").toggleClass("show");
});


// Language
var tnum = 'en';

$(document).ready(function () {

    if (localStorage.getItem("primary") != null) {
        var primary_val = localStorage.getItem("primary");
        $("#ColorPicker1").val(primary_val);
        var secondary_val = localStorage.getItem("secondary");
        $("#ColorPicker2").val(secondary_val);
    }


    $(document).click(function (e) {
        $('.translate_wrapper, .more_lang').removeClass('active');
    });
    $('.translate_wrapper .current_lang').click(function (e) {
        e.stopPropagation();
        $(this).parent().toggleClass('active');

        setTimeout(function () {
            $('.more_lang').toggleClass('active');
        }, 5);
    });


    /*TRANSLATE*/
    translate(tnum);

    $('.more_lang .lang').click(function () {
        $(this).addClass('selected').siblings().removeClass('selected');
        $('.more_lang').removeClass('active');

        var i = $(this).find('i').attr('class');
        var lang = $(this).attr('data-value');
        var tnum = lang;
        translate(tnum);

        $('.current_lang .lang-txt').text(lang);
        $('.current_lang i').attr('class', i);


    });
});

function translate(tnum) {
    $('.lan-1').text(trans[0][tnum]);
    $('.lan-2').text(trans[1][tnum]);
    $('.lan-3').text(trans[2][tnum]);
    $('.lan-4').text(trans[3][tnum]);
    $('.lan-5').text(trans[4][tnum]);
    $('.lan-6').text(trans[5][tnum]);
    $('.lan-7').text(trans[6][tnum]);
    $('.lan-8').text(trans[7][tnum]);
    $('.lan-9').text(trans[8][tnum]);
}

var trans = [{
        en: 'General',
        pt: 'Geral',
        es: 'Generalo',
        fr: 'GÃ©nÃ©rale',
        de: 'Generel',
        cn: 'ä¸€èˆ¬',
        ae: 'Ø­Ø¬Ù†Ø±Ø§Ù„ Ù„ÙˆØ§Ø¡'
    }, {
        en: 'Dashboards,widgets & layout.',
        pt: 'PainÃ©is, widgets e layout.',
        es: 'Paneloj, fenestraÄµoj kaj aranÄo.',
        fr: "Tableaux de bord, widgets et mise en page.",
        de: 'Dashboards, widgets en lay-out.',
        cn: 'ä»ªè¡¨æ¿ï¼Œå°å·¥å…·å’Œå¸ƒå±€ã€‚',
        ae: 'Ù„ÙˆØ­Ø§Øª Ø§Ù„Ù…Ø¹Ù„ÙˆÙ…Ø§Øª ÙˆØ§Ù„Ø£Ø¯ÙˆØ§Øª ÙˆØ§Ù„ØªØ®Ø·ÙŠØ·.'
    }, {
        en: 'Dashboards',
        pt: 'PainÃ©is',
        es: 'Paneloj',
        fr: 'Tableaux',
        de: 'Dashboards',
        cn: ' ä»ªè¡¨æ¿ ',
        ae: 'ÙˆØ­Ø§Øª Ø§Ù„Ù‚ÙŠØ§Ø¯Ø© '
    }, {
        en: 'Default',
        pt: 'PadrÃ£o',
        es: 'Vaikimisi',
        fr: 'DÃ©faut',
        de: 'Standaard',
        cn: 'é›»å­å•†å‹™',
        ae: 'ÙˆØ¥ÙØªØ±Ø§Ø¶ÙŠ'
    }, {
        en: 'Ecommerce',
        pt: 'ComÃ©rcio eletrÃ´nico',
        es: 'Komerco',
        fr: 'Commerce Ã©lectronique',
        de: 'E-commerce',
        cn: 'é›»å­å•†å‹™',
        ae: 'ÙˆØ§Ù„ØªØ¬Ø§Ø±Ø© Ø§Ù„Ø¥Ù„ÙƒØªØ±ÙˆÙ†ÙŠØ©'
    }, {
        en: 'Widgets',
        pt: 'Ferramenta',
        es: 'Vidin',
        fr: 'Widgets',
        de: 'Widgets',
        cn: 'å°éƒ¨ä»¶',
        ae: 'ÙˆØ§Ù„Ø­Ø§Ø¬ÙŠØ§Øª'
    }, {
        en: 'Page layout',
        pt: 'Layout da pÃ¡gina',
        es: 'PaÄa aranÄo',
        fr: 'Tableaux',
        de: 'Mise en page',
        cn: 'é é¢ä½ˆå±€',
        ae: 'ÙˆØªØ®Ø·ÙŠØ· Ø§Ù„ØµÙØ­Ø©'
    }, {
        en: 'Applications',
        pt: 'FormulÃ¡rios',
        es: 'Aplikoj',
        fr: 'Applications',
        de: 'Toepassingen',
        cn: 'æ‡‰ç”¨é ˜åŸŸ',
        ae: 'ÙˆØ§Ù„ØªØ·Ø¨ÙŠÙ‚Ø§Øª'
    }, {
        en: 'Ready to use Apps',
        pt: 'Pronto para usar aplicativos',
        es: 'Preta uzi Apps',
        fr: ' Applications prÃªtes Ã  lemploi ',
        de: 'Klaar om apps te gebruiken',
        cn: 'ä»ªè¡¨æ¿',
        ae: 'Ø¬Ø§Ù‡Ø² Ù„Ø§Ø³ØªØ®Ø¯Ø§Ù… Ø§Ù„ØªØ·Ø¨ÙŠÙ‚Ø§Øª'
    },

];

$(".mobile-title svg").click(function () {
    $(".mega-menu-container").toggleClass("d-block");
});

$(".onhover-dropdown").on("click", function () {
    $(this).children('.onhover-show-div').toggleClass("active");
});

// if ($(window).width() <= 991) {
//     $(".left-header .link-section").children('ul').css('display', 'none');
//     $(this).parent().children('ul').toggleClass("d-block").slideToggle();
// }


if ($(window).width() < 991) {
    $('<div class="bg-overlay"></div>').appendTo($('body'));
    $(".bg-overlay").on("click", function () {
        $(".page-header").addClass("close_icon");
        $(".sidebar-wrapper").addClass("close_icon");
        $(this).removeClass("active");
    });

    $(".toggle-sidebar").on("click", function () {
        $(".bg-overlay").addClass("active");
    });
    $(".back-btn").on("click", function () {
        $(".bg-overlay").removeClass("active");
    });
}

$("#flip-btn").click(function () {
    $(".flip-card-inner").addClass("flipped")
});

$("#flip-back").click(function () {
    $(".flip-card-inner").removeClass("flipped")
})

$(".toggle-nav").click(function () {
    $('#sidebar-links .nav-menu').css("left", "0px");
});
$(".mobile-back").click(function () {
    $('#sidebar-links .nav-menu').css("left", "-410px");
});
$(".page-wrapper").attr("class", "page-wrapper " + localStorage.getItem('page-wrapper'));
$(".page-body-wrapper").attr("class", "page-body-wrapper " + localStorage.getItem('page-body-wrapper'));
if (localStorage.getItem("page-wrapper") === null) {
    $(".page-wrapper").addClass("compact-wrapper");
    $(".page-body-wrapper").addClass("sidebar-icon");
}

// left sidebar and vertical menu
if ($('#pageWrapper').hasClass('compact-wrapper')) {
    jQuery('.sidebar-title').append('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
    jQuery('.sidebar-title').click(function () {
        jQuery('.sidebar-title').removeClass('active').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
        jQuery('.sidebar-submenu, .menu-content').slideUp('normal');
        jQuery('.menu-content').slideUp('normal');
        if (jQuery(this).next().is(':hidden') == true) {
            jQuery(this).addClass('active');
            jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
            jQuery(this).next().slideDown('normal');
        } else {
            jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
        }
    });
    jQuery('.sidebar-submenu, .menu-content').hide();
    jQuery('.submenu-title').append('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
    jQuery('.submenu-title').click(function () {
        jQuery('.submenu-title').removeClass('active').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
        jQuery('.submenu-content').slideUp('normal');
        if (jQuery(this).next().is(':hidden') == true) {
            jQuery(this).addClass('active');
            jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
            jQuery(this).next().slideDown('normal');
        } else {
            jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
        }
    });
    jQuery('.submenu-content').hide();
} else if ($('#pageWrapper').hasClass('horizontal-wrapper')) {
    var contentwidth = jQuery(window).width();
    if ((contentwidth) < '992') {
        $('#pageWrapper').removeClass('horizontal-wrapper').addClass('compact-wrapper');
        $('.page-body-wrapper').removeClass('horizontal-menu').addClass('sidebar-icon');
        jQuery('.submenu-title').append('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
        jQuery('.submenu-title').click(function () {
            jQuery('.submenu-title').removeClass('active');
            jQuery('.submenu-title').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
            jQuery('.submenu-content').slideUp('normal');
            if (jQuery(this).next().is(':hidden') == true) {
                jQuery(this).addClass('active');
                jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
                jQuery(this).next().slideDown('normal');
            } else {
                jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
            }
        });
        jQuery('.submenu-content').hide();

        jQuery('.sidebar-title').append('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
        jQuery('.sidebar-title').click(function () {
            jQuery('.sidebar-title').removeClass('active');
            jQuery('.sidebar-title').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
            jQuery('.sidebar-submenu, .menu-content').slideUp('normal');
            if (jQuery(this).next().is(':hidden') == true) {
                jQuery(this).addClass('active');
                jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
                jQuery(this).next().slideDown('normal');
            } else {
                jQuery(this).find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
            }
        });
        jQuery('.sidebar-submenu, .menu-content').hide();
    }
}

// toggle sidebar
$nav = $('.sidebar-wrapper');
$header = $('.page-header');
$toggle_nav_top = $('.toggle-sidebar');
$toggle_nav_top.click(function () {
    $this = $(this);
    $nav = $('.sidebar-wrapper');
    $nav.toggleClass('close_icon');
    $header.toggleClass('close_icon');
});

$(window).resize(function () {
    $nav = $('.sidebar-wrapper');
    $header = $('.page-header');
    $toggle_nav_top = $('.toggle-sidebar');
    $toggle_nav_top.click(function () {
        $this = $(this);
        $nav = $('.sidebar-wrapper');
        $nav.toggleClass('close_icon');
        $header.toggleClass('close_icon');
    });
});

$body_part_side = $('.body-part');
$body_part_side.click(function () {
    $toggle_nav_top.attr('checked', false);
    $nav.addClass('close_icon');
    $header.addClass('close_icon');
});

//    responsive sidebar
var $window = $(window);
var widthwindow = $window.width();
(function ($) {
    "use strict";
    if (widthwindow <= 991) {
        $toggle_nav_top.attr('checked', false);
        $nav.addClass("close_icon");
        $header.addClass("close_icon");
    }
})(jQuery);
$(window).resize(function () {
    var widthwindaw = $window.width();
    if (widthwindaw <= 991) {
        $toggle_nav_top.attr('checked', false);
        $nav.addClass("close_icon");
        $header.addClass("close_icon");
    } else {
        $toggle_nav_top.attr('checked', true);
        $nav.removeClass("close_icon");
        $header.removeClass("close_icon");
    }
});

// horizontal arrows
var view = $("#sidebar-menu");
var move = "500px";
var leftsideLimit = -500

// var Windowwidth = jQuery(window).width();
// get wrapper width
var getMenuWrapperSize = function () {
    return $('.sidebar-wrapper').innerWidth();
}
var menuWrapperSize = getMenuWrapperSize();

if ((menuWrapperSize) > '1460') {
    var sliderLimit = -2900
} else if ((menuWrapperSize) >= '992') {
    var sliderLimit = -1000
} else {
    var sliderLimit = -0
}

$("#left-arrow").addClass("disabled");
$("#right-arrow").click(function () {
    var currentPosition = parseInt(view.css("marginLeft"));
    if (currentPosition >= sliderLimit) {
        $("#left-arrow").removeClass("disabled");
        view.stop(false, true).animate({
            marginLeft: "-=" + move
        }, {
            duration: 400
        })
        if (currentPosition == sliderLimit) {
            $(this).addClass("disabled");
            console.log("sliderLimit", sliderLimit);
        }
    }
});

$("#left-arrow").click(function () {
    var currentPosition = parseInt(view.css("marginLeft"));
    if (currentPosition < 0) {
        view.stop(false, true).animate({
            marginLeft: "+=" + move
        }, {
            duration: 400
        })
        $("#right-arrow").removeClass("disabled");
        $("#left-arrow").removeClass("disabled");
        if (currentPosition >= leftsideLimit) {
            $(this).addClass("disabled");
        }
    }

});

// page active
// $(".sidebar-wrapper nav").find("a").removeClass("active");
// $(".sidebar-wrapper nav").find("li").removeClass("active");

var current = window.location.pathname
$(".sidebar-wrapper nav ul active > li a").filter(function () {

    var link = $(this).attr("href");
    if (link) {
        if (current.indexOf(link) != -1) {
            $(this).parents().children('a').addClass('active');
            $(this).parents().parents().children('ul').css('display', 'block');
            $(this).addClass('active');
            $(this).parent().parent().parent().children('a').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
            $(this).parent().parent().parent().parent().parent().children('a').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
            return false;
        }
    }
});

$('.left-header .mega-menu .nav-link').on('click', function (e) {
    $(this).toggleClass("active");
    $(this).parent().children('.mega-menu-container').toggleClass("d-block").slideToggle();
});

$(".left-header .level-menu .header-level-menu").css('display', 'none');
$('.left-header .level-menu .nav-link').on('click', function (e) {
    $(this).toggleClass("active");
    $(this).parent().children('.header-level-menu').toggleClass("d-block").slideToggle();
});

$('.left-header .link-section > div').on('click', function (e) {
    if ($(window).width() <= 1199) {
        $(".left-header .link-section > div").removeClass("active");
        $(this).toggleClass("active");
        $(this).parent().children('ul').toggleClass("d-block").slideToggle();
    }
});

if ($(window).width() <= 1199) {
    $(".left-header .link-section").children('ul').css('display', 'none');
    $(this).parent().children('ul').toggleClass("d-block").slideToggle();
}
if ($(window).width() <= 991) {
    $('.sidebar-wrapper .back-btn').on('click', function (e) {
        $(".page-header").toggleClass("close_icon");
        $(".sidebar-wrapper").toggleClass("close_icon");
    });
}

// $('.custom-scrollbar').animate({
//     scrollTop: $('a.sidebar-link.sidebar-title.active').offset().top - 200
// }, 1000);

if (localStorage.getItem("color"))
    $("#color").attr("href", "../assets/css/" + localStorage.getItem("color") + ".css");
if (localStorage.getItem("dark"))
    $("body").attr("class", "dark-only");
$(`
<div class="customizer-contain">
<div class="tab-content" id="c-pills-tabContent">
    <div class="customizer-header"> <i class="icofont-close icon-close"></i>
        <h5>Preview Settings</h5>
        <p class="mb-0">Try It Real Time <i class="fa fa-thumbs-o-up txt-primary"></i></p>
    </div>
    <div class="customizer-body custom-scrollbar">
        <div class="tab-pane fade show active" id="c-pills-home" role="tabpanel" aria-labelledby="c-pills-home-tab">
            <h6>Layout Type</h6>
            <ul class="main-layout layout-grid">
                <li data-attr="ltr" class="active">
                    <div class="header bg-light">
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="body">
                        <ul>
                            <li class="bg-light sidebar"></li>
                            <li class="bg-light body"> <span class="badge badge-primary">LTR</span></li>
                        </ul>
                    </div>
                </li>
                <li data-attr="rtl">
                    <div class="header bg-light">
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="body">
                        <ul>
                            <li class="bg-light body"> <span class="badge badge-primary">RTL</span></li>
                            <li class="bg-light sidebar"></li>
                        </ul>
                    </div>
                </li>
                <li data-attr="ltr" class="box-layout px-3">
                    <div class="header bg-light">
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="body">
                        <ul>
                            <li class="bg-light sidebar"></li>
                            <li class="bg-light body"> <span class="badge badge-primary">Box</span></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <h6 class="">Sidebar Type</h6>
            <ul class="sidebar-type layout-grid">
                <li data-attr="normal-sidebar">
                    <div class="header bg-light">
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="body">
                        <ul>
                            <li class="bg-dark sidebar"></li>
                            <li class="bg-light body"></li>
                        </ul>
                    </div>
                </li>
                <li data-attr="compact-sidebar">
                    <div class="header bg-light">
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="body">
                        <ul>
                            <li class="bg-dark sidebar compact"></li>
                            <li class="bg-light body"></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <h6 class="">Sidebar settings</h6>
            <ul class="sidebar-setting layout-grid">
                <li class="active" data-attr="default-sidebar">
                    <div class="header bg-light">
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="body bg-light"> <span class="badge badge-primary">Default</span></div>
                </li>
                <li data-attr="border-sidebar">
                    <div class="header bg-light">
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="body bg-light"> <span class="badge badge-primary">Border</span></div>
                </li>
                <li data-attr="iconcolor-sidebar">
                    <div class="header bg-light">
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="body bg-light"> <span class="badge badge-primary">icon Color</span></div>
                </li>
            </ul>
            <h6 class="">Unlimited Color</h6>
            <ul class="layout-grid unlimited-color-layout"> <input id="ColorPicker1" type="color" value="#7366ff" name="Background"> <input id="ColorPicker2" type="color" value="#f73164" name="Background"> <button type="button" class="color-apply-btn btn btn-primary color-apply-btn">Apply</button></ul>
            <h6>Light layout</h6>
            <ul class="layout-grid customizer-color">
                <li class="color-layout" data-attr="color-1" data-primary="#7366ff" data-secondary="#f73164">
                    <div></div>
                </li>
                <li class="color-layout" data-attr="color-2" data-primary="#4831D4" data-secondary="#ea2087">
                    <div></div>
                </li>
                <li class="color-layout" data-attr="color-3" data-primary="#d64dcf" data-secondary="#8e24aa">
                    <div></div>
                </li>
                <li class="color-layout" data-attr="color-4" data-primary="#4c2fbf" data-secondary="#2e9de4">
                    <div></div>
                </li>
                <li class="color-layout" data-attr="color-5" data-primary="#7c4dff" data-secondary="#7b1fa2">
                    <div></div>
                </li>
                <li class="color-layout" data-attr="color-6" data-primary="#3949ab" data-secondary="#4fc3f7">
                    <div></div>
                </li>
            </ul>
            <h6 class="">Dark Layout</h6>
            <ul class="layout-grid customizer-color dark">
                <li class="color-layout" data-attr="color-1" data-primary="#4466f2" data-secondary="#1ea6ec">
                    <div></div>
                </li>
                <li class="color-layout" data-attr="color-2" data-primary="#4831D4" data-secondary="#ea2087">
                    <div></div>
                </li>
                <li class="color-layout" data-attr="color-3" data-primary="#d64dcf" data-secondary="#8e24aa">
                    <div></div>
                </li>
                <li class="color-layout" data-attr="color-4" data-primary="#4c2fbf" data-secondary="#2e9de4">
                    <div></div>
                </li>
                <li class="color-layout" data-attr="color-5" data-primary="#7c4dff" data-secondary="#7b1fa2">
                    <div></div>
                </li>
                <li class="color-layout" data-attr="color-6" data-primary="#3949ab" data-secondary="#4fc3f7">
                    <div></div>
                </li>
            </ul>
            <h6 class="">Mix Layout</h6>
            <ul class="layout-grid customizer-mix">
                <li class="color-layout active" data-attr="light-only">
                    <div class="header bg-light">
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="body">
                        <ul>
                            <li class="bg-light sidebar"></li>
                            <li class="bg-light body"></li>
                        </ul>
                    </div>
                </li>
                <li class="color-layout" data-attr="dark-sidebar">
                    <div class="header bg-light">
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="body">
                        <ul>
                            <li class="bg-dark sidebar"></li>
                            <li class="bg-light body"></li>
                        </ul>
                    </div>
                </li>
                <li class="color-layout" data-attr="dark-only">
                    <div class="header bg-dark">
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="body">
                        <ul>
                            <li class="bg-dark sidebar"></li>
                            <li class="bg-dark body"></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>
`).appendTo($('body'));
(function () {})();
//live customizer js
$(document).ready(function () {

    $(".customizer-color li").on('click', function () {
        $(".customizer-color li").removeClass('active');
        $(this).addClass("active");
        var color = $(this).attr("data-attr");
        var primary = $(this).attr("data-primary");
        var secondary = $(this).attr("data-secondary");
        localStorage.setItem("color", color);
        localStorage.setItem("primary", primary);
        localStorage.setItem("secondary", secondary);
        localStorage.removeItem("dark");
        $("#color").attr("href", "../assets/css/" + color + ".css");
        $(".dark-only").removeClass('dark-only');
        location.reload(true);
    });

    $(".customizer-color.dark li").on('click', function () {
        $(".customizer-color.dark li").removeClass('active');
        $(this).addClass("active");
        $("body").attr("class", "dark-only");
        localStorage.setItem("dark", "dark-only");
    });



    if (localStorage.getItem("primary") != null) {
        document.documentElement.style.setProperty('--theme-deafult', localStorage.getItem("primary"));
    }
    if (localStorage.getItem("secondary") != null) {
        document.documentElement.style.setProperty('--theme-secondary', localStorage.getItem("secondary"));
    }
    $("#c-pills-home-tab").click(function () {
        $(".customizer-contain").toggleClass("open");
        // $(".customizer-links").addClass("open");
    });

    $(".close-customizer-btn").on('click', function () {
        $(".floated-customizer-panel").removeClass("active");
    });

    $(".customizer-contain .icon-close").on('click', function () {
        $(".customizer-contain").removeClass("open");
        $(".customizer-links").removeClass("open");
    });

    $(".color-apply-btn").click(function () {
        location.reload(true);
    });

    var primary = document.getElementById("ColorPicker1").value;
    document.getElementById("ColorPicker1").onchange = function () {
        primary = this.value;
        localStorage.setItem("primary", primary);
        document.documentElement.style.setProperty('--theme-primary', primary);
    };

    var secondary = document.getElementById("ColorPicker2").value;
    document.getElementById("ColorPicker2").onchange = function () {
        secondary = this.value;
        localStorage.setItem("secondary", secondary);
        document.documentElement.style.setProperty('--theme-secondary', secondary);
    };


    $(".customizer-color.dark li").on('click', function () {
        $(".customizer-color.dark li").removeClass('active');
        $(this).addClass("active");
        $("body").attr("class", "dark-only");
        localStorage.setItem("dark", "dark-only");
    });


    $(".customizer-mix li").on('click', function () {
        $(".customizer-mix li").removeClass('active');
        $(this).addClass("active");
        var mixLayout = $(this).attr("data-attr");
        $("body").attr("class", mixLayout);
    });


    $('.sidebar-setting li').on('click', function () {
        $(".sidebar-setting li").removeClass('active');
        $(this).addClass("active");
        var sidebar = $(this).attr("data-attr");
        $(".sidebar-wrapper").attr("sidebar-layout", sidebar);
    });

    $('.sidebar-main-bg-setting li').on('click', function () {
        $(".sidebar-main-bg-setting li").removeClass('active')
        $(this).addClass("active")
        var bg = $(this).attr("data-attr");
        $(".sidebar-wrapper").attr("class", "sidebar-wrapper " + bg);
    });

    $('.sidebar-type li').on('click', function () {
        // $(".sidebar-type li").removeClass('active');
        var type = $(this).attr("data-attr");

        var boxed = "";
        if ($(".page-wrapper").hasClass("box-layout")) {
            boxed = "box-layout";
        }
        switch (type) {
            case 'compact-sidebar': {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper " + boxed);
                $(".page-body-wrapper").attr("class", "page-body-wrapper sidebar-icon");
                localStorage.setItem('page-wrapper', 'compact-wrapper');
                localStorage.setItem('page-body-wrapper', 'sidebar-icon');
                break;
            }
            case 'normal-sidebar': {
                $(".page-wrapper").attr("class", "page-wrapper horizontal-wrapper " + boxed);
                $(".page-body-wrapper").attr("class", "page-body-wrapper horizontal-menu");
                $(".logo-wrapper").find('img').attr('src', '../assets/images/logo/logo.png');
                localStorage.setItem('page-wrapper', 'horizontal-wrapper');
                localStorage.setItem('page-body-wrapper', 'horizontal-menu');
                break;
            }
            default: {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper " + boxed);
                $(".page-body-wrapper").attr("class", "page-body-wrapper sidebar-icon");
                // $(".logo-wrapper").find('img').attr('src', '../assets/images/logo/compact-logo.png');
                localStorage.setItem('page-wrapper', 'compact-wrapper');
                localStorage.setItem('page-body-wrapper', 'sidebar-icon');
                break;
            }
        }
        // $(this).addClass("active");
        location.reload(true);
    });

    $('.main-layout li').on('click', function () {
        $(".main-layout li").removeClass('active');
        $(this).addClass("active");
        var layout = $(this).attr("data-attr");
        $("body").attr("class", layout);
        $("html").attr("dir", layout);
    });

    $('.main-layout .box-layout').on('click', function () {
        $(".main-layout .box-layout").removeClass('active');
        $(this).addClass("active");
        var layout = $(this).attr("data-attr");
        $("body").attr("class", "box-layout");
        $("html").attr("dir", layout);
    });

});
