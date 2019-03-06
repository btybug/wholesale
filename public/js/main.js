$(function () {
    heightBlock('.main-left-tabs .nav', '.main-left-tabs .nav a');
    $(window).resize(function () {
        heightBlock('.main-left-tabs .nav', '.main-left-tabs .nav a');
    });


    // // remove cart-info from cart sidbar
    // $('.cart-item-close').on('click', function (e) {
    //     e.stopPropagation();
    //     $(this).parent($('.cart-aside-item')).remove();
    //     if(!$('.cart-aside-item').length) {
    //     $('#cartSidebarEmptyMsg').show();
    //         $('#headerShopCartBtn').removeClass('active')
    // } else {
    //         $('#cartSidebarEmptyMsg').hide();
    //     }
    // });

    // product-slider
    $(".carousel_1").carousel({
        pagination: false,
        controls: false
    });
    $(".carousel_2").carousel({
        controls: false,
        pagination: false,
        autoAdvance: true,
        show: {
            "0px": 1,
            "500px": 2,
            "980px": 3
        }
    });

    // product range
    $('body').on('change', '.product-range input', function () {
        $(this).closest('.product-range').children().removeClass('active line-none');
        if ($(this).is(":checked")) {
            $(this).parent().addClass('active');
            $(this).parent().prevAll().addClass('active');
            $(this).parent().addClass('line-none')
        }
    });
    // search for mobile
    $('body').on('click', '.header-bottom .search-mobile-icon', function () {
        $(this).closest('.header-bottom').find('.cat-search').addClass('opened-full')
    })

});




////new

    $('.currency--select-2').select2({
            minimumResultsForSearch: Infinity,
           dropdownCssClass: "currency-dropdown"
    });
    $('.select-2--no-search').select2({
        minimumResultsForSearch: Infinity
    });
    $('.select_with-tag').select2();

    $('#accounts--selects').select2({
        dropdownParent: $('.my-account--selects'),
        minimumResultsForSearch: Infinity
    });



// my account select start
    $('#accounts--selects').on('select2:select', function (e) {
        var locUrl = e.params.data.id;
        window.location.replace(locUrl);
    });
    // my account select end

    // header search for mobile
    $('body').on('click', '.search-icon-mobile .icon', function () {
        $(this).closest('.header-bottom').find('.cat-search').toggleClass('closed')
    });


    $('.nav-item.nav-item--has-dropdown').hover(
        function () {
            let darkBg = $(this).closest('body').find('.dark-bg_body')
            if ($('body').hasClass('show-filter')) {
                $('body').removeClass('show-filter')
            } else {
                darkBg.addClass('show')
            }

        }, function () {
            let darkBg = $(this).closest('body').find('.dark-bg_body')
            if (!$('.top-filters .nav-item--has-dropdown_dropdown').hasClass('open')) {
                darkBg.removeClass('show')
            } else {
                $('body').addClass('show-filter')
            }

        }
    );
