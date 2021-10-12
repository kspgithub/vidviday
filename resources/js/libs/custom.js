var _functions = {},
    winWidth;

window._functions = _functions;


jQuery(function ($) {

    "use strict";

    /*///////////*/
    /* VARIABLES */
    /*///////////*/
    var winScr,
        winWidth = $(window).width(),
        winHeight = $(window).height(),
        is_Mac = navigator.platform.toUpperCase().indexOf('MAC') >= 0,
        is_Edge = /Edge\/\d+/.test(navigator.userAgent),
        is_Chrome = navigator.userAgent.indexOf('Chrome') >= 0 && navigator.userAgent.indexOf('Edge') < 0,
        isTouchScreen = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i);

    /*///////////////////////////*/
    /*FUNCTION ON DOCUMENT READY */
    /*///////////////////////////*/
    if (isTouchScreen) $('html').addClass('touch-screen');
    if (is_Mac) $('html').addClass('mac');
    if (is_Edge) $('html').addClass('edge');
    if (is_Chrome) $('html').addClass('chrome');

    headerScrolled();
    goUpButtonScrolled();
    lazyLoadImg();
    lazyLoadBg();
    lazyLoadVideo();
    lazyLoadFrames();








    /*/////////////////////////*/
    /* FUNCTION ON PAGE SCROLL */
    /*/////////////////////////*/
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

    /*////////////////*/
    /* SWIPER SLIDERS */
    /*////////////////*/
    _functions.getSwOptions = function (swiper) {

        let options = swiper.data('options');
        options = (!options || typeof options !== 'object') ? {} : options;
        let $slider = swiper.closest('.swiper-entry'),
            slidesLength = swiper.find('>.swiper-wrapper>.swiper-slide').length;

        if (!options.pagination) options.pagination = {
            el: $slider.find('.swiper-pagination')[0],
            clickable: true
        };

        if (!options.navigation) options.navigation = {
            nextEl: $slider.find('.swiper-button-next')[0],
            prevEl: $slider.find('.swiper-button-prev')[0]
        };

        options.preloadImages = false;
        options.lazy = {loadPrevNext: true};
        options.observer = true;
        options.observeParents = true;
        options.watchOverflow = true;
        options.watchSlidesVisibility = true;
        options.on = {
            slideChangeTransitionStart: function () {
                if ($slider.hasClass('popup-gallery-slider')) {
                    let customFraction = $slider.closest('.popup-align').find('.pagination-fraction .text-bold'),
                        activeSlideIndex = $slider.find('.swiper-slide-active').index();
                    $(customFraction).html(activeSlideIndex + 1);
                }
            }
        };

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
        if (!$(this).hasClass('swiper-vue')) {
            _functions.initSwiper($(this));
            swiperConfig($(this));
        }

    });

    function swiperConfig(el) {
        var slides = $(el).find('.swiper-slide:not(.swiper-slide-duplicate)'),
            visibleSlides = $(el).find('.swiper-slide-visible:not(.swiper-slide-duplicate)');
        if ($(slides).length <= $(visibleSlides).length) {
            $(el).parent().addClass('no-swipe');
        }
    }

    _functions.swiperConfig = swiperConfig;

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

    /*///////////////////////////////*/
    /* BUTTONS, CLICKS, HOVER, FOCUS */
    /*///////////////////////////////*/
    // Anchor link smooth scroll


    // Popup
    var popupTop = 0;

    function removeScroll() {

        if ($('html').css('position') != 'fixed') {
            popupTop = $(window).scrollTop();
        }

        $('.parallax').addClass('transition');

        $('html').css({
            "position": "fixed",
            "top": -popupTop,
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

    $(document).on('click', '.close-popup, .popup-wrap .btn-close:not(.btn-delete), .popup-wrap .layer-close', function (e) {
        e.preventDefault();
        _functions.closePopup();
    });


    //accordion
    function pageScroll(current) {

        $('html, body').animate({
            scrollTop: current.offset().top - ($('header').outerHeight() + 40)
        }, 420);

        return false;
    }

    $('.accordion-title').on('click', function () {

        let innerAccordion = $(this).next();

        $(this).parent().toggleClass('active');
        $(this).next().slideToggle(440);

        if ($(this).parents().hasClass('inner-not-expand') == false) {

            if ($(this).parent().hasClass('active')) {

                $(innerAccordion).each(function () {

                    $(this).addClass('active');
                    $(this).find('.accordion-item').addClass('active');
                    $(this).find('.accordion-inner').slideDown(440);
                });

                pageScroll($(this));
            } else {

                $(innerAccordion).each(function () {

                    $(this).removeClass('active');
                    $(this).find('.accordion-item').removeClass('active');
                    $(this).find('.accordion-inner').slideUp(440);
                });
            }
        }
    });

    $('.inner-not-expand .accordion-title').on('click', function () {
        $(this).closest('.accordion-item').toggleClass('active');
        $(this).closest('.accordion-item').next().slideToggle(440);
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
        $('html, body').animate({scrollTop: 0}, '300');
    });

    $('.cabinet-page .tab-caption a').on('click', function () {
        $($(this).parent()).click();
    });

    $('#voice-search-btn').on('click', function () {
        $('.voice-search-dropdown').toggleClass('active');
    });

    $('#search-dropdown input').on('focus', function () {
        $('.voice-search-dropdown').removeClass('active');
    });

    $('.search-dropdown-close').on('click', function () {
        searchDropdownClose();
        addScroll();
        $('.voice-search-dropdown').removeClass('active');
    });


    //input mask tel
    $('input[name="tel"]').on('focus', function () {
        $(this).inputmask({
            mask: "+38(0 x 9) 9 9 9 - 9 9 - 9 9",
            clearMaskOnLostFocus: true,
            definitions: {
                'x': {
                    validator: "[1-9]"
                },
                '9': {
                    validator: "[0-9]"
                }
            }
        });
    });

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

        if ($(this).is(':invalid') || $(this).val() == '') {
            $(this).parent().addClass('invalid');
        } else {
            $(this).parent().removeClass('invalid');
        }
    });


    $('input[name="viber"]').on('focus', function () {
        $(this).inputmask({
            mask: "+38(0 x 9) 9 9 9 - 9 9 - 9 9",
            clearMaskOnLostFocus: true,
            definitions: {
                'x': {
                    validator: "[1-9]"
                },
                '9': {
                    validator: "[0-9]"
                }
            }
        });
    });
    $('.dr').on('focus', function () {
        $(this).inputmask({
            mask: "99.99.9999",
            clearMaskOnLostFocus: true,
            definitions: {
                'x': {
                    validator: "[1-9]"
                },
                '9': {
                    validator: "[0-9]"
                }
            }
        });
    });
    // Upload image
    $('.img-input:not(.btn) input').on('change', function (e) {
        var $t = $(this);
        if ($t.hasClass('vue-action')) return;
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
        $(this).parents('.load-more-wrapp').find('.more-info').slideToggle(440);
    });
    // Remove participant
    $('.participant .btn-delete').on('click', function () {
        $(this).closest('.participant').remove();
        $('.participant').each(function () {
            $(this).find('.h4 span').html($(this).index() + 1);
        });
    });
    // participant datepicker
    $('.participant .datepicker-input input').on('blur', function () {
        if ($(this).closest('.datepicker-input').hasClass('vue-datepicker')) return;
        if ($(this).val()) {
            $(this).closest('.datepicker-input').addClass('filled');
        } else {
            $(this).closest('.datepicker-input').removeClass('filled');
        }
    });

    $('.participant .single-datepicker').on('mouseleave', function () {
        if ($(this).find('.datepicker-input').hasClass('vue-datepicker')) return;
        if ($(this).find('input').val()) {
            $(this).find('.datepicker-input').addClass('filled');
        } else {
            $(this).find('.datepicker-input').removeClass('filled');
        }
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
        $(radioAccordionToggle).slideUp(440);
        $(this).find('.radio-accordion-toggle').slideDown(440);
    });
    // Order page radio buttons datepicker switch
    $('.radio-datepicker-switch .radio').on('click', function () {
        $(this).closest('.radio-datepickers-wrap').find('.radio-datepicker').eq($(this).index()).addClass('active').siblings().removeClass('active');
        $(this).closest('.radio-datepickers-wrap').find('.radio-additional-tab').eq($(this).index()).addClass('active').siblings().removeClass('active');
    });

    $('.radio-datepicker-switch-inner .radio').on('click', function () {
        $(this).closest('.radio-datepickers-wrap-inner').find('.radio-datepicker-inner').eq($(this).index()).addClass('active').siblings().removeClass('active');
        $(this).closest('.radio-datepickers-wrap-inner').find('.radio-additional-tab-inner').eq($(this).index()).addClass('active').siblings().removeClass('active');
    });
    // Checkbox hidden field
    $('.checkbox-accordion .checkbox input').on('change', function () {
        $(this).closest('.checkbox-accordion').find('.hidden-textarea').slideToggle(440);
    });
    // Participant mobile accordions
    $('.participant .h4').on('click', function () {
        $(this).toggleClass('active');
        $(this).next().slideToggle(440);
    });
    // Participant filled inputs
    $('.participant input').on('change', function () {

        let participant = $(this).closest('.participant'),
            participantInput = $(participant).find('label input'),
            datepicker = $(participant).find('.datepicker-here'),
            checkIcon = $(participant).find('.h4 i');

        $(participantInput).each(function () {

            if ($(this).val()) {
                $(datepicker).addClass('filled');
            } else {
                $(datepicker).removeClass('filled');
            }
        });

        if (datepicker.hasClass('filled') && datepicker.hasClass('picked')) {
            checkIcon.addClass('active');
        } else {
            checkIcon.removeClass('active');
        }
    });
    // Add note
    $('.add-note-btn').on('click', function () {
        $(this).closest('.add-note').find('.add-note-toggle').slideDown(440);
        $(this).slideUp(440);
    });

    $('.add-note-btn-cancel').on('click', function () {
        $(this).closest('.add-note').find('.add-note-toggle').slideUp(440);
        $('.add-note-btn').slideDown(440);
    });

    $('.log-inned-icon').on('click', function () {
        $($(this).attr('href')).addClass('active').siblings().removeClass('active');
        $('.tab-caption').eq($($(this).attr('href')).index()).addClass('active').siblings().removeClass('active');
    });

    $('.add-to-like').on('click', function () {
        $(this).toggleClass('active');
    });
    // Open acordion
    $('.accordion-open-trigger').on('click', function () {
        let link = $(this).attr('href'),
            accordion = $(link).find('.accordion-title');
        $(accordion).click();
    });

    /*////////////*/
    /* ANIMATIONS */

    /*////////////*/
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

    /*//////////////*/
    /* AUTOCOMPLETE */
    /*//////////////*/
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


    // if ($('.input-search').length) {
    // 	$('.input-search').each(function() {
    // 		$(this).autocomplete({
    // 			source: availableTags,
    // 			open: function(event, ui) {
    // 				$(this).parent().addClass('active-autocomplete');
    // 				$('.ui-menu').append('<li class="ui-menu-item-all">Всі результати пошуку</li>');
    // 				if ($(this).parent().hasClass('search-dropdown-form')) {
    // 					$('.ui-menu').addClass('no-shadow');
    // 				}
    // 			},
    // 			close: function(event, ui) {
    // 				$(this).parent().removeClass('active-autocomplete');
    // 			}
    // 		}).autocomplete('instance')._renderItem = function(ul, item) {
    // 			return $('<li>')
    // 			.append('<div><img src="' + item.icon + '" alt="preview image"/>' + '<span>' + item.value + '</span></div>')
    // 			.appendTo(ul);
    // 		};
    // 	});
    // }
    // 09 Comments stars rank
    $('.rating-picker .select-icon').on('click', function () {
        $(this).addClass('active').siblings().removeClass('active');
        $(this).parent().addClass('active');
    });
});

$(function () {
    $('.scroll-top').on('scroll', function (e) {
        $('.scroll-bottom').scrollLeft($('.scroll-top').scrollLeft());
    });
    $('.scroll-bottom').on('scroll', function (e) {
        $('.scroll-top').scrollLeft($('.scroll-bottom').scrollLeft());
    });
});
$(window).on('load', function (e) {
    $('.scroll-div-1').width($('table').width());
    $('.scroll-div-2').width($('table').width());
});

$('.scroll-div-1').width($('table').width());
$('.scroll-div-2').width($('table').width());


$('input[name="certificate-format"]').click(function () {
    var target = $('#block-' + $(this).val());
    $('.cert-upak').not(target).hide(0);
    target.fadeIn(500);
});


$('input[name="certificate-upak"]').click(function () {
    var target = $('#block-' + $(this).val());
    $('.upak-variant').not(target).hide(0);
    target.fadeIn(500);
});

$('input[name="certificate-detail"]').click(function () {
    var target = $('#block-' + $(this).val());
    $('.det-n').not(target).hide(0);
    target.fadeIn(500);
});
