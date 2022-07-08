var _functions = {},
    popupTop = 0,
    winWidth;

window._functions = _functions;

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

    setTimeout(function () {
        window.dispatchEvent(new Event('resize'));
    }, 200)
}

window.removeScroll = removeScroll;

function addScroll() {
    $('html').css({
        "position": "static"
    });
    window.scroll(0, popupTop);
}

window.addScroll = addScroll;

jQuery(function ($) {

    "use strict";

    /*##############*/
    /* 01 VARIABLES */
    /*##############*/
    var winScr,
        winWidth = $(window).width(),
        winHeight = $(window).height(),
        is_Mac = navigator.platform.toUpperCase().indexOf('MAC') >= 0,
        is_Edge = /Edge\/\d+/.test(navigator.userAgent),
        is_IE = /MSIE 9/i.test(navigator.userAgent) || /rv:11.0/i.test(navigator.userAgent) || /MSIE 10/i.test(navigator.userAgent) || /Edge\/\d+/.test(navigator.userAgent),

        is_Chrome = navigator.userAgent.indexOf('Chrome') >= 0 && navigator.userAgent.indexOf('Edge') < 0,
        isTouchScreen = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i);

    /*###############################*/
    /* 02 FUNCTION ON DOCUMENT READY */
    /*###############################*/
    if (isTouchScreen) $('html').addClass('touch-screen');
    if (is_Mac) $('html').addClass('mac');
    if (is_IE) $('html').addClass('ie');
    if (is_Edge) $('html').addClass('edge');
    if (is_Chrome) $('html').addClass('chrome');

    headerScrolled();
    goUpButtonScrolled();


    setTimeout(function () {
        lazyLoadImg();
        lazyLoadBg();
        lazyLoadVideo();
        lazyLoadFrames();

        $(".slider-range").each(function () {
            if (!$(this).hasClass('vue-range')) {
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
            }
        });
    }, 200);

    // Lazy loadings for images, backgrounds adn videos
    function lazyLoadImg() {

        let img = document.querySelectorAll('[data-img-src]'),
            observer = new IntersectionObserver((entries, observer) => {

                entries.forEach(entry => {

                    if (entry.isIntersecting) {

                        let lazyImg = entry.target

                        lazyImg.src = lazyImg.dataset.imgSrc;
                        observer.unobserve(lazyImg)
                    }
                })
            }, {
                rootMargin: '0px',
                threshold: 0.1
            });

        img.forEach(i => {
            observer.observe(i)
        })
    }

    function lazyLoadBg() {

        let bg = document.querySelectorAll('[data-bg-src]'),
            observer = new IntersectionObserver((entries, observer) => {

                entries.forEach(entry => {

                    if (entry.isIntersecting) {

                        let lazyBg = entry.target,
                            lazyBgSrc = 'url("' + lazyBg.dataset.bgSrc + '")';

                        lazyBg.style.backgroundImage = lazyBgSrc;
                        observer.unobserve(lazyBg)
                    }
                })
            }, {
                rootMargin: '0px',
                threshold: 0.1
            });

        bg.forEach(i => {
            observer.observe(i)
        })
    }

    function lazyLoadVideo() {

        let video = document.querySelectorAll('[data-video-src]'),
            videoMarkup,
            observer = new IntersectionObserver((entries, observer) => {

                entries.forEach(entry => {

                    if (entry.isIntersecting) {
                        let lazyVideo = entry.target,
                            videoSrc = lazyVideo.dataset.videoSrc;

                        if (lazyVideo.classList.contains('autoplay')) {
                            videoMarkup = '<video ' + ($(this).is('[data-autoplay]') ? 'autoplay' : '') + ' muted autoplay inline loop><source src="' + videoSrc + '" type="video/mp4"></video>';
                        } else {
                            videoMarkup = '<video ' + ($(this).is('[data-autoplay]') ? 'autoplay' : '') + ' controls inline><source src="' + videoSrc + '" type="video/mp4"></video>';
                        }

                        lazyVideo.innerHTML = videoMarkup;
                        observer.unobserve(lazyVideo)
                    }
                })
            }, {
                rootMargin: '0px',
                threshold: 0.1
            });

        video.forEach(i => {
            observer.observe(i)
        })
    }

    function lazyLoadFrames() {

        let frame = document.querySelectorAll('[data-frame-src]'),
            frameMarkup,
            observer = new IntersectionObserver((entries, observer) => {

                entries.forEach(entry => {

                    if (entry.isIntersecting) {
                        let lazyFrame = entry.target,
                            frameSrc = lazyFrame.dataset.frameSrc;

                        frameMarkup = '<iframe src="' + frameSrc + '?modestbranding=1&rel=0" allowfullscreen allow="autoplay"></iframe>';
                        lazyFrame.innerHTML = frameMarkup;
                        observer.unobserve(lazyFrame)
                    }
                })
            }, {
                rootMargin: '0px',
                threshold: 0.1
            });

        frame.forEach(i => {
            observer.observe(i)
        })
    }

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

    /*###################*/
    /* 04 SWIPER SLIDERS */
    /*###################*/
    _functions.getSwOptions = function (swiper) {
        var options = swiper.data('options');
        options = (!options || typeof options !== 'object') ? {} : options;
        let $slider = swiper.closest('.swiper-entry'),
            slidesLength = swiper.find('>.swiper-wrapper>.swiper-slide').length;

        if (!options.pagination) options.pagination = {
            el: $slider.find('.swiper-pagination')[0],
            clickable: true,
            dynamicBullets: true,
            dynamicMainBullets: 10,
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

        console.log(options)
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
    $(document).on('click', 'a[href*="#"]', function () {

        let anchorLink = $(this).attr('href');
        if (anchorLink !== '#') {
            $('html, body').animate({
                scrollTop: $(anchorLink).offset().top - $('header').outerHeight()
            }, 730);
        }


        return false;
    });

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
        $('nav ul .dropdown-toggle').slideUp(440);
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
    $('.dropdown-btn, .dropdown-title').on('click', function (e) {
        e.preventDefault();

        let dropdown = $(this).closest('.dropdown'),
            dropdownToggle = $(dropdown).find('.dropdown-toggle');

        /*dropdown.toggleClass('active');
        dropdownToggle.slideToggle(330);*/

        if (dropdown.hasClass('active')) {
            dropdown.removeClass('active');
            dropdownToggle.slideUp(330);
        } else {
            $('header .dropdown').each(function () {
                $(dropdown).find('.dropdown-btn').removeClass('active');
            });
            dropdown.addClass('active');
            dropdownToggle.slideDown(330);
        }
    });
    // Mobile menu layer close
    $('#header-layer-close').on('click', function () {
        addScroll();
        headerLayerClose();
        mobileMenuClose();
        menuBtnClose();
        tourSelectionClose();
        $('nav ul .dropdown-toggle').slideUp(440);
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
        $('nav ul .dropdown-toggle').slideUp(440);
        $('.tel, .exchange, .lang').removeClass('active');
    });

    $('#search-dropdown .btn-close').on('click', function () {
        addScroll();
        searchDropdownClose();
    });
    // Header dropdowns
    $('header .row > div > .tel > .full-size, header .row > div > .exchange > .full-size, header .row > div > .lang > .full-size, header .row > div > .log-inned > .full-size').on('click', function () {
        var dropdown = $(this).parent();
        mobileMenuClose();
        menuBtnClose();
        searchDropdownClose();
        tourSelectionClose();
        $('nav ul .dropdown-toggle').slideUp(440);
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
        $('nav ul .dropdown-toggle').slideUp(440);
        if ($(dropdown).hasClass('active')) {
            $('.dropdown').removeClass('active');
        } else {
            $('.dropdown').removeClass('active');
            $(dropdown).addClass('active');
        }
    });
    // Search clear
    // $('.header-search .btn-close').on('click', function () {
    //     $(this).closest('.header-search').find('input').val('');
    // });

    // $('.header-search').on('mouseleave', function () {
    //     $(this).removeClass('active');
    // });
    // Tooltip
    $('.tooltip-wrap.red, .tooltip-wrap.black, .tooltip-wrap.light').on('click', function () {
        $(this).toggleClass('active');
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
        if ($(this).parent().hasClass('vue-datepicker')) return;

        if ($(this).parent().hasClass('active')) {
            $(this).parent().removeClass('active');
        } else {
            $(this).parent().addClass('active');
        }
    });

    $('.double-datepicker .datepicker-input > span').on('click', function () {
        if ($(this).parent().hasClass('vue-datepicker')) return;
        $($(this).parent()).toggleClass('active').siblings().removeClass('active');
    });

    $('.single-datepicker, .double-datepicker').on('mouseleave', function () {

        if ($(this).find('.datepicker-input').hasClass('vue-datepicker')) return;
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
        if ($(this).parents('.vue-number-input').length > 0) return;
        var $input = $(this).siblings('input'),
            val = parseInt($input.val()),
            min = parseInt($input.attr('min')),
            step = parseInt($input.attr('step')),
            temp = val - step;
        $input.val(temp >= min ? temp : min);
    });
    // Increment
    $(document).delegate('.number-input .increment', 'click', function () {
        if ($(this).parents('.vue-number-input').length > 0) return;
        var $input = $(this).siblings('input'),
            val = parseInt($input.val()),
            max = parseInt($input.attr('max')),
            step = parseInt($input.attr('step')),
            temp = val + step;

        $input.val(temp <= max ? temp : max);
    });
    // Popup


    _functions.openPopup = function (popup) {
        $('.popup-content').removeClass('active');
        $(popup + ', #popup-wrap').addClass('active');
        removeScroll();
    };

    _functions.closePopup = function () {
        $('#popup-wrap, .popup-content').removeClass('active');
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
        const rel = $(this).data('rel');
        if (rel === 'testimonial-popup' && $(this).data('parent')) {
            $('.popup-content[data-rel="' + rel + '"]').attr('data-parent', $(this).data('parent'));
        }
        _functions.openPopup('.popup-content[data-rel="' + $(this).data('rel') + '"]');
    });

    $(document).on('click', '.close-popup, #popup-wrap .btn-close:not(.btn-delete), #popup-wrap .layer-close', function (e) {
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
            scrollTop: current.offset().top - ($('header').outerHeight() + 40)
        }, 420);

        return false;
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
    $('.accordion-all-expand:not(.inner-not-expand) .expand-all').on('click', function () {

        let parentAccordion = $(this).closest('.accordion-all-expand'),
            accordion = $(parentAccordion).find('.accordion-item');

        if ($(this).hasClass('open')) {

            $(accordion).each(function () {

                $(this).addClass('active');
                $(this).find('.accordion-inner').slideDown(440);
            });

            pageScroll(parentAccordion);
        }

        if ($(this).hasClass('close')) {

            $(accordion).each(function () {
                $(this).removeClass('active');
                $(this).find('.accordion-inner').slideUp(440);
            });
        }
    });

    $('.accordion-all-expand.inner-not-expand .expand-all').on('click', function () {

        let parentAccordion = $(this).closest('.accordion-all-expand'),
            accordion = $(parentAccordion).find('.accordions-inner-wrap > .accordion-item');

        if ($(this).hasClass('open')) {

            $(accordion).each(function () {

                $(this).addClass('active');
                $(this).find('> .accordion-inner').slideDown(440);
            });

            pageScroll(parentAccordion);
        }

        if ($(this).hasClass('close')) {

            $(accordion).each(function () {

                $(this).removeClass('active');
                $(this).find('> .accordion-inner').slideUp(440);
            });
        }
    });


    //tabs
    $(document).on('click', '.tab-title', function () {
        if ($(this).parents('.vue-tabs').length > 0) return;
        $(this).parent().toggleClass('active');
    });

    $(document).on('click', '.tab-toggle .tab-caption', function () {
        if ($(this).parents('.vue-tabs').length > 0) return;
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
        if ($(this).parents('.vue-tabs').length > 0) return;
        $(this).closest('.tabs').find('.tab.active').removeClass('active').prev().addClass('active');
        $(this).closest('.tabs').find('.tab-caption.active').removeClass('active').prev().addClass('active');
        var index = $('.tab.active').index() + 1;
        $('.tab-top-part').removeClass('active');
        $('.tab-top-part[data-tab="' + index + '"]').addClass('active');
    });

    $(document).on('click', '.tab-next', function () {
        if ($(this).parents('.vue-tabs').length > 0) return;
        $(this).closest('.tabs').find('.tab.active').removeClass('active').next().addClass('active');
        $(this).closest('.tabs').find('.tab-caption.active').removeClass('active').next().addClass('active');
        var index = $('.tab.active').index() + 1;
        $('.tab-top-part').removeClass('active');
        $('.tab-top-part[data-tab="' + index + '"]').addClass('active');
        $('html, body').animate({scrollTop: 0}, '300');
    });

    $('.cabinet-page .tab-caption a').on('click', function () {
        if ($(this).parents('.vue-tabs').length > 0) return;
        $($(this).parent()).click();
    });

    $('#voice-search-btn').on('click', function () {
        $('.voice-search-dropdown').toggleClass('active');
    });

    $('#search-dropdown input').on('focus', function () {
        $('.voice-search-dropdown').removeClass('active');
    });
    // Calculator clicks
    // $('.calc-row .checkbox input').on('change', function () {
    //     if ($(this).parents('.vue-calc').length > 0) return;
    //
    //     if ($(this).parent().parent().hasClass('checked')) {
    //         $(this).parent().parent().removeClass('checked');
    //     } else {
    //         $(this).parent().parent().addClass('checked');
    //     }
    //     calcTotalPrice($(this));
    // });

    // $('.calc-row .number-input button').on('click', function () {
    //     if ($(this).parents('.vue-calc').length > 0) return;
    //     var amountProduct = parseInt($(this).closest('.calc-row').find('.number-input input').val()),
    //         productPrice = parseInt($(this).closest('.calc-row').find('.calc-item-price').attr('data-price'));
    //     $(this).closest('.calc-row').find('.calc-item-price').html(amountProduct * productPrice);
    //     calcTotalPrice($(this));
    // });

    // function calcTotalPrice(el) {
    //     var eachItem = $(el).closest('.calc-rows-wrap').find('.calc-row.checked'),
    //         allSummProduct = 0;
    //     $(eachItem).each(function () {
    //         allSummProduct += +$(this).find('.calc-item-price').html();
    //     });
    //     console.log(allSummProduct);
    //     $(el).closest('.calc').find('.calc-total-price').html(allSummProduct);
    // }

    // Input focus
    $('input, textarea').on('focus', function () {
        if ($(this).hasClass('vue-input')) return;
        $(this).parent().addClass('active');
    });
    // Input blur
    $('input, textarea').on('blur', function () {
        if ($(this).hasClass('vue-input')) return;
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
        if ($t.hasClass('vue-input')) return;
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
        var $container = $(this).parents('.load-more-wrapp');
        if ($container.hasClass('vue-load-more')) return;
        $(this).toggleClass('active');
        $container.find('.more-info').slideToggle(440);
        $container.find('.less-info').slideToggle(440);

    });

    // Remove participant
    // $('.participant .btn-delete').on('click', function () {
    //     $(this).closest('.participant').remove();
    //     $('.participant').each(function () {
    //         $(this).find('.h4 span').html($(this).index() + 1);
    //     });
    // });
    // participant datepicker
    // $('.participant .datepicker-input input').on('blur', function () {
    //     if ($(this).closest('.datepicker-input').hasClass('vue-datepicker')) return;
    //     if ($(this).val()) {
    //         $(this).closest('.datepicker-input').addClass('filled');
    //     } else {
    //         $(this).closest('.datepicker-input').removeClass('filled');
    //     }
    // });

    // $('.participant .single-datepicker').on('mouseleave', function () {
    //     if ($(this).find('.datepicker-input').hasClass('vue-datepicker')) return;
    //     if ($(this).find('input').val()) {
    //         $(this).find('.datepicker-input').addClass('filled');
    //     } else {
    //         $(this).find('.datepicker-input').removeClass('filled');
    //     }
    // });
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
        if ($(this).parent().hasClass('vue-checkbox')) return;
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
    // $('.add-note-btn').on('click', function () {
    //     $(this).closest('.add-note').find('.add-note-toggle').slideDown(440);
    //     $(this).slideUp(440);
    // });
    //
    // $('.add-note-btn-cancel').on('click', function () {
    //     $(this).closest('.add-note').find('.add-note-toggle').slideUp(440);
    //     $('.add-note-btn').slideDown(440);
    // });

    $('.log-inned-icon').on('click', function () {
        $($(this).attr('href')).addClass('active').siblings().removeClass('active');
        $('.tab-caption').eq($($(this).attr('href')).index()).addClass('active').siblings().removeClass('active');
    });

    // $('.add-to-like').on('click', function () {
    //     $(this).toggleClass('active');
    // });
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


    $(document).on('click', '.show-more-events', function (e) {
        var $btn = $(e.currentTarget);
        var $container = $btn.parents('.accordion-inner').eq(0);
        var $items = $container.find('.schedule-row');
        $items.each(function () {
            $(this).removeClass('d-none');
        });
        $btn.addClass('d-none');
        $container.find('.hide-more-events').removeClass('d-none');
    });

    $(document).on('click', '.hide-more-events', function (e) {
        var $btn = $(e.currentTarget);
        var $container = $btn.parents('.accordion-inner').eq(0);
        var $items = $container.find('.schedule-row');
        $items.each(function (idx, el) {
            if (idx > 2) {
                $(this).addClass('d-none');
            }
        });
        $btn.addClass('d-none');
        $container.find('.show-more-events').removeClass('d-none');
    });
});
$(window).on('load', function (e) {
    $('.scroll-div-1').width($('table').width());
    $('.scroll-div-2').width($('table').width());
});

$('.scroll-div-1').width($('table').width());
$('.scroll-div-2').width($('table').width());


$(document).on('click', 'a[print]', function (e) {
    e.preventDefault()
    window.print();
})