// filter show
    $('body').on('click', '.top-filters .arrow-wrap .arrow-filters', function () {
        let darkBg = $(this).closest('body').find('.dark-bg_body');
        if (darkBg.hasClass('show')) {
            darkBg.removeClass('show')
        } else {
            darkBg.addClass('show')
        }
        $(this).find('.arrow').toggleClass('opened');
        // console.log(55)
        $(this).closest('.top-filters').find('.main-filters').toggleClass('closed-mobile');
        $(this).closest('.arrow-wrap').find('.nav-item--has-dropdown_dropdown').toggleClass('open');

        $(this).closest('body').toggleClass('show-filter')
    })

    // range
    // $('.range-steps_item.active').nextAll($('.range-steps_item')).addClass('line-none');


    // cards change display
    $('body').on('click', '.display-icon', function (e) {
        e.preventDefault();
        $('.display-icon').removeClass('active');
        $(this).addClass('active');
        if ($(this).attr('id') === 'dispGrid') {
            $('.change-display-wrap').addClass('display-grid');
        } else {
            $('.change-display-wrap').removeClass('display-grid');
        }
    });

    // scroll top button
    $('#scrollTopBtn').on('click', function () {

        if ($('#singleProductPageCnt').length) {
            $('#singleProductPageCnt').animate({
                scrollTop: 0
            }, 800);
        } else {
            $('html, body').animate({
                scrollTop: 0
            }, 800);
        }

    });

    // product range count
    $('body').on('click ', ' .range-steps input', function () {
        $(this).closest('.range-steps').find('.range-steps_item').removeClass('active line-none');
        if ($(this).is(":checked")) {
            $(this).parent().addClass('active');
            $(this).parent().addClass('line-none');
            $(this).parent().nextAll($('.range-steps_item')).addClass('line-none');
        }
    });


    $('body').on('click', '.range-steps_count', function () {
        let rangeItem = $(this).closest('.range-steps_item');
        $(this).closest('.range-steps').find('input').removeAttr('checked');
        // if(!rangeItem.find('input').is(":checked")){
        console.log("check, div");
        $(this).closest('.range-steps').find('.range-steps_item').removeClass('active line-none');
        rangeItem.find('input').removeAttr('checked');
        $(this).closest('.range-steps_item').addClass('active').nextAll().addClass('line-none');
        // }

    })

    // cookies: change content top styles 
    changeHeaderWhenIsCookie();


    // display filter for mobile
    // $('body').on('click', '.filters-for-mobile .btn--filter', function () {
    //     $(this).closest('.top-filters').find('.main-filters').toggleClass('closed-mobile');
    // });


    // menu click mobile
    $('body').on('click', '.header-top .nav-item--has-dropdown', function () {
        $(this).toggleClass('active');
        $('body').find('.dark-bg_body').removeClass('show');
    });

    // hidden sidebars slide from right
    openSidebar($('#ptofileBtn'), $('#profileSidebar'));
    openSidebar($('#headerShopCartBtn'), $('#cartSidebar'));

    // my account select make fixed when scrolled
    $(window).scroll(function () {
        var wScroll = $(this).scrollTop();


        if (wScroll > 0) {
            $('.my-account--selects').addClass('pos-fixed');
        } else {
            $('.my-account--selects').removeClass('pos-fixed');
        }
    });




function openSidebar(btn, sidebar) {
    btn.on('click', function (e) {

        e.stopPropagation();
        $(this).toggleClass('active');

        if (($('.hidden-sidebar')).removeClass('show')) {
            ($('.hidden-sidebar')).removeClass('show')
        }

        sidebar.toggleClass('show');

        $('.dark-bg_body').addClass('show');

    });

    $('body').on('click', function (e) {
        if (btn.hasClass('active')) {
            btn.removeClass('active')
        }
        if (!$(e.target).closest(sidebar).length) {
            sidebar.removeClass('show');
            $('.dark-bg_body').removeClass('show');
        }
    });

}

function changeHeaderWhenIsCookie() {
    if ($('.js-cookie-consent.cookie-consent').css('display') !== 'none') {
        var cookieHeight = $('.js-cookie-consent.cookie-consent').height();

        $('.main-header .header-top').css('top', cookieHeight);

        var headerPaddingTop = parseInt($('.main-header').css('padding-top'));
        var headerPaddingTopNew = headerPaddingTop + cookieHeight + 'px';

        $('.main-header').css('padding-top', headerPaddingTopNew);

        var headerHeight = $('.header-top').height();
        var accountSelectPaddingTop = headerHeight + cookieHeight;

        $('.my-account--selects').css('top', accountSelectPaddingTop);

        $('.js-cookie-consent-agree').on('click', function () {
            var resetHeaderPaddingTop =  headerPaddingTop + 'px';
            $('.main-header').css('padding-top', resetHeaderPaddingTop);
            $('.main-header .header-top').css('top', 0);

            $('.my-account--selects').css('top', headerHeight);

        })


    }
}

function heightBlock(mainDiv, element) {
    let countElement = 0;
    $(element).each(function () {
        countElement += $(this).outerHeight();
    });
    if ($(mainDiv).outerHeight() < countElement) {
        $(mainDiv).css('display', 'block')
    } else {
        $(mainDiv).css('display', 'flex')
    }
}


