var _functions = {},
    winWidth;

window._functions = _functions;

jQuery(function ($) {

    "use strict";

    /*##############*/
    /* 01 VARIABLES */
    /*##############*/
    var winScr,
        winWidth = $(window).width(),
        winHeight = $(window).height(),
        is_Mac = navigator.platform.toUpperCase().indexOf('MAC') >= 0,
        is_IE = /MSIE 9/i.test(navigator.userAgent) || /rv:11.0/i.test(navigator.userAgent) || /MSIE 10/i.test(navigator.userAgent) || /Edge\/\d+/.test(navigator.userAgent),
        is_Chrome = navigator.userAgent.indexOf('Chrome') >= 0 && navigator.userAgent.indexOf('Edge') < 0,
        isTouchScreen = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i);

    /*###############################*/
    /* 02 FUNCTION ON DOCUMENT READY */
    /*###############################*/
    if (isTouchScreen) $('html').addClass('touch-screen');
    if (is_Mac) $('html').addClass('mac');
    if (is_IE) $('html').addClass('ie');
    if (is_Chrome) $('html').addClass('chrome');

    headerScrolled();
    goUpButtonScrolled();

    setTimeout(function () {
        lazyLoadImg();
        lazyLoadBg();
        lazyLoadVideo();


        $(".slider-range").each(function () {
            var $range = $(this),
                $input = $(this).parent().find('input');
            $(this).slider({
                range: true,
                min: $(this).data('min'),
                max: $(this).data('max'),
                values: $(this).data('values'),
                slide: function (event, ui) {
                    $(this).parent().find('.range-min').text(ui.values[0]);
                    $(this).parent().find('.range-max').text(ui.values[1]);
                }
            });
        });
    }, 200);

    // Lazy loadings for images, backgrounds adn videos
    function lazyLoadImg() {
        $('img[data-img-src]').each(function (i, el) {
            $(el).attr('src', $(el).data('img-src'));
        });
    }

    function lazyLoadBg() {
        $('[data-bg-src]').each(function (i, el) {
            $(el).css('background-image', 'url(' + $(el).data('bg-src') + ')');
        });
    }

    function lazyLoadVideo() {
        $('.video').each(function () {
            var video = '<video ' + ($(this).is('[data-autoplay]') ? 'autoplay' : '') + ' muted playsinline><source src="' + $(this).data('video-src') + '" type="video/mp4"></video>';
            $(this).prepend(video);
        });
    }

    /*############################*/
    /* 03 FUNCTION ON PAGE SCROLL */
    /*############################*/
    $(window).scroll(function () {
        _functions.scrollCall();
    });

    var prev_scroll = 0;
    _functions.scrollCall = function () {
        winScr = $(window).scrollTop();
        headerScrolled();
        goUpButtonScrolled();
    }

    _functions.scrollCall();

    /*###################*/
    /* 04 SWIPER SLIDERS */
    /*###################*/
    _functions.getSwOptions = function (swiper) {
        var options = swiper.data('options');
        options = (!options || typeof options !== 'object') ? {} : options;
        var $p = swiper.closest('.swiper-entry'),
            slidesLength = swiper.find('>.swiper-wrapper>.swiper-slide').length;
        if (!options.pagination) options.pagination = {
            el: $p.find('.swiper-pagination')[0],
            clickable: true
        };
        if (!options.navigation) options.navigation = {
            nextEl: $p.find('.swiper-button-next')[0],
            prevEl: $p.find('.swiper-button-prev')[0]
        };
        options.preloadImages = false;
        options.lazy = {loadPrevNext: true};
        options.observer = true;
        options.observeParents = true;
        options.watchOverflow = true;
        options.watchSlidesVisibility = true;
        if (!options.speed) options.speed = 500;
        options.roundLengths = false;
        if (!options.centerInsufficientSlides) options.centerInsufficientSlides = false;
        if (options.customFraction) {
            $p.addClass('custom-fraction-swiper');
            if (slidesLength > 1 && slidesLength < 10) {
                $p.find('.custom-current').text('01');
                $p.find('.custom-total').text('0' + slidesLength);
            } else if (slidesLength > 1) {
                $p.find('.custom-current').text('01');
                $p.find('.custom-total').text(slidesLength);
            }
        }
        if (isTouchScreen) options.direction = "horizontal";
        return options;
    };

    _functions.initSwiper = function (el) {
        var swiper = new Swiper(el[0], _functions.getSwOptions(el));
    };

    $('.swiper-entry .swiper-container').each(function () {
        _functions.initSwiper($(this));
        swiperConfig($(this));
    });

    function swiperConfig(el) {
        var slides = $(el).find('.swiper-slide:not(.swiper-slide-duplicate)'),
            visibleSlides = $(el).find('.swiper-slide-visible:not(.swiper-slide-duplicate)');
        if ($(slides).length <= $(visibleSlides).length) {
            $(el).parent().addClass('no-swipe');
        }
    }


    $('.swiper-thumbs').each(function () {
        var top = $(this).find('.swiper-container.swiper-thumbs-top')[0].swiper,
            bottom = $(this).find('.swiper-container.swiper-thumbs-bottom')[0].swiper;
        top.thumbs.swiper = bottom;
        top.thumbs.init();
        top.thumbs.update();
    });

    $('.swiper-control').each(function () {
        var top = $(this).find('.swiper-container')[0].swiper,
            bottom = $(this).find('.swiper-container')[1].swiper;
        top.controller.control = bottom;
        bottom.controller.control = top;
    });

    $('.custom-fraction-swiper').each(function () {
        var $this = $(this),
            $thisSwiper = $this.find('.swiper-container')[0].swiper;

        $thisSwiper.on('slideChange', function () {
            $this.find('.custom-current').text(
                function () {
                    if ($thisSwiper.realIndex < 9) {
                        return '0' + ($thisSwiper.realIndex + 1)
                    } else {
                        return $thisSwiper.realIndex + 1
                    }
                }
            )
        });
    });

    /*##################################*/
    /* 06 BUTTONS, CLICKS, HOVER, FOCUS */

    /*##################################*/
    function headerLayerClose() {
        $('#header-layer-close').removeClass('active');
    }

    function headerLayerOpen() {
        $('#header-layer-close').addClass('active');
    }

    function mobileMenuClose() {
        $('nav').removeClass('active');
    }

    function mobileMenuOpen() {
        $('nav').addClass('active');
    }

    function menuBtnClose() {
        $('#menu-btn').removeClass('active');
    }

    function menuBtnOpen() {
        $('#menu-btn').addClass('active');
    }

    function searchDropdownClose() {
        $('#search-dropdown').removeClass('active');
    }

    function searchDropdownOpen() {
        $('#search-dropdown').addClass('active');
    }

    function tourSelectionClose() {
        $('#tour-selection-dropdown').removeClass('active');
    }

    function tourSelectionOpen() {
        $('#tour-selection-dropdown').addClass('active');
    }

    // Mobile menu button
    $('#menu-btn').on('click', function () {
        $('nav ul .dropdown-toggle').slideUp(330);
        $('.tel, .exchange, .lang, .log-inned').removeClass('active');
        tourSelectionClose();

        if ($(this).hasClass('active')) {
            addScroll();
            headerLayerClose();
            mobileMenuClose();
            menuBtnClose();
        } else {
            removeScroll();
            headerLayerOpen();
            mobileMenuOpen();
            menuBtnOpen();
        }
    });
    // Mobile menu dropdown
    $('nav li.dropdown > span').on('click', function () {
        $('nav .only-mobile .dropdown').removeClass('active');
        $(this).parent().toggleClass('active');
        $(this).next().slideToggle(330);
    });
    // Mobile menu layer close
    $('#header-layer-close').on('click', function () {
        addScroll();
        headerLayerClose();
        mobileMenuClose();
        menuBtnClose();
        tourSelectionClose();
        $('nav ul .dropdown-toggle').slideUp(330);
        $('.tel, .exchange, .lang, .log-inned').removeClass('active');
    });
    // Mobile search dropdown open/close
    $('#search-btn').on('click', function () {
        removeScroll();
        headerLayerClose();
        mobileMenuClose();
        menuBtnClose();
        searchDropdownOpen();
        tourSelectionClose();
        $('nav ul .dropdown-toggle').slideUp(330);
        $('.tel, .exchange, .lang').removeClass('active');
    });

    $('#search-dropdown .btn-close').on('click', function () {
        addScroll();
        searchDropdownClose();
    });
    // Header dropsowns
    $('header .row > div > .tel > .full-size, header .row > div > .exchange > .full-size, header .row > div > .lang > .full-size, header .row > div > .log-inned > .full-size').on('click', function () {
        var dropdown = $(this).parent();
        mobileMenuClose();
        menuBtnClose();
        searchDropdownClose();
        tourSelectionClose();
        $('nav ul .dropdown-toggle').slideUp(330);
        if ($(dropdown).hasClass('active')) {
            addScroll();
            headerLayerClose();
            $('.dropdown').removeClass('active');
        } else {
            removeScroll();
            headerLayerOpen();
            $('.dropdown').removeClass('active');
            $(dropdown).addClass('active');
        }
    });
    // Mobile menu dropdowns
    $('nav .exchange > .full-size, nav .lang > .full-size').on('click', function () {
        var dropdown = $(this).parent();
        $('nav ul .dropdown-toggle').slideUp(330);
        if ($(dropdown).hasClass('active')) {
            $('.dropdown').removeClass('active');
        } else {
            $('.dropdown').removeClass('active');
            $(dropdown).addClass('active');
        }
    });
    // Tour selection dropdown
    $('#tour-selection-btn').on('click', function () {
        removeScroll();
        headerLayerOpen();
        tourSelectionOpen();
    });

    $('#tour-selection-dropdown .btn-close').on('click', function () {
        addScroll();
        headerLayerClose();
        tourSelectionClose();
    });
    // Datepicker events
    $('.single-datepicker .datepicker-input > span').on('click', function () {
        if ($(this).parent().hasClass('active')) {
            $(this).parent().removeClass('active');
        } else {
            $(this).parent().addClass('active');
        }
    });

    $('.double-datepicker .datepicker-input > span').on('click', function () {
        $($(this).parent()).toggleClass('active').siblings().removeClass('active');
    });

    $('.single-datepicker, .double-datepicker').on('mouseleave', function () {
        $(this).find('.datepicker-input').removeClass('active');
    });

    $(document).delegate('.fc-right button.fc-state-active', 'click', function () {
        $(this).parent().toggleClass('active');
    });
    // Button scroll to top
    $('.btn-to-top').on('click', function () {
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
    });
    // Like click
    $('.like').on('click', function () {
        $(this).toggleClass('active');
    });
    // Decrement
    $(document).delegate('.number-input .decrement', 'click', function () {
        var $input = $(this).siblings('input'),
            val = parseInt($input.val()),
            min = parseInt($input.attr('min')),
            step = parseInt($input.attr('step')),
            temp = val - step;
        $input.val(temp >= min ? temp : min);
    });
    // Increment
    $(document).delegate('.number-input .increment', 'click', function () {
        var $input = $(this).siblings('input'),
            val = parseInt($input.val()),
            max = parseInt($input.attr('max')),
            step = parseInt($input.attr('step')),
            temp = val + step;
        $input.val(temp <= max ? temp : max);
    });
    // Popup
    var popupTop = 0;

    function removeScroll() {
        popupTop = $(window).scrollTop();
        $('html').css({
            "position": "fixed",
            "top": -$(window).scrollTop(),
            "width": "100%"
        });
    }

    function addScroll() {
        $('html').css({
            "position": "static"
        });
        window.scroll(0, popupTop);
    }

    _functions.openPopup = function (popup) {
        $('.popup-content').removeClass('active');
        $(popup + ', .popup-wrap').addClass('active');
        removeScroll();
    };

    _functions.closePopup = function () {
        $('.popup-wrap, .popup-content').removeClass('active');
        addScroll();
    };

    _functions.textPopup = function (title, description) {
        $('#text-popup .text-popup-title').html(title);
        $('#text-popup .text-popup-description').html(description);
        _functions.openPopup('#text-popup');
    };

    _functions.showPopup = function (target) {
        headerLayerClose();
        mobileMenuClose();
        menuBtnClose();
        tourSelectionClose();
        $('.dropdown').removeClass('active');
        _functions.openPopup('.popup-content[data-rel="' + target + '"]');
    }

    $(document).on('click', '.open-popup', function (e) {
        e.preventDefault();
        headerLayerClose();
        mobileMenuClose();
        menuBtnClose();
        tourSelectionClose();
        $('.dropdown').removeClass('active');
        _functions.openPopup('.popup-content[data-rel="' + $(this).data('rel') + '"]');
    });

    $(document).on('click', '.close-popup, .popup-wrap .btn-close:not(.btn-delete), .popup-wrap .layer-close', function (e) {
        e.preventDefault();
        _functions.closePopup();
    });
    // Video pop-up
    $(document).on('click', '.video-open', function (e) {
        e.preventDefault();
        var video = $(this).attr('href');
        $('.video-popup-container iframe').attr('src', video);
        $('.video-popup').addClass('active');
        $('html').addClass('overflow-hidden');
    });

    $('.video-popup-close, .video-popup-layer').on('click', function (e) {
        $('html').removeClass('overflow-hidden');
        $('.video-popup').removeClass('active');
        $('.video-popup-container iframe').attr('src', 'about:blank');
        e.preventDefault();
    });

    //accordion
    function pageScroll(current) {
        $('html, body').animate({
            scrollTop: current.offset().top - $('header').outerHeight()
        }, 420);
    }

    $(document).on('click', '.accordion-title', function (e) {
        var current = $(this);
        if (current.parent().hasClass('active')) {
            current.parent().removeClass('active');
            current.next().slideUp(300);
        } else {
            current.parent().addClass('active');
            current.next().slideDown(function () {
                pageScroll(current);
            });
            pageScroll(current);
        }
    });
    //expand all accordion
    $(document).on('click', '.expand-all', function () {
        var headerHeight = $('header').outerHeight() + 40,
            current = $(this),
            topAccordion = $(this).parents('.accordion-all-expand');
        if (current.hasClass('up')) {
            current.parents('.accordion-all-expand').find('.accordion-item').removeClass('active').find('.accordion-inner').slideUp();
        } else {
            current.parents('.accordion-all-expand').find('.accordion-item').addClass('active').find('.accordion-inner').slideDown(function () {
                pageScroll(topAccordion, headerHeight);
            });
        }
    });
    //tabs
    $(document).on('click', '.tab-title', function () {
        $(this).parent().toggleClass('active');
    });

    $(document).on('click', '.tab-toggle .tab-caption', function () {
        var tab = $(this).closest('.tabs').find('.tab'),
            tabIndex = $(this).index(),
            topTabIndex = tabIndex + 1;
        $(this).addClass('active').siblings().removeClass('active');
        tab.eq(tabIndex).addClass('active').siblings().removeClass('active');
        $('.tab-top-part').removeClass('active');
        $('.tab-top-part[data-tab="' + topTabIndex + '"]').addClass('active');
        $(this).parents('.tab-nav').removeClass('active').find('.tab-title').text($(this).find('> span').text());
    });

    $(document).on('click', '.tab-prev', function () {
        $(this).closest('.tabs').find('.tab.active').removeClass('active').prev().addClass('active');
        $(this).closest('.tabs').find('.tab-caption.active').removeClass('active').prev().addClass('active');
        var index = $('.tab.active').index() + 1;
        $('.tab-top-part').removeClass('active');
        $('.tab-top-part[data-tab="' + index + '"]').addClass('active');
    });

    $(document).on('click', '.tab-next', function () {
        $(this).closest('.tabs').find('.tab.active').removeClass('active').next().addClass('active');
        $(this).closest('.tabs').find('.tab-caption.active').removeClass('active').next().addClass('active');
        var index = $('.tab.active').index() + 1;
        $('.tab-top-part').removeClass('active');
        $('.tab-top-part[data-tab="' + index + '"]').addClass('active');
    });
    // Calculator clicks
    $('.calc-row .checkbox input').on('change', function () {
        if ($(this).parent().parent().hasClass('checked')) {
            $(this).parent().parent().removeClass('checked');
        } else {
            $(this).parent().parent().addClass('checked');
        }
        calcTotalPrice($(this));
    });

    $('.calc-row .number-input button').on('click', function () {
        var amountProduct = parseInt($(this).closest('.calc-row').find('.number-input input').val()),
            productPrice = parseInt($(this).closest('.calc-row').find('.calc-item-price').attr('data-price'));
        $(this).closest('.calc-row').find('.calc-item-price').html(amountProduct * productPrice);
        calcTotalPrice($(this));
    });

    function calcTotalPrice(el) {
        var eachItem = $(el).closest('.calc-rows-wrap').find('.calc-row.checked'),
            allSummProduct = 0;
        $(eachItem).each(function () {
            allSummProduct += +$(this).find('.calc-item-price').html();
        });
        $(el).closest('.calc').find('.calc-total-price').html(allSummProduct);
    }

    // Input focus
    $('input, textarea').on('focus', function () {
        $(this).parent().addClass('active');
    });
    // Input blur
    $('input, textarea').on('blur', function () {
        if ($(this).val()) {
            $(this).parent().addClass('active');
        } else {
            $(this).parent().removeClass('active');
        }

        if ($(this).is(':invalid')) {
            $(this).parent().addClass('invalid');
        } else {
            $(this).parent().removeClass('invalid');
        }
    });
    //input mask tel
    $('input.input[type="tel"]').on('focus', function () {
        $(this).inputmask({"mask": "+38 (999) 999-99-99"});
    });
    // Upload image
    $('.img-input:not(.btn) input').on('change', function (e) {
        var $t = $(this);
        if (this.files && this.files[0]) {
            var upload = new FileReader();
            upload.onload = function (e) {
                $t.closest('.img-input-wrap').append('<div class="loaded-img"><img src="' + e.target.result + '" alt="img"><div class="btn-delete"></div></div>');
            };
            upload.readAsDataURL(this.files[0]);
        }
    });

    $('.img-input.btn input').on('change', function (e) {
        var $t = $(this);
        if (this.files && this.files[0]) {
            var upload = new FileReader();
            upload.onload = function (e) {
                $t.closest('.img-input-wrap').find('.img img').remove();
                $t.closest('.img-input-wrap').find('.img').append('<img src="' + e.target.result + '" alt="img">');
            };
            upload.readAsDataURL(this.files[0]);
        }
    });
    // Remove image
    $(document).on('click', '.loaded-img .btn-delete', function () {
        $(this).closest('.loaded-img').remove();
    });
    // Show more info
    $('.show-more').on('click', function () {
        $(this).toggleClass('active');
        $(this).parents('.load-more-wrapp').find('.more-info').slideToggle(300);
    });
    // Remove participant
    $('.participant .btn-delete').on('click', function () {
        $(this).closest('.participant').remove();
        $('.participant').each(function () {
            $(this).find('.h4 span').html($(this).index() + 1);
        });
    });
    // Apartment form
    $(document).on('click', '.apartment-option .number-input button', function () {
        var val = parseInt($(this).parent().find('input').val());
        if (val > 0) {
            $(this).closest('.apartment-option').addClass('active');
        } else {
            $(this).closest('.apartment-option').removeClass('active');
        }
    });
    // Radio button with accordion
    $('.radio-accordion').on('change', function () {
        var radioAccordion = $(this).siblings(),
            radioAccordionToggle = $(radioAccordion).find('.radio-accordion-toggle');
        $(radioAccordionToggle).slideUp(300);
        $(this).find('.radio-accordion-toggle').slideDown(300);
    });

    /*###############*/
    /* 07 ANIMATIONS */

    /*###############*/
    function headerScrolled() {
        if (winScr >= $('header').outerHeight()) {
            $('header').addClass('scrolled');
        } else {
            $('header').removeClass('scrolled');
        }

        if (winScr >= 1 && $('.step-page').length) {
            $('.step-page').addClass('scrolled');
        } else {
            $('.step-page').removeClass('scrolled');
        }
    }

    function goUpButtonScrolled() {
        if (winScr >= $('header').outerHeight()) {
            $('.btn-to-top').addClass('active');
        } else {
            $('.btn-to-top').removeClass('active');
        }
    }

    /*#################*/
    /* 08 AUTOCOMPLETE */
    /*#################*/
    var availableTags = [
        'Манява — Драгобрат — полонина Перці',
        'Тур-відпустка «6 днів у замових Карпатах»',
        'Сиро-винний тур Закарпатським та Прикарпатським краями',
        'Сиро-Винний тур Закарпаттям',
    ];

    var availableTags = [
        {
            value: 'Сиро-Винний тур Закарпаттям',
            icon: 'img/preview_1.jpg'
        },
        {
            value: 'Тур 10 родзинок Закарпаття',
            icon: 'img/preview_2.jpg'
        },
        {
            value: 'Тур Різдво у Карпатах',
            icon: 'img/preview_3.jpg'
        },
        {
            value: 'Тур Озера Карпат',
            icon: 'img/preview_4.jpg'
        },
        {
            value: 'Тур Несамовите озеро в Карпатах',
            icon: 'img/preview_5.jpg'
        }
    ];


    if ($('.input-search').length) {
        $('.input-search').each(function () {
            $(this).autocomplete({
                source: availableTags,
                open: function (event, ui) {
                    $(this).parent().addClass('active-autocomplete');
                    $('.ui-menu').append('<li class="ui-menu-item-all">Всі результати пошуку</li>');
                    if ($(this).parent().hasClass('search-dropdown-form')) {
                        $('.ui-menu').addClass('no-shadow');
                    }
                },
                close: function (event, ui) {
                    $(this).parent().removeClass('active-autocomplete');
                }
            }).autocomplete('instance')._renderItem = function (ul, item) {
                return $('<li>')
                    .append('<div><img src="' + item.icon + '" alt="preview image"/>' + '<span>' + item.value + '</span></div>')
                    .appendTo(ul);
            };
        });
    }
    // 09 Comments stars rank
    $('.rating-picker .select-icon').on('click', function () {
        $(this).addClass('active').siblings().removeClass('active');
        $(this).parent().addClass('active');
    });
});

