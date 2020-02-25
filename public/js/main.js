$( document ).ready(function () {
    heightBlock('.main-left-tabs .nav', '.main-left-tabs .nav a');
    $(window).resize(function () {
        heightBlock('.main-left-tabs .nav', '.main-left-tabs .nav a');
    });

    $('body').on('click', '.product-grid-list .display-icon', function () {
        if ($(this).hasClass('list')) {
            $(this).closest('body').find('.products__all-list-product >li').addClass('products_col-list')
            $(this).closest('body').find('.products__item-wrapper').addClass('product_list')
        }else {
            $(this).closest('body').find('.products__all-list-product >li').removeClass('products_col-list')
            $(this).closest('body').find('.products__item-wrapper').removeClass('product_list')
        }
    })
    // product slider
    function Product_slider() {
        var _this = this;
        this.products = function () {
            $("body").on('mouseover', ".products__item-wrapper .products__item-photo-thumb-item", function () {
                $(this).closest('.products__item-wrapper').find('.products__item-photo-thumb-item').removeClass("active-slider")
                let img_path = $(this).find("img").attr("src");
                $(this).closest('.products__item-wrapper').find(".products__item-photo img").addClass("active-slider").attr("src", img_path)
                $(this).addClass("active-slider");
            })

            $("body").on('mouseout', ".products__item-wrapper .products__item-photo-thumb-item", function () {
                $(this).closest('.products__item-wrapper').find('.products__item-photo-thumb-item').removeClass("active-slider");
                var img_path = $(this).closest(".products__item-photo-thumb").find("img").first().attr('src');
                $(this).closest('.products__item-wrapper').find(".products__item-photo img").addClass("active-slider").attr("src", img_path);
                $(this).addClass("active-slider");
            });
        }

    }



    var productSlider = new Product_slider();
    productSlider.products()
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
            $(this).parent().addClass('line-none');
        }
    });
    // search for mobile
    $('body').on('click', '.header-bottom .search-mobile-icon', function () {
        $(this).closest('.header-bottom').find('.cat-search').addClass('opened-full');
        $(this).hide()
        $(this).parent().find('.header-mobile-search-close').addClass('active')
    });
    $('body').on('click', '.header-bottom .header-mobile-search-close', function () {
        $(this).closest('.header-bottom').find('.cat-search').removeClass('opened-full');
        $(this).removeClass('active')
        $(this).parent().find('.search-mobile-icon').show()
    });

});


//new

$('.currency--select-2').select2({
    minimumResultsForSearch: Infinity,
    dropdownCssClass: "currency-dropdown"
});

$('.select_with-tag').select2();

$('#accounts--selects').select2({
    dropdownParent: $('.my-account--selects'),
    minimumResultsForSearch: Infinity
});

$('.select-2--no-search').select2({
    minimumResultsForSearch: Infinity
});

var afterHeight;
var productsWallHeight = parseInt( $('body').find('.products-box').height());
$("body").find(".products__item-wrapper").hover(
    function() {
        afterHeight = parseInt( $('body').find('.products__item-wrapper-inner').height());
        $(this).closest('.products-box').css('height',productsWallHeight)
        // $(this).closest('.products__item-wrapper').find('.products__item-wrapper-inner').css('height',567);
    }, function() {
        $(this).closest('.products__item-wrapper').find('.products__item-wrapper-inner').css('height','auto');
    }
);


$(document).ready(function () {
    $("#loading").fadeOut("slow", function () {
        var afterHeight;
        var productsWallHeight = parseInt( $('body').find('.products-box').height());
        $("body").find(".products__item-wrapper").hover(
            function() {
                afterHeight = parseInt( $('body').find('.products__item-wrapper-inner').height());
                $(this).closest('.products-box').css('height',productsWallHeight)
                // $(this).closest('.products__item-wrapper').find('.products__item-wrapper-inner').css('height',567);
            }, function() {
                $(this).closest('.products__item-wrapper').find('.products__item-wrapper-inner').css('height','auto');
            }
        );

        $(this).removeClass('d-flex').addClass('d-none'); // Optional if it's going to only be used once.
        $("#singleProductPageCnt").removeClass('d-none').addClass('d-flex');

        $('body').on('click', '#carousel-tabs-wrap a[aria-controls="pills-videos"]', function() {
            $(".video--carousel").carousel({
                pagination: false,
                controls: false,
            });

            $(".video--carousel-thumb").carousel({
                controls: false,
                pagination: false,
//                show: 4,
                matchWidth: false
            });

            $('.video-carousel-wrap iframe[src*="https://www.youtube.com/embed/"]').addClass("youtube-iframe");

            $('.video-carousel-wrap .video-item-thumb').on('itemClick.carousel', function () {
                $('body .youtube-iframe').each(function (index) {
                    $(".youtube-iframe")[index].contentWindow.postMessage(
                        '{"event":"command","func":"' + "stopVideo" + '","args":""}',
                        "*"
                    );
                    return true;
                });

            });
        });

        $(".product__single-top .brands-top-slider").carousel({
            pagination: false,
            // controls: false,
            infinite: true,
            matchWidth:false,
            show: {
                "740px": 2,
                "980px": 3,
                "1220px": 9
            }
        });
        $(".product-card-thumbs--single").carousel({
            controls: true,
            pagination: false,
            matchWidth: false
        });
        // start carousel tabs
        let activeTab = $('#carousel-tabs-wrap a').filter('.active');
        $('#carousel-tabs-wrap a').on('click', function (e) {
            e.preventDefault();
            activeTab.removeClass('active');
            $(activeTab.attr('href')).removeClass('active');
            activeTab = $(this);
            activeTab.addClass("active");
            $(activeTab.attr('href')).addClass('active');
        })
        $(".carousel-tabs").carousel({
            show: {
                "740px": 2,
                "980px": 3,
                "1220px": 2
            },
            matchWidth: false,
            controls: false,
            pagination: false
        });
        if ($(window).width() > 1400) {
            $(".carousel-tabs .fs-touch-element").touch("destroy");
        } else {
            $(".carousel-tabs .fs-touch-element").touch();
        }
        $(window).resize(function () {
            if ($(window).width() > 1400) {
                $(".carousel-tabs .fs-touch-element").touch("destroy");
            } else {
                $(".carousel-tabs .fs-touch-element").touch();
            }
        });


//                    end carousel tabs
    });


    $('body').on('keydown', '.continue-shp-wrapp_qty .field-input', function (ev) {
        ev.preventDefault();
        return false;
    });

    $("#singleProductPageCnt").fadeIn(function () {

        function checkLimit(value, max) {
            return value <= max;
        }

        const getCurrencySymbol = () => {
            return $('.header-bottom #symbol').val();
        };
        // $('.share-button').on('click', function(ev) {
        //     ev.stopImmediatePropagation();
        //     $('#share_modal').addClass('show');
        // });
        // $(document).click(function (e) {
        //     console.log(e.target);
        //     const containerBlock = $("#share_modal");
        //     let arrowLink = $('.share-button.facebook-share-button');
        //     console.log(arrowLink.has(e.target).length === 0,containerBlock.has(e.target).length === 0,containerBlock !== e.target);
        //     if ($(e.target).closest('#share_modal').length === 0 || $(e.target).hasClass('share_modal_close')) {
        //         if (containerBlock.hasClass('show')) {
        //             containerBlock.removeClass('show');
        //         }
        //     }
        // });
        //count total price function
        const countTotalPrice = () => {
            let total_price = 0;
            $('#singleProductPageCnt .product__single-item-info-price[data-single-price]').each(function() {
                // console.log('aaaa', $(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="checkbox"]').length === 1);
                if($(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="checkbox"]').length === 1) {
                    $(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="checkbox"]').is( ":checked" ) ? total_price += $(this).data('single-price')*1 : total_price = total_price;
                } else {
                    total_price += $(this).data('single-price')*1;
                }
            });
            return (total_price * $('.continue-shp-wrapp .continue-shp-wrapp_qty input[type="number"].field-input.product-qty-select').val()*1).toFixed(2);
        };

        const setOfferPrice = (offer, offerPrice) => {
            // console.log(totalPrice, 222222222222222222);
            offer.html(`${getCurrencySymbol()}${offerPrice}`);
        };

        const countOfferTotalPrice = () => {
            let offer_total_price = 0;
            $('.added-offers').find('.special__popup-content-right-product-price').each(function(key) {
                console.log(key);
                offer_total_price += Number($(this).data('price')).toFixed(2);
            });
            $('.offer-total-price').html(`${getCurrencySymbol()}${offer_total_price}`);
        };

        const countOfferPrice = (gget = false) => {

            $('#specialPopUpModal .special__popup-main-product-item').each(function() {
                var value = 0;
                var id = $(this).data('id');
                $(this).find('.pr-wrap').each(function() {
                    if($(this).data('per-price') === 'product') {
                        value += $(this).data('price');
                    } else if($(this).data('per-price') === 'item') {
                        $(this).find('.product__single-item-info-bottom').each(function() {
                            if($(this).closest('.product__single-item-info-bottom').find('.select-variation-option').length > 0 || ($(this).hasClass('get-single-price') && $(this).closest('.filter').length > 0)) {
                                value += $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price');
                            } else if($(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="radio"]').length > 0) {
                                value += $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price');
                            }  else if($(this).closest('.pr-wrap').find('.popup-select').length > 0) {
                                value += $(this).find('.get-single-price').data('single-price');
                            }else if($(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="checkbox"]').length > 0) {
                                if($(this).closest('.product__single-item-info-bottom').find('.custom-control-input').prop('checked')) {
                                    value += $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price');
                                }
                            }

                        });
                    }
                });

                $(this).find('.product__single-item_price').data('price-for-add', value);
                setOfferPrice($(this).find('.product__single-item_price'), value);
                // var addedPricePlace = $(`#specialPopUpModal .added-offers .special__popup-content-right-product[data-id="${id}"] .special__popup-content-right-product-price`);
                // if(!$(this).hasClass('user-non-select')) {
                //     addedPricePlace.data('price', value);
                //     addedPricePlace.html(`${getCurrencySymbol()}${value}`);
                // }
                countOfferTotalPrice();
            });
        };
        const setTotalPrice = (totalPrice) => {
            // console.log(totalPrice, 222222222222222222);
            totalPrice !== undefined && $('.continue-shp-wrapp .price-place-summary').html(`${getCurrencySymbol()}${Number(totalPrice).toFixed(2)}`);
        };



        countOfferPrice();


        setTotalPrice(countTotalPrice());

        $('body').on('click', " .continue-shp-wrapp_qty-minus.qty-count, .continue-shp-wrapp_qty-plus.qty-count", function() {
            const totalQtyInput = $(this).closest('.continue-shp-wrapp_qty').find('input.product-qty-select');
            console.log(111111, '--------')
            if($(this).hasClass('continue-shp-wrapp_qty-plus')) {
                totalQtyInput.val(totalQtyInput.val()*1 + 1);
            } else if($(this).hasClass('continue-shp-wrapp_qty-minus') && totalQtyInput.val()*1>1) {
                totalQtyInput.val(totalQtyInput.val() * 1 - 1);
            }
            setTotalPrice(countTotalPrice());
        });

        //qty up and down,  and input-qty
        $('body').on('click', '.product__single-item-info-bottom .inp-up, .product__single-item-info-bottom .inp-down',function(ev) {
            let flag;
            const input_qty = $(this).closest('.quantity').find('.input-qty');
            const qty = input_qty.val();
            let prevV;
            let nextV;
            console.log(222222, '--------')
            if($(this).hasClass('inp-up')) {
                if((qty*1 + 1) <= $(this).closest('.quantity').find('.product-qty_per_price').attr('max')){
                    input_qty.val(qty*1 + 1);
                    console.log(9999999, '--------');
                }
                flag = true;
            } else if($(this).hasClass('inp-down')) {
                prevV = $(this).closest('.quantity').find('input.product-qty').val()*1;
                qty>1 && input_qty.val(qty*1 - 1);
                nextV = $(this).closest('.quantity').find('input.product-qty').val()*1;
                flag = false;
            }



            let variation_id = 0;

            if($(this).closest('.filters-select-wizard').length > 0 || $(this).closest('.filter').find('.filters-modal-wizard').length > 0) {
                variation_id = $(this).closest('.product__single-item-info-bottom').data('id');
            } else if($(this).closest('.product__single-item-info-bottom').find('.select-variation-option').length > 0) {
                variation_id = $(this).closest('.product__single-item-info-bottom').find('.select-variation-option').val();
            } else if($(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="radio"]').length > 0) {
                variation_id = $(this).closest('.product__single-item-info-bottom').find('.custom-control-input:checked').val();
            }  else if($(this).closest('.product__single-item-info').find('.popup-select').length > 0 && $(this).closest('#singleProductPageCnt').length > 0) {
                variation_id = $(this).closest('.product__single-item-info-bottom').data('id');
                if(prevV === 1 && nextV === 1 && !flag) {
                    return true;
                } else {
                    $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price',
                        $(this)
                            .closest('.product__single-item-info-bottom')
                            .find('.product__single-item-info-price')
                            .data('single-price')*1
                        /(flag ? ($(this)
                            .closest('.quantity')
                            .find('input.product-qty')
                            .val()*1-1) : ($(this)
                            .closest('.quantity')
                            .find('input.product-qty')
                            .val()*1+1))
                        *($(this)
                            .closest('.quantity')
                            .find('input.product-qty')
                            .val()*1));
                    // $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price span').html(`${getCurrencySymbol()}${$(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price')}`);
                    // setTotalPrice(countTotalPrice());
                    // return true;
                }
            } else if($(this).closest('.pr-wrap').find('.popup-select').length > 0 && $(this).closest('#specialPopUpModal').length > 0) {
                variation_id = $(this).closest('.product__single-item-info-bottom').data('id');
                if(prevV === 1 && nextV === 1 && !flag) {
                    return true;
                } else {
                    $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price',
                        $(this)
                            .closest('.product__single-item-info-bottom')
                            .find('.product__single-item-info-price')
                            .data('single-price')*1
                        /(flag ? ($(this)
                            .closest('.quantity')
                            .find('input.product-qty')
                            .val()*1-1) : ($(this)
                            .closest('.quantity')
                            .find('input.product-qty')
                            .val()*1+1))
                        *($(this)
                            .closest('.quantity')
                            .find('input.product-qty')
                            .val()*1));
                    // $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price span').html(`${getCurrencySymbol()}${$(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price')}`);
                    // setTotalPrice(countTotalPrice());
                    // return true;
                }
            } else if($(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="checkbox"]').length > 0) {
                variation_id = $(this).closest('.product__single-item-info-bottom').find('.custom-control-input').val();
                // console.log($(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price')*1, ($(this).closest('.quantity').find('input.product-qty').val()*1-1), $(this).closest('.quantity').find('input.product-qty').val()*1);
                // console.log('val',$(this).closest('.product__single-item-info-bottom').find('.input.product-qty').val()*1);
                if(prevV === 1 && nextV === 1 && !flag) {
                    return true;
                } else {
                    $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price',
                        $(this)
                            .closest('.product__single-item-info-bottom')
                            .find('.product__single-item-info-price')
                            .data('single-price')*1
                        /(flag ? ($(this)
                            .closest('.quantity')
                            .find('input.product-qty')
                            .val()*1-1) : ($(this)
                            .closest('.quantity')
                            .find('input.product-qty')
                            .val()*1+1))
                        *($(this)
                            .closest('.quantity')
                            .find('input.product-qty')
                            .val()*1));
                    // $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price span').html(`${getCurrencySymbol()}${$(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price')}`);
                    // setTotalPrice(countTotalPrice());
                    // return true;
                }

            }
            const price_place = $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price span');
            fetch("/products/get-discount-price", {
                method: "post",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                credentials: "same-origin",
                body: JSON.stringify({
                    variation_id,
                    qty: input_qty.val()*1
                })
            })
                .then((res) => {
                    return res.json();
                })
                .then((data) => {
                    // alert(data.price)
                    console.log(333333, '--------')

                    price_place.html(`${getCurrencySymbol()}${data.price}`);
                    $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price', data.price);
                    setTotalPrice(countTotalPrice());
                    if($(this).closest('#specialPopUpModal')) {
                        $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price', data.price)
                        countOfferPrice();
                    }
                })
                .catch(error => console.error(error));
        });

        //select variation
        $('body').on('change', '#singleProductPageCnt select.select-variation-option.single-product-select', function(ev) {
            ev.preventDefault();
            const row = $(this).closest('.product__single-item-info-bottom');
            const group_id = row.data('id');
            const select_element_id = $(this).val();
            const vpid = $('#vpid').val();
            const $self = $(this);
            const val = $(this).val();
            const img_variation = $(this).find('option:selected').attr('data-img');
            const item = row.closest('.product__single-item-info');

            var img_path =  $(".product-single-view-outer").find('img[src="'+img_variation+'"]').first();
            if(img_path){
                $('.single-product_top-img').attr("src", img_path.attr('src'));
                console.log(img_path,'img_src_exists');
            }
            // var img_path = $(".products__item-photo-thumb").find("img").first().attr('src');
            // $(this).closest('.products__item-wrapper').find(".products__item-photo img").addClass("active-slider").attr("src", img_path);

            if(val !== 'no') {
               fetch("/products/get-variation-menu-raw", {
                method: "post",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                credentials: "same-origin",
                body: JSON.stringify({
                    group_id: group_id,
                    select_element_id: select_element_id,
                    vpid:vpid
                })
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    console.log(444444, '--------');

                    row.html(data.html);
                    row.find('.select-2').select2({minimumResultsForSearch: -1});
                    if(item.data('per-price') === 'product') {
                        item.find('.product__single-item-info-price').data('single-price', item.data('price')*1);
                        let currency = $('#symbol').val();
                        item.find('.product__single-item_price').text(currency + item.data('price')*1);
                    }
                    // row.find('.product-qty').select2();
                    $self.closest('.product__single-item-info').css('border-color', '#d7d7d7');
                    setTotalPrice(countTotalPrice());
                })
                .catch(function (error) {
                    console.log(error);
                });
            } else {
                if(item.data('per-price') === 'item') {
                    // item.data('price', 0);
                    item.find('.product__single-item-info-price').data('single-price', 0);
                    let currency = $('#symbol').val();
                    item.find('.product__single-item-info-price span').text(currency + item.find('.product__single-item-info-price').data('single-price')*1);
                } else if(item.data('per-price') === 'product') {
                    // item.data('price', 0);
                    item.find('.product__single-item-info-price').data('single-price', 0);
                    let currency = $('#symbol').val();
                    item.find('.product__single-item_price').text(currency + item.find('.product__single-item-info-price').data('single-price')*1);
                }
                setTotalPrice(countTotalPrice());
            }
        });

        $('body').on('change', '#specialPopUpModal select.select-variation-option.single-product-select', function(ev) {
            ev.preventDefault();
            const row = $(this).closest('.product__single-item-info-bottom');
            const group_id = row.data('id');
            const select_element_id = $(this).val();
            const vpid = $('#vpid').val();

            fetch("/products/get-offer-menu-raw", {
                method: "post",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                credentials: "same-origin",
                body: JSON.stringify({
                    group_id: group_id,
                    select_element_id: select_element_id,
                    vpid:vpid
                })
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    console.log(555555, '--------')

                    row.html(data.html);
                    row.find('.select-2').select2({minimumResultsForSearch: -1});
                    if($(this).closest('#specialPopUpModal')) {
                        $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price', data.price)
                        countOfferPrice();
                    }

                })
                .catch(function (error) {
                    console.log(error);
                });
        });

        //add new single item
        $('body').on('click', '#singleProductPageCnt .product__single-item-add-new a.product__single-item-add-new-btn', function(ev) {
            ev.preventDefault();
            const row = $(this).closest('.product__single-item-info');
            const id = row.data('group-id');
            const $self = $(this);
            console.log(666666, $self.closest('.product__single-item-info.limit').find('.product__single-item-info-bottom').length, $self.closest('.product__single-item-info.limit').data('limit'), $self.closest('.product__single-item-info.limit').data('min-limit'));
            checkLimit($self.closest('.product__single-item-info.limit').find('.product__single-item-info-bottom').length + 1,   $self.closest('.product__single-item-info.limit').data('limit')) && fetch("/products/get-variation-menu-raw", {
                method: "post",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                credentials: "same-origin",
                body: JSON.stringify({
                    id
                })
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    // row.html(data.html);
                    console.log(666666, '--------');

                    const single_item_info_bottom = row.find('.product__single-item-info-bottom');
                    row.find('.product__single-item-add-new').before(data.html);

                    // console.log(row.find('.select-2'));
                    row.find('.product__single-item-info-bottom').last().find('.select-2').select2({minimumResultsForSearch: -1});
                    $self.closest('.product__single-item-info').css('border-color', '#d7d7d7');

                    setTotalPrice(countTotalPrice());
                    // const new_rows_list = row.find('.product__single-item-info-bottom');
                    // console.log($(new_rows_list[new_rows_list.length - 1]).find('select'));
                    // $(new_rows_list[new_rows_list.length-1]).find('select').select2()
                })
                .catch(function (error) {
                    console.log(error);
                });
        });

        $('body').on('click', '#specialPopUpModal .product__single-item-add-new a.product__single-item-add-new-btn', function(ev) {
            ev.preventDefault();
            console.log(777777, '--------');
            const $self = $(this);
            const row = $self.closest('.pr-wrap');
            const id = row.data('group-id');
            $self.closest('.limit.pr-wrap').css('border', 'none');
            checkLimit($self.closest('.limit.pr-wrap').find('.product__single-item-info-bottom').length + 1,   $self.closest('.limit.pr-wrap').data('limit')) && fetch("/products/get-offer-menu-raw", {
                method: "post",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                credentials: "same-origin",
                body: JSON.stringify({
                    id
                })
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    // row.html(data.html);
                    const single_item_info_bottom = row.find('.product__single-item-info-bottom');
                    row.find('.product__single-item-add-new').before(data.html);

                    // console.log(row.find('.select-2'));
                    row.find('.product__single-item-info-bottom').last().find('.select-2').select2({minimumResultsForSearch: -1});
                    if($(this).closest('#specialPopUpModal')) {
                        $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price', data.price)
                        countOfferPrice();
                    }
                    setTotalPrice(countTotalPrice());
                    // const new_rows_list = row.find('.product__single-item-info-bottom');
                    // console.log($(new_rows_list[new_rows_list.length - 1]).find('select'));
                    // $(new_rows_list[new_rows_list.length-1]).find('select').select2()
                })
                .catch(function (error) {
                    console.log(error);
                });
        });

        $('body').on('click', '#singleProductPageCnt .remove-single_product-item', function() {
            console.log(888888, '--------')

            $(this).closest('.product__single-item-info-bottom').remove();
            $(this).closest('.product__single-item-info').css('border-color', '#d7d7d7');
            setTotalPrice(countTotalPrice());
        });

        $('body').on('click', '#specialPopUpModal .remove-single_product-item', function() {
            console.log(999999, '--------')

            $(this).closest('.product__single-item-info-bottom').remove();
            countOfferPrice();
        });

        //select-qty
        $('body').on('change', 'select.select-qty', function(ev) {
            const price_place = $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price span');
            const variation_id = $(this).closest('.product__single-item-info-bottom').find('.select-variation-option').val();
            const discount_id = $(this).val();

            fetch("/products/get-discount-price", {
                method: "post",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                credentials: "same-origin",
                body: JSON.stringify({
                    variation_id,
                    discount_id
                })
            })
                .then((res) => {
                    return res.json();
                })
                .then((data) => {
                    console.log(101010, '--------')

                    price_place.html(`${getCurrencySymbol()}${data.price}`);
                    $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price', data.price);
                    setTotalPrice(countTotalPrice());
                    if($(this).closest('#specialPopUpModal')) {
                        $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price', data.price);
                        countOfferPrice();
                    }
                })
                .catch(error => console.error(error));
        });

        $('body').on('input', '#singleProductPageCnt .product_radio-single .custom-radio .custom-control-input[type="checkbox"]', function(ev) {
            ev.preventDefault();
            console.log(121212, '--------');
            if($(this).is(':checked') && checkLimit($(this).closest('.product__single-item-info').find('.custom-control-input:checked').length, $(this).closest('.product__single-item-info.limit').data('limit'))) {
                $(this).closest('.product__single-item-info').css('border-color', '#d7d7d7');
                setTotalPrice(countTotalPrice());
            } else {
                $(this).prop('checked', false);
                setTotalPrice(countTotalPrice());
            }

            const img_variation = $(this).attr('data-img');
            var img_path =  $(".product-single-view-outer").find('img[src="'+img_variation+'"]').first();
            if(img_path){
                $('.single-product_top-img').attr("src", img_path.attr('src'));
            }
            // const row = $(this).closest('.product__single-item-info-bottom');
            // const group_id = $(this).data('id');
            // const select_element_id = $(this).val();
            // const vpid = $('#vpid').val();

        });

        $('body').on('change', '#specialPopUpModal .product_radio-single .custom-radio .custom-control-input[type="checkbox"]', function(ev) {
            ev.preventDefault();
            console.log(131313, '--------');
            $(this).closest('.limit.pr-wrap').css('border', 'none');
            if($(this).is(':checked') && checkLimit($(this).closest('.limit.pr-wrap').find('.custom-control-input:checked').length, $(this).closest('.pr-wrap.limit').data('limit'))) {
                if($(this).closest('#specialPopUpModal')) {
                    countOfferPrice();
                }
            } else {
                $(this).prop('checked', false);
                countOfferPrice();
            }
            // const row = $(this).closest('.product__single-item-info-bottom');
            // const group_id = $(this).data('id');
            // const select_element_id = $(this).val();
            // const vpid = $('#vpid').val();
            // if($(this).closest('#specialPopUpModal')) {
            //     countOfferPrice();
            // }
        });

        $('body').on('change', '#singleProductPageCnt .product_radio-single .custom-radio .custom-control-input[type="radio"]', function(ev) {
            ev.preventDefault();
            const row = $(this).closest('.product__single-item-info-bottom');
            const group_id = $(this).data('id');
            const select_element_id = $(this).val();
            const vpid = $('#vpid').val();
            const $self = $(this);

            const img_variation = $self.attr('data-img');
            var img_path =  $(".product-single-view-outer").find('img[src="'+img_variation+'"]').first();
            if(img_path){
                $('.single-product_top-img').attr("src", img_path.attr('src'));
            }

            fetch("/products/get-variation-menu-raw", {
                method: "post",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                credentials: "same-origin",
                body: JSON.stringify({
                    group_id: group_id,
                    select_element_id: select_element_id,
                    vpid:vpid
                })
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    console.log(141414, '--------')

                    row.html(data.html);
                    row.find('.select-2').select2({minimumResultsForSearch: -1});
                    $self.closest('.product__single-item-info').css('border-color', '#d7d7d7');
                    // row.find('.product-qty').select2();
                    setTotalPrice(countTotalPrice());
                })
                .catch(function (error) {
                    console.log(error);
                });
        });

        $('body').on('change', '#specialPopUpModal .product_radio-single .custom-radio .custom-control-input[type="radio"]', function(ev) {
            ev.preventDefault();
            const row = $(this).closest('.product__single-item-info-bottom');
            const group_id = $(this).data('id');
            const select_element_id = $(this).val();
            const vpid = $('#vpid').val();

            fetch("/products/get-offer-menu-raw", {
                method: "post",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                credentials: "same-origin",
                body: JSON.stringify({
                    group_id: group_id,
                    select_element_id: select_element_id,
                    vpid:vpid
                })
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    console.log(151515, '--------')

                    row.html(data.html);
                    row.find('.select-2').select2({minimumResultsForSearch: -1});
                    // row.find('.product-qty').select2();
                    if($(this).closest('#specialPopUpModal')) {
                        // $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price', data.price)
                        countOfferPrice();
                    }
                    // setTotalPrice(countTotalPrice());
                })
                .catch(function (error) {
                    console.log(error);
                });
        });

        const btnAddToRemove = (btn) => {
            btn.removeClass('add-btn').addClass('remove-btn');
            btn.html('remove');
        };

        const btnRemoveToAdd = (btn) => {
            btn.removeClass('remove-btn').addClass('add-btn');
            btn.html('add');
        };

        minLimitCheck = ($self) => {
            const wrapper = $self.closest('.special__popup-main-product-item');
            const wrongLimit = [];
            wrapper.find('.limit.pr-wrap').each(function() {
                const minLimit = $(this).data('min-limit');
                if($(this).find('.product__single-item-add-new').length > 0) {
                    $(this).find('.single-product-select').length < minLimit && wrongLimit.push($(this).data('group-id'));
                } else if ($(this).find('.custom-control-input[type="checkbox"]').length > 0) {
                    let count = 0;
                    $(this).find('.custom-control-input[type="checkbox"]').each(function() {
                        $(this).is(':checked') && ++count;
                    });
                    count < minLimit && wrongLimit.push($(this).data('group-id'));
                } else if($(this).find('.popup-select').length > 0) {
                    $(this).find('.product__single-item-info-bottom').length < minLimit && wrongLimit.push($(this).data('group-id'));
                }
            });

            return wrongLimit;
        };

        $('body').on('click', '.special__popup-main-product-item-btn.add-btn', function() {
            const id = $(this).closest('.special__popup-main-product-item').data('id');
            const price = $(this).closest('.special__popup-main-product-item').find('.product__single-item_price').data('price-for-add');
            const $self = $(this);
            const wrongMinLimit = minLimitCheck($self);
            console.log(wrongMinLimit);
            if(wrongMinLimit.length === 0) {
                fetch("/products/add-offer", {
                    method: "post",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": $('input[name="_token"]').val()
                    },
                    credentials: "same-origin",
                    body: JSON.stringify({
                        id,
                        price
                    })
                })
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (data) {
                        $self.closest('.special__popup-main-product-item').addClass('active');
                        $self.closest('.special__popup-main-product-item').addClass('user-non-select');
                        // console.log($self.closest('.special__popup-main-product-item'));
                        btnAddToRemove($self);
                        if($(`#specialPopUpModal .added-offers .special__popup-content-right-product[data-id="${id}"]`).length === 0) {
                            $('.special__popup-content-right-item.added-offers').append(data.html);
                        }
                        countOfferTotalPrice();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            } else {
                wrongMinLimit.map((groupId) => {
                    $self.closest('.special__popup-main-product-item').find(`.limit.pr-wrap[data-group-id="${groupId}"]`).css('border', '1px solid red');
                });
            }

        });

        $('body').on('click', '.special__popup-main-product-item-btn.remove-btn', function() {
            btnRemoveToAdd($(this));
            $(this).closest('.special__popup-main-product-item').removeClass('active');
            const id = $(this).closest('.special__popup-main-product-item').data('id');
            $('.special__popup-content-right-item.added-offers').find(`.special__popup-content-right-product[data-id="${id}"]`).remove();
            countOfferTotalPrice();
        });

        $('body').on('click', '.special__popup-content-right-product-remove', function() {
            const id = $(this).closest('.special__popup-content-right-product').data('id');
            $(this).closest('.special__popup-content-right-product').remove();
            const product = $(`#specialPopUpModal .special__popup-main-product-item[data-id="${id}"]`);
            const buttonCart = product.find('.special__popup-main-product-item-btn');
            product.removeClass('active');
            buttonCart.removeClass('remove-btn').addClass('add-btn').html('add');
            if(buttonCart.closest('.user-non-select').length > 0) {
                buttonCart.closest('.user-non-select').removeClass('user-non-select');
            }
            countOfferTotalPrice();
        });

        //data object for add-to-cart and extra
        const addDataKey = {};

//item price
        let item_price = 0;

//section price
        let section_price = 0;

//extra group ids
        const selectedGroupId = [];



//event default
        const eventInitialDefault = (ev) => {
            ev.preventDefault();
            ev.stopImmediatePropagation();
        };

// return true if argument is checked
        const isChecked = (checkbox) => {
            return checkbox.is(':checked');
        };

//return true if argument is required
        const isReq = (el) => {
            return Number(el.closest('[data-req]').attr('data-req'));
        };

//return true if arguments is section and false if arguments is item
        const isSection = (el) => {
            return el.closest('[data-per-price]').attr('data-per-price') === "product";
        };

//return true if argument is single select
        const isSingle = (select) => {
            if (select.attr('id')) {
                return select.attr('id').includes('single');
            }
        };

//return true if we are on the cart page
        const isCartPage = () => {
            return $('.shopping-cart_wrapper').length !== 0;
        };


//pass element and get row
        const getRow = (el) => {
            return $(el).closest('product-single-info_row');
        };



// product-count-plus event callback
        const handleProductCountPlus = (plus_button, section, type, limit) => {
            const counter = $(plus_button.closest('.continue-shp-wrapp_qty').find('.field-input')[0]);

            // new_qty(section);
            // Number(counter.val()) < Number(limit) - Number(new_qty(section)) +
            Number($(plus_button.closest('.continue-shp-wrapp_qty').find('.field-input')[0]).val()) && counter.val(Number(counter.val()) + 1);
            // new_qty(section);
            // if (type === 'select') {
            //     select2MaxLimit(section, limit);
            // }

            const price = plus_button.closest('[data-price]').attr('data-price');
            plus_button.closest('[data-price]').find('.price-placee').html(`${getCurrencySymbol()}${price * Number(counter.val())}`);
        };

//create hidden input and take data for filter modal
        const createInputHiddenForFilter = (items, self) => {
            let inputHidden = document.createElement('input');
            $(inputHidden).attr({
                type: 'hidden',
                name: self.attr('data-name'),
                value: items
            });
            $('body').find(`.${self.attr('id')}`).closest('.product-single-info_row').find('.product-single-info_row-items').append($(inputHidden));
        };



        const makeSelectedItemModal = (id, title, filter) => {
            return (`<div class="col-md-2 col-sm-3 selected-item_popup" data-id-popup="${id}">
                              <div class="d-flex justify-content-between selected-item_popup-wrapper">
                                <div class="align-self-center text-truncate">
                                  ${title}
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                  <div class="mr-1">Qty</div>
                                  <div class="continue-shp-wrapp_qty position-relative mr-0">
                                    <!--minus qty-->
                                    <span class="d-flex align-items-center pointer position-absolute selected-item-popup_qty-minus qty-count">
                                                    <svg viewBox="0 0 20 3" width="12px" height="3px">
                                                        <path fill-rule="evenodd" fill="rgb(214, 217, 225)"
                                                              d="M20.004,2.938 L-0.007,2.938 L-0.007,0.580 L20.004,0.580 L20.004,2.938 Z"></path>
                                                    </svg>
                                                </span>
                                    <input class="popup_field-input w-100 h-100 font-23 text-center border-0 selected-item-popup_qty-select none-touchable" min="number" name=""
                                           type="number" value="1">
                                    <!--plus qty-->
                                    <span class="d-flex align-items-center pointer position-absolute selected-item-popup_qty-plus qty-count">
                                                    <svg viewBox="0 0 20 20" width="15px" height="15px">
                                                        <path fill-rule="evenodd" fill="rgb(211, 214, 223)"
                                                              d="M20.004,10.938 L11.315,10.938 L11.315,20.000 L8.696,20.000 L8.696,10.938 L-0.007,10.938 L-0.007,8.580 L8.696,8.580 L8.696,0.007 L11.315,0.007 L11.315,8.580 L20.004,8.580 L20.004,10.938 Z"></path>
                                                    </svg>
                                                </span>
                                  </div>
                                  <div>
                                    <a href="javascript:void(0)" data-el-id="${id}" class="btn btn-sm delete-menu-item${!filter ? '_popup' : ''} text-danger"><i class="fa fa-times"></i></a>
                                </div>
                                </div>
                              </div>
                            </div>`);
        };

        const makeOutOfStockSelectOption = (select, type) => {
            if (type === "select") {
                select.find('[data-out="1"]').attr('disabled', 'disabled');


                const current_item_id = $(select.find('[data-out="0"]')[0]).attr('data-select2-id');
                // new_qty(select);
                if (isSingle(select)) {
                    select.find('[data-out="0"]').length > 0 && select.val($(select.find('[data-out="0"]')[0]).val());
                    fetch("/products/get-variation-menu-raw", {
                        method: "post",
                        headers: {
                            "Content-Type": "application/json",
                            Accept: "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-Token": $('input[name="_token"]').val()
                        },
                        credentials: "same-origin",
                        body: JSON.stringify({
                            id: $(select.find('[data-out="0"]')[0]).val(),
                            selectElementId: current_item_id
                        })
                    })
                        .then(function (response) {
                            return response.json();
                        })
                        .then(function (json) {
                            if (isSingle(select)) {
                                !isSection(select) && (select.closest('.product-single-info_row').find('.selected-menu-options').html(json.html));
                            } else {
                                select.closest('.product-single-info_row').find('.product-single-info_row-items').append(json.html);
                            }
                            setTotalPrice(countTotalPrice());
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            } else if (type === "list") {
                select.find('[data-out="1"]').addClass('none-touchable-op');
            } else if (type === "popup") {
                select.find('[data-out="1"]').closest('.single-item-wrapper').addClass('none-touchable-op');
            } else if (type === "filter") {
                // console.log('filter stock', select);
                select.find('[data-out="1"]').addClass('none-touchable-op');
            }
        };

        const discountInputChange = ($ev, $element, discount_type) => {
            // console.log('99999999999999999999999999999999999999', discount_type);
            const variation_id = $element.attr('data-id');
            // console.log(variation_id);
            if(discount_type === 'range') {
                const qty = $element.val();
                fetch("/products/get-discount-price", {
                    method: "post",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": $('input[name="_token"]').val()
                    },
                    credentials: "same-origin",
                    body: JSON.stringify({
                        variation_id,
                        qty
                    })
                })
                    .then((res) => {
                        return res.json();
                    })
                    .then((data) => {
                        $element.closest('.menu-item-selected').find('.price-placee').html(`${getCurrencySymbol()}${data.price}`);
                    })
                    .catch(error => console.error(error));
            } else if(discount_type === 'fixed') {
                const discount_id = $element.val();
                fetch("/products/get-discount-price", {
                    method: "post",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": $('input[name="_token"]').val()
                    },
                    credentials: "same-origin",
                    body: JSON.stringify({
                        variation_id,
                        discount_id
                    })
                })
                    .then((res) => {
                        return res.json();
                    })
                    .then((data) => {
                        $element.closest('.menu-item-selected').find('.price-placee').html(`${getCurrencySymbol()}${data.price}`);
                    })
                    .catch(error => console.error(error));
            }

        };

        const unselectHandle = (select, id) => {
            select.closest('.filters-select-wizard').find(`.product__single-item-info-bottom[data-id="${id}"]`).remove();
            setTimeout(function () {
                // select2MaxLimit(select, limit);
                // setTotalPrice(false);
                setTotalPrice(countTotalPrice());
            }, 0);
        };

        const selectHandle = (el, id, selectElementId, limit, select) => {

            // console.log('el', el, 'id', id, 'selectElementId', selectElementId, 'select',select)
            fetch("/products/get-variation-menu-raws", {
                method: "post",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                credentials: "same-origin",
                body: JSON.stringify({items: [{id: id, value: 1}], ids: [id]})
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (json) {
                    // const isMultiple = select.closest('[data-limit]').attr('data-limit') === '1' ? false : true;

                    el.closest('.product__single-item-info-bottom').find('.filter-children-items').append(json.html);
                    // select2MaxLimit(select, limit);
                    setTotalPrice(countTotalPrice());
                    // el.closest('.product__single-item-info-bottom').find('.filter-children-items').find('.product__single-item-info-bottom').remove();
                    // el.closest('.product__single-item-info-bottom').find('.filter-children-items').append(json.html);
                    // el.closest('.product-single-info_row').find('.filter .col-sm-2.pl-sm-3.p-0.text-sm-center').html($(el.closest('.product-single-info_row').find('.filter-children-items').children()[1]));
                    // console.log('$(el.closest(\'.product__single-item-info-bottom\').find(\'.filter-children-items\').children()[1])', $(el.closest('.product__single-item-info-bottom').find('.filter-children-items').children()[1]));
                    // $(el.closest('.product__single-item-info-bottom').find('.filter-children-items').children()[1]).remove();
                    el.closest('.product__single-item-info-bottom').find('.filter-children-items').find('.select-2').each(function() {
                        $(this).select2({minimumResultsForSearch: -1});
                    });
                    el.closest('.product__single-item-info').css('border-color', '#d7d7d7');
                    el.closest('.filters-select-wizard').on('click', '.remove-single_product-item', function(ev) {
                        // ev.stopImmediatePropagation();
                        unselectHandle($(this), $(this).closest('.product__single-item-info-bottom').data('id'));
                    });


                    // setTotalPrice(modal);
                })
                .catch(function (error) {
                    console.log(error);
                });
        };


        const selectOfferHandle = (el, id, selectElementId, limit, select) => {

            // console.log('el', el, 'id', id, 'selectElementId', selectElementId, 'select',select)
            fetch("/products/get-offer-menu-raws", {
                method: "post",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                credentials: "same-origin",
                body: JSON.stringify({items: [{id: id, value: 1}], ids: [id]})
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (json) {
                    // const isMultiple = select.closest('[data-limit]').attr('data-limit') === '1' ? false : true;

                    el.closest('.filter-children-items').append(json.html);
                    // select2MaxLimit(select, limit);
                    // setTotalPrice(countTotalPrice());

                    // el.closest('.product__single-item-info-bottom').find('.filter-children-items').find('.product__single-item-info-bottom').remove();
                    // el.closest('.product__single-item-info-bottom').find('.filter-children-items').append(json.html);
                    // el.closest('.product-single-info_row').find('.filter .col-sm-2.pl-sm-3.p-0.text-sm-center').html($(el.closest('.product-single-info_row').find('.filter-children-items').children()[1]));
                    // console.log('$(el.closest(\'.product__single-item-info-bottom\').find(\'.filter-children-items\').children()[1])', $(el.closest('.product__single-item-info-bottom').find('.filter-children-items').children()[1]));
                    // $(el.closest('.product__single-item-info-bottom').find('.filter-children-items').children()[1]).remove();
                    el.closest('.product__single-item-info-bottom').find('.filter-children-items').find('.select-2').each(function() {
                        $(this).select2({minimumResultsForSearch: -1});
                    });
                    el.closest('.product__single-item-info').css('border-color', '#d7d7d7');
                    el.closest('.filters-select-wizard').on('click', '.remove-single_product-item', function(ev) {
                        // ev.stopImmediatePropagation();
                        unselectHandle($(this), $(this).closest('.product__single-item-info-bottom').data('id'));
                    });
                    countOfferPrice();
                    countOfferTotalPrice();

                    // setTotalPrice(modal);
                })
                .catch(function (error) {
                    console.log(error);
                });
        };
// //unselect handle function

        // const filterModalSingleInit = () => {
        //     (function () {
        //         const $body = $('body');
        //
        //         $(`#singleProductPageCnt .filters-modal-wizard`).each(function (index) {
        //             const group_id = $(this).attr('data-group');
        //             const filter = [];
        //
        //             let dg = null;
        //             let filter_limit = 0;
        //
        //             $("body").on('click', `.filters-modal-wizard[data-group="${group_id}"]`, function () {
        //                 dg = $(this).attr('data-group');
        //                 let group = $(this).attr('data-group');
        //                 filter_limit = $(this).closest('.limit').attr('data-limit');
        //                 const selectedIds = $(this).closest('.product-single-info_row').find('.menu-item-selected').toArray().map(function (item) {
        //                     return $(item).attr('data-id');
        //                 });
        //                 // console.log('index',index);
        //                 $.ajax({
        //                     type: "post",
        //                     url: "/products/select-items",
        //                     cache: false,
        //                     data: {
        //                         group,
        //                         selectedIds,
        //                         type: "popup"
        //                     },
        //                     headers: {
        //                         "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
        //                     },
        //                     success: function (data) {
        //                         if (!data.error) {
        //                             $("#wizardViewModal .selected-items_filter").empty();
        //                             $(`.filter[data-group-id="${group}"]`).closest('.product-single-info_row').find('.menu-item-selected').toArray().map((selectedItem) => {
        //                                 const selectedItemId = $(selectedItem).attr('data-id');
        //                                 const selectedItemTitle = $(selectedItem).find('.delete-menu-item').parent().text().trim();
        //                                 // $("#wizardViewModal .selected-items_filter").append(makeSelectedItemModal(selectedItemId, selectedItemTitle, true));
        //                             });
        //                             $("#wizardViewModal").modal();
        //                         } else {
        //                             alert("error");
        //                         }
        //                     }
        //                 });
        //             });
        //
        //             $("body").on('click', `#wizardViewModal[data-group="${group_id}"] .shopping-cart_wrapper .wrap-item`, function (ev) {
        //                 const id = $(this).attr('data-id');
        //                 const title = $(this).find('.name').text().trim();
        //                 filter_limit = $(`.filters-modal-wizard[data-group="${$(this).closest('[data-group]').attr('data-group')}"]`).closest('.limit').attr('data-limit');
        //                 // filter_limit > new_qty(null, 'filter') &&
        //                 if (!$(this).hasClass('active')) {
        //                     $(this).addClass('active');
        //                     // $('.selected-items_filter').append(makeSelectedItemModal(id, title, true));
        //                 } else if ($(this).hasClass('active')) {
        //                     $(`[data-id-popup="${id}"]`).remove();
        //                     $(this).removeClass('active');
        //                 }
        //             });
        //
        //             $('body').on('click', '#wizardViewModal .selected-item-popup_qty-minus', function (ev) {
        //                 eventInitialDefault(ev);
        //                 $(this).siblings(".popup_field-input").val() > 1 && $(this).siblings(".popup_field-input").val(Number($(this).siblings(".popup_field-input").val()) - 1);
        //             });
        //
        //             $('body').on('click', '#wizardViewModal .selected-item-popup_qty-plus', function (ev) {
        //                 eventInitialDefault(ev);
        //                 filter_limit = $(`.filters-modal-wizard[data-group="${$(this).closest('[data-group]').attr('data-group')}"]`).closest('.limit').attr('data-limit');
        //                 if (filter_limit > new_qty(null, 'filter')) {
        //                     $(this).siblings(".popup_field-input").val(Number($(this).siblings(".popup_field-input").val()) + 1);
        //                 }
        //             });
        //
        //             $('body').on('click', '#wizardViewModal .selected-item_popup .delete-menu-item', function () {
        //                 const remove_id = $(this).attr('data-el-id');
        //                 $('#wizardViewModal').find(`.wrap-item[data-id="${remove_id}"]`).removeClass('active');
        //                 $(this).closest('.selected-item_popup').remove();
        //             });
        //
        //
        //             $('body').on('click', `#wizardViewModal[data-group="${group_id}"] .add-items-btn`, function () {
        //                 const items_array = [];
        //                 // console.log(2, '*****************************')
        //
        //                 $('#wizardViewModal .modal-body').find('.wrap-item').each(function () {
        //                     $(this).hasClass('active') && (items_array.push($(this).attr('data-id')));
        //                 });
        //
        //                 const popup_items_qty = [];
        //                 // console.log($(`[data-id-popup].selected-item_popup`).find('.popup_field-input'));
        //                 $(`[data-id-popup].selected-item_popup`).find('.popup_field-input').each(function () {
        //                     const $this = $(this);
        //                     popup_items_qty.push({
        //                         id: $this.closest('.selected-item_popup').attr('data-id-popup'),
        //                         value: $this.val()
        //                     });
        //                 });
        //
        //                 fetch("/products/get-variation-menu-raws", {
        //                     method: "post",
        //                     headers: {
        //                         "Content-Type": "application/json",
        //                         Accept: "application/json",
        //                         "X-Requested-With": "XMLHttpRequest",
        //                         "X-CSRF-Token": $('input[name="_token"]').val()
        //                     },
        //                     credentials: "same-origin",
        //                     body: JSON.stringify({ids: items_array})
        //                 })
        //                     .then(function (response) {
        //                         return response.json();
        //                     })
        //                     .then(function (json) {
        //                         const items_row = $(`[data-group-id="${dg}"]`).find('.product-single-info_row-items');
        //                         items_row.append(json.html);
        //                         const selects = items_row.find('.select-2');
        //                         selects.length > 0 && selects.each(function() {
        //                             $(this).select2({minimumResultsForSearch: -1});
        //                         });
        //                         $(`[data-group-id="${dg}"]`).closest('.product__single-item-info').css('border-color', '#d7d7d7');
        //                         // $(`[data-group-id="${dg}"]`).closest('.product-single-info_row').find('.field-input').each(function () {
        //                         //     const d_id = $(this).attr('data-id');
        //                         //     const value = popup_items_qty.length > 0 && popup_items_qty.find((el) => {
        //                         //         return el.id === d_id;
        //                         //     }).value;
        //                         //     $(this).val(value);
        //                         //     $(this).closest('.menu-item-selected').find('.price-placee').html(getCurrencySymbol() + $(this).closest('.menu-item-selected').attr('data-price') * Number($(this).val()));
        //                         // });
        //                         setTotalPrice(countTotalPrice());
        //
        //                         $('#wizardViewModal').modal('hide');
        //
        //
        //
        //                         $(`[data-group="${dg}"]`).closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
        //                             $(this).closest('.menu-item-selected').remove();
        //                             setTotalPrice(countTotalPrice());
        //                         });
        //
        //                         $(`[data-group="${dg}"]`).closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
        //                             ev.preventDefault();
        //                             ev.stopImmediatePropagation();
        //                             const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
        //
        //                             handleProductCountMinus($(this), $(`[data-group="${dg}"]`), 'popup', limit);
        //                             setTotalPrice(countTotalPrice());
        //
        //                         });
        //
        //                         $(`[data-group="${dg}"]`).closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
        //                             ev.preventDefault();
        //                             ev.stopImmediatePropagation();
        //                             const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
        //
        //                             handleProductCountPlus($(this), $(`[data-group="${dg}"]`), 'popup', limit);
        //                             setTotalPrice(countTotalPrice());
        //                         });
        //                     });
        //             });
        //
        //             $(this).on('click', function (e) {
        //                 const first_category_id = $(this).attr('data-action');
        //                 let self = $(this);
        //                 let selectMoreItems = [];
        //                 let selectSingleItems;
        //
        //                 $body.on('click', `#wizardViewModal[data-group="${group_id}"] .shopping-cart_wrapper .item-content`, function () {
        //                     $('.shopping-cart_wrapper .item-content').removeClass('active');
        //                     $(this).addClass('active');
        //                 });
        //
        //                 $body.on('click', `#wizardViewModal[data-group="${group_id}"] .add-items-btn`, function (e) {
        //                     eventInitialDefault(e);
        //                     // console.log(1, '*****************************')
        //
        //                     $(`.filter[data-group-id="${group_id}"]`).find('.product-single-info_row-items').empty();
        //
        //                     if (Number(self.attr('data-multiple')) === 1) {
        //                         $(this).closest('.contents-wrapper').find('.wrap-item.active').each(function () {
        //                             selectMoreItems.push($(this).attr('data-id'));
        //                         });
        //                         selectMoreItems.forEach((item) => {
        //                             createInputHiddenForFilter(item, self);
        //                         });
        //                     } else {
        //                         selectSingleItems = $(this).closest('.contents-wrapper').find('.wrap-item.active').attr('data-id');
        //                         createInputHiddenForFilter(selectSingleItems, self);
        //                     }
        //
        //                     $('#wizardViewModal').modal('hide');
        //                 });
        //
        //                 $.ajax({
        //                     type: "post",
        //                     url: "/filters",
        //                     cache: false,
        //                     data: {
        //                         group: self.attr('data-group'),
        //                         category_id: first_category_id,
        //                         filters: filter,
        //                         type: "popup"
        //                     },
        //                     headers: {
        //                         "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
        //                     },
        //                     success: function (data) {
        //                         if (!data.error) {
        //                             const modal_group_id = self.attr('data-group');
        //                             $('#wizardViewModal').attr('data-group', modal_group_id);
        //                             const contantPlace = $('.contents-wrapper .content');
        //                             const wizardPlace = $('.shopping-cart-head .nav-pills');
        //
        //                             wizardPlace.empty();
        //                             wizardPlace.append(data.wizard);
        //                             if (data.type === "filter") {
        //                                 contantPlace.html(data.filters);
        //                             } else if (data.type === "items") {
        //                                 contantPlace.html(data.items_html);
        //                                 makeOutOfStockSelectOption($('#wizardViewModal'), 'filter');
        //                                 $('.shopping-cart_wrapper .next-btn').addClass('d-none');
        //                                 $('.shopping-cart_wrapper .add-items-btn').removeClass('d-none');
        //                             }
        //                         } else {
        //                             alert("error");
        //                         }
        //                     },
        //                     error: function (error) {
        //                         filter.pop();
        //                     }
        //                 });
        //
        //                 $body.on('click', `#wizardViewModal[data-group="${group_id}"] .shopping-cart_wrapper .next-btn`, function (e) {
        //                     eventInitialDefault(e);
        //                     $('.content-wrap').find('.active').toArray().map(function (actv) {
        //                         filter.push($(actv).closest('[data-id]').attr('data-id'));
        //                     });
        //                     // console.log(filter);
        //
        //                     $('.content-wrap').find('.active').length === 0 ? alert('select item') : $.ajax({
        //                         type: "post",
        //                         url: "/filters",
        //                         cache: false,
        //                         data: {
        //                             group: self.attr('data-group'),
        //                             category_id: first_category_id,
        //                             filters: filter,
        //                             type: "popup"
        //                         },
        //                         headers: {
        //                             "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
        //                         },
        //                         success: function (data) {
        //                             if (!data.error) {
        //                                 $('.shopping-cart-head .nav-pills').empty();
        //                                 $('.shopping-cart-head .nav-pills').append(data.wizard);
        //                                 $('.back-btn').removeClass('d-none');
        //                                 if (data.type === "filter") {
        //                                     $('.contents-wrapper .content').html(data.filters);
        //                                 } else if (data.type === "items") {
        //                                     $('.contents-wrapper .content').html(data.items_html);
        //                                     $(`#wizardViewModal[data-group="${group_id}"] .selected-item_popup`).each(function () {
        //                                         $(this).closest('#wizardViewModal').find(`.wrap-item[data-id="${$(this).attr('data-id-popup')}"]`).length > 0
        //                                         && $(this).closest('#wizardViewModal').find(`.wrap-item[data-id="${$(this).attr('data-id-popup')}"]`).addClass('active');
        //                                     });
        //                                     makeOutOfStockSelectOption($('#wizardViewModal'), 'filter');
        //                                     $('.shopping-cart_wrapper .next-btn').addClass('d-none');
        //                                     $('.shopping-cart_wrapper .add-items-btn').removeClass('d-none');
        //                                 }
        //                             } else {
        //                                 alert("error");
        //                             }
        //                         },
        //                         error: function (error) {
        //                             filter.pop();
        //                         }
        //                     });
        //                 });
        //                 $('body').on('click', '.shopping-cart_wrapper .back-btn', function (e) {
        //                     e.preventDefault();
        //                     e.stopImmediatePropagation();
        //
        //                     filter.pop();
        //                     // console.log(filter)
        //                     $.ajax({
        //                         type: "post",
        //                         url: "/filters",
        //                         cache: false,
        //                         data: {
        //                             group: self.attr('data-group'),
        //                             category_id: first_category_id,
        //                             filters: filter,
        //                             type: 'popup'   //self.attr('data-type')
        //                         },
        //                         headers: {
        //                             "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
        //                         },
        //                         success: function (data) {
        //                             if (!data.error) {
        //
        //                                 $('.shopping-cart-head .nav-pills').empty();
        //                                 $('.shopping-cart-head .nav-pills').append(data.wizard);
        //                                 if (data.type === "filter") {
        //                                     $('.contents-wrapper .content').html(data.filters);
        //                                     $('.shopping-cart_wrapper .next-btn').removeClass('d-none');
        //                                     $('.shopping-cart_wrapper .add-items-btn').addClass('d-none');
        //                                 } else if (data.type === "items") {
        //                                     $('.contents-wrapper .content').html(data.items_html);
        //                                 }
        //                                 if (filter.length === 0) {
        //                                     $('.shopping-cart_wrapper .back-btn').addClass('d-none');
        //                                 }
        //                             } else {
        //                                 alert("error");
        //                             }
        //                         },
        //                         error: function (error) {
        //                             console.log(error);
        //                         }
        //                     });
        //                 });
        //             });
        //             $('#wizardViewModal').on('hidden.bs.modal', function (e) {
        //                 filter.length = 0;
        //                 $('.shopping-cart_wrapper .next-btn').removeClass('d-none');
        //                 $('.shopping-cart_wrapper .back-btn').addClass('d-none');
        //                 $('.shopping-cart_wrapper .add-items-btn').addClass('d-none');
        //                 $('#wizardViewModal .selected-items_filter').empty();
        //                 $('#wizardViewModal .content-wrap .wrap-item').removeClass('active');
        //             });
        //         });
        //     })();
        // };
        // filterModalSingleInit();

        function limite_message(group_id, active_item) {
            const place = $('#wizardViewModal .message_place_js');
            const limit = $(`.product__single-item-info[data-group-id="${group_id}"]`).data('limit');
            const min_limit = $(`.product__single-item-info[data-group-id="${group_id}"]`).data('min-limit');
            const count = $('#wizardAll').find('.item-content.active').length;
            let message = '';
            console.log(22222222222);
            // console.log(count, min_limit, limit)
            if(count < min_limit || count > limit) {
                $('#wizardViewModal .b_save').attr('disabled', true);
            } else {
                $('#wizardViewModal .b_save').attr('disabled', false);
            }

            if(limit !== 1) {
                if(min_limit >= 1 && count === 0) {
                    message = `You need to select items`;
                } else if (min_limit >= 1 && count < min_limit && limit !== count) {
                    message = `${min_limit - count} items left`;
                } else if(count === limit && !active_item) {
                    message = `You allowed to select ${limit} items only`;
                } else if(count >= min_limit && count <= limit) {
                    message = '';
                }
            }

            if(limit === 1 && count === 0) {
                message = 'You need to select one item';
            } else if(limit === 1 && count !== 0) {
                message = '';
            }

            // console.log(limit, min_limit, count, message,  group_id);
            place.text(message);
        }

        function activate_item(self, id, name, group_id) {
            const limit = $(`.product__single-item-info[data-group-id="${group_id}"]`).data('limit');
            if(limit !== 1) {
                if($(self).hasClass('active')) {
                    $("#wizardViewModal #myTabContent").find(`li[data-id="${id}"]`).each(function() {
                        $(this).find('.item-content').removeClass('active');
                    });
                    $('#wizardViewModal .footer-list').find(`li[data-id="${id}"]`).remove();
                } else {
                    const group_element = $(`.product__single-item-info[data-group-id="${group_id}"]`);

                    if($("#wizardViewModal #myTabContent #wizardAll").find('.item-content.active').length < group_element.data('limit')) {
                        $(self).addClass('active');
                        $("#wizardViewModal #myTabContent").find(`li[data-id="${id}"]`).each(function() {
                            $(this).find('.item-content').addClass('active');
                        });
                        $('#wizardViewModal .footer-list').find(`.footer-list-item[data-id="${id}"]`).length === 0 && $('#wizardViewModal .footer-list')
                            .append(`<li class="footer-list-item" data-id="${id}" data-name="${name}">
                                                            <span class="title">${name}</span>
                                                            <span class="close-icon item-selected-footer"><i class="fa fa-times"></i></span>
                                                        </li>`);
                    }
                }
            } else {
                // if($(self).hasClass('active')) {
                // $("#wizardViewModal #myTabContent").find(`li[data-id="${id}"]`).each(function() {
                //     $(this).find('.item-content').removeClass('active');
                // });
                // $('#wizardViewModal .footer-list').find(`li[data-id="${id}"]`).remove();
                // } else {
                $("#wizardViewModal #myTabContent").find('li').each(function() {
                    if($(this).data('id') === id) {
                        $(this).find('.item-content').addClass('active');
                    } else {
                        $(this).find('.item-content').removeClass('active');
                    }

                });

                const group_element = $(`.product__single-item-info[data-group-id="${group_id}"]`);

                if($("#wizardViewModal #myTabContent #wizardAll").find('.item-content.active').length < group_element.data('limit')) {
                    $(self).addClass('active');
                    $("#wizardViewModal #myTabContent").find(`li[data-id="${id}"]`).each(function() {
                        $(this).find('.item-content').addClass('active');
                    });
                    $('#wizardViewModal .footer-list').find(`.footer-list-item[data-id="${id}"]`).length === 0 && $('#wizardViewModal .footer-list')
                        .html(`<li class="footer-list-item" data-id="${id}" data-name="${name}">
                                                            <span class="title">${name}</span>
                                                            <span class="close-icon item-selected-footer"><i class="fa fa-times"></i></span>
                                                        </li>`);
                }
                // }
            }

        }

        const filterModalSingleInit = () => {
            (function () {
                $(`#singleProductPageCnt .filters-modal-wizard`).each(function (index) {
                    const button_group_id = $(this).attr('data-group');
                    selected_ides = [];
                    let x_group;
                    $("body").on('click', `.filters-modal-wizard[data-group="${button_group_id}"]`, function () {
                        let group_id = $(this).data('group');
                        x_group = group_id;
                        $("#wizardViewModal").attr('data-group', group_id);

                        // const selectedIds = $(this).closest('.product-single-info_row').find('.menu-item-selected').toArray().map(function (item) {
                        //     return $(item).attr('data-id');
                        // });

                        $("#wizardViewModal .modal-body").empty();
                        $("#wizardViewModal .footer-list").empty();
                        $.ajax({
                            type: "post",
                            url: "/filters/render-tabs",
                            cache: false,
                            data: {
                                group: group_id
                            },
                            headers: {
                                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                            },
                            success: function (data) {
                                $("#wizardViewModal .modal-body").html(data.html);
                                selected_ides.length = 0;
                                $(`.product__single-item-info[data-group-id="${group_id}"]`).find('.product__single-item-info-bottom').each(function(a, b) {
                                    $(this).data('id') && selected_ides.push($(this).data('id'));
                                });
                                $("#wizardViewModal ul.content li").each(function() {
                                    $(this).find(".item-content").on('click', function () {
                                        let id = $(this).closest('li').attr('data-id');
                                        let name = $(this).closest('li').attr('data-name');
                                        activate_item(this, id, name, group_id);
                                        const active_item = $(this).hasClass('active');
                                        limite_message(group_id, active_item);
                                    });
                                    // console.log(selected_ides);
                                    // console.log('lalalalaaaa', selected_ides.includes($(this).data('id')) && $($(this).find(".item-content")[0]));
                                    if(selected_ides.includes($(this).data('id'))) {
                                        let id = $(this).closest('li').attr('data-id');
                                        let name = $(this).closest('li').attr('data-name');
                                        activate_item(this, id, name, group_id);
                                        limite_message(group_id, true);
                                    }

                                });
                                limite_message(group_id, true);
                                // $(`#wizardViewModal ul.content li`).each(function() {
                                //
                                // });
                                $("#wizardViewModal").modal();
                            },
                            error: function() {
                                $("#wizardViewModal .modal-body").empty();
                                $("#wizardViewModal").modal();
                            }
                        });
                    });

                    $('body').on('click', `#wizardViewModal[data-group="${button_group_id}"] .close-icon.item-selected-footer`, function(ev) {
                        const id = $(this).closest('li').data('id');
                        const group_id = button_group_id;
                        $("#wizardViewModal #myTabContent").find(`li[data-id="${id}"]`).each(function() {
                            $(this).find('.active').removeClass('active');
                        });
                        $(this).closest('li').remove();
                        // console.log(x_group, group_id)
                        if(x_group === group_id) {
                            limite_message(x_group);
                        }
                    });



                    $('body').on('click', `#wizardViewModal[data-group="${button_group_id}"] .b_save`, function () {
                        const items_array = [];

                        $('#wizardViewModal .modal-body').find(".item-content.active").each(function () {
                            items_array.push($(this).closest('li').attr('data-id'));
                        });

                        const popup_items_qty = [];
                        // console.log($(`[data-id-popup].selected-item_popup`).find('.popup_field-input'));
                        $(`[data-id-popup].selected-item_popup`).find('.popup_field-input').each(function () {
                            const $this = $(this);
                            popup_items_qty.push({
                                id: $this.closest('.selected-item_popup').attr('data-id-popup'),
                                value: $this.val()
                            });
                        });

                        fetch("/products/get-variation-menu-raws", {
                            method: "post",
                            headers: {
                                "Content-Type": "application/json",
                                Accept: "application/json",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-Token": $('input[name="_token"]').val()
                            },
                            credentials: "same-origin",
                            body: JSON.stringify({ids: items_array})
                        })
                            .then(function (response) {
                                return response.json();
                            })
                            .then(function (json) {
                                // console.log(json);

                                const items_row = $(`[data-group-id="${button_group_id}"]`).find('.product-single-info_row-items');
                                items_row.html(json.html);

                                const selects = items_row.find('.select-2');
                                selects.length > 0 && selects.each(function() {
                                    $(this).select2({minimumResultsForSearch: -1});
                                });
                                $(`[data-group-id="${button_group_id}"]`).closest('.product__single-item-info').css('border-color', '#d7d7d7');
                                $(`[data-group-id="${button_group_id}"]`).closest('.product-single-info_row').find('.field-input').each(function () {
                                    const d_id = $(this).attr('data-id');
                                    const value = popup_items_qty.length > 0 && popup_items_qty.find((el) => {
                                        return el.id === d_id;
                                    }).value;
                                    $(this).val(value);
                                    $(this).closest('.menu-item-selected').find('.price-placee').html(getCurrencySymbol() + $(this).closest('.menu-item-selected').attr('data-price') * Number($(this).val()));
                                });
                                setTotalPrice(countTotalPrice());

                                $('#wizardViewModal').modal('hide');

                                $(`[data-group="${button_group_id}"]`).closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
                                    $(this).closest('.menu-item-selected').remove();
                                    setTotalPrice(countTotalPrice());
                                });

                                $(`[data-group="${button_group_id}"]`).closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
                                    ev.preventDefault();
                                    ev.stopImmediatePropagation();
                                    const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');

                                    handleProductCountMinus($(this), $(`[data-group="${button_group_id}"]`), 'popup', limit);
                                    setTotalPrice(countTotalPrice());

                                });

                                $(`[data-group="${button_group_id}"]`).closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
                                    ev.preventDefault();
                                    ev.stopImmediatePropagation();
                                    const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');

                                    handleProductCountPlus($(this), $(`[data-group="${button_group_id}"]`), 'popup', limit);
                                    setTotalPrice(countTotalPrice());
                                });

                                // console.log('group_id', group_id);


                            });
                    });

                    $('body').on('click', '#wizardViewModal .item-selected-footer', function() {
                        let id = $(this).closest('.footer-list-item').attr('data-id');
                        let name = $(this).closest('.footer-list-item').attr('data-name');
                        activate_item($(`#wizardViewModal .content[data-id="${id}"]`).find('.item-content'), id, name);
                        $(this).closest('.footer-list-item').remove();
                    });
                });
            })();
        };

        const filterModalOfferInit = () => {
            (function () {
                $(`#specialPopUpModal .filters-modal-wizard`).each(function (index) {
                    const button_group_id = $(this).attr('data-group');
                    selected_ides = [];
                    let x_group;

                    $("body").on('click', `.filters-modal-wizard[data-group="${button_group_id}"]`, function () {
                        let group_id = $(this).data('group');
                        x_group = group_id;
                        $("#wizardViewModal").attr('data-group', group_id);

                        // const selectedIds = $(this).closest('.product-single-info_row').find('.menu-item-selected').toArray().map(function (item) {
                        //     return $(item).attr('data-id');
                        // });

                        $("#wizardViewModal .modal-body").empty();
                        $("#wizardViewModal .footer-list").empty();
                        $.ajax({
                            type: "post",
                            url: "/filters/render-tabs",
                            cache: false,
                            data: {
                                group: group_id
                            },
                            headers: {
                                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                            },
                            success: function (data) {
                                $("#wizardViewModal .modal-body").html(data.html);
                                selected_ides.length = 0;
                                $(`.product__single-item-info[data-group-id="${button_group_id}"]`).find('.product__single-item-info-bottom').each(function(a, b) {
                                    $(this).data('id') && selected_ides.push($(this).data('id'));
                                });
                                $("#wizardViewModal ul.content li").each(function() {
                                    $(this).find(".item-content").on('click', function () {
                                        let id = $(this).closest('li').attr('data-id');
                                        let name = $(this).closest('li').attr('data-name');
                                        activate_item(this, id, name, group_id);
                                        const active_item = $(this).hasClass('active');
                                        limite_message(group_id, active_item);
                                    });
                                    // console.log(selected_ides);
                                    // console.log('lalalalaaaa', selected_ides.includes($(this).data('id')) && $($(this).find(".item-content")[0]));
                                    if(selected_ides.includes($(this).data('id'))) {
                                        let id = $(this).closest('li').attr('data-id');
                                        let name = $(this).closest('li').attr('data-name');
                                        activate_item(this, id, name, group_id);
                                        limite_message(group_id, true);
                                    }
                                });
                                limite_message(group_id, true);

                                // $(`#wizardViewModal ul.content li`).each(function() {
                                //
                                // });
                                $("#wizardViewModal").modal();
                            },
                            error: function() {
                                $("#wizardViewModal .modal-body").empty();
                                $("#wizardViewModal").modal();
                            }
                        });
                    });

                    $('body').on('click', `#wizardViewModal[data-group="${button_group_id}"] .close-icon.item-selected-footer`, function(ev) {
                        const id = $(this).closest('li').data('id');
                        const group_id = button_group_id;
                        $("#wizardViewModal #myTabContent").find(`li[data-id="${id}"]`).each(function() {
                            $(this).find('.active').removeClass('active');
                        });
                        $(this).closest('li').remove();
                        console.log(x_group, group_id)
                        if(x_group === group_id) {
                            limite_message(x_group);
                        }
                    });

                    $('body').on('click', `#wizardViewModal[data-group="${button_group_id}"] .b_save`, function () {
                        const items_array = [];

                        $('#wizardViewModal .modal-body').find(".item-content.active").each(function () {
                            items_array.push($(this).closest('li').attr('data-id'));
                        });

                        const popup_items_qty = [];
                        // console.log($(`[data-id-popup].selected-item_popup`).find('.popup_field-input'));
                        $(`[data-id-popup].selected-item_popup`).find('.popup_field-input').each(function () {
                            const $this = $(this);
                            popup_items_qty.push({
                                id: $this.closest('.selected-item_popup').attr('data-id-popup'),
                                value: $this.val()
                            });
                        });

                        fetch("/products/get-offer-menu-raws", {
                            method: "post",
                            headers: {
                                "Content-Type": "application/json",
                                Accept: "application/json",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-Token": $('input[name="_token"]').val()
                            },
                            credentials: "same-origin",
                            body: JSON.stringify({ids: items_array})
                        })
                            .then(function (response) {
                                return response.json();
                            })
                            .then(function (json) {
                                console.log(json);

                                const items_row = $(`[data-group-id="${button_group_id}"]`).find('.product-single-info_row-items');
                                items_row.html(json.html);

                                const selects = items_row.find('.select-2');
                                selects.length > 0 && selects.each(function() {
                                    $(this).select2({minimumResultsForSearch: -1});
                                });
                                $(`[data-group-id="${button_group_id}"]`).closest('.product__single-item-info').css('border-color', '#d7d7d7');
                                $(`[data-group-id="${button_group_id}"]`).closest('.product-single-info_row').find('.field-input').each(function () {
                                    const d_id = $(this).attr('data-id');
                                    const value = popup_items_qty.length > 0 && popup_items_qty.find((el) => {
                                        return el.id === d_id;
                                    }).value;
                                    $(this).val(value);
                                    $(this).closest('.menu-item-selected').find('.price-placee').html(getCurrencySymbol() + $(this).closest('.menu-item-selected').attr('data-price') * Number($(this).val()));
                                });
                                // setTotalPrice(countTotalPrice());

                                countOfferPrice();
                                countOfferTotalPrice();

                                $('#wizardViewModal').modal('hide');

                                $(`[data-group="${button_group_id}"]`).closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
                                    $(this).closest('.menu-item-selected').remove();
                                    setTotalPrice(countTotalPrice());
                                });

                                $(`[data-group="${button_group_id}"]`).closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
                                    ev.preventDefault();
                                    ev.stopImmediatePropagation();
                                    const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');

                                    handleProductCountMinus($(this), $(`[data-group="${button_group_id}"]`), 'popup', limit);
                                    setTotalPrice(countTotalPrice());

                                });

                                $(`[data-group="${button_group_id}"]`).closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
                                    ev.preventDefault();
                                    ev.stopImmediatePropagation();
                                    const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');

                                    handleProductCountPlus($(this), $(`[data-group="${button_group_id}"]`), 'popup', limit);
                                    setTotalPrice(countTotalPrice());
                                });

                                // console.log('group_id', group_id);


                            });
                    });

                    $('body').on('click', '#wizardViewModal .item-selected-footer', function() {
                        let id = $(this).closest('.footer-list-item').attr('data-id');
                        let name = $(this).closest('.footer-list-item').attr('data-name');
                        activate_item($(`#wizardViewModal .content[data-id="${id}"]`).find('.item-content'), id, name);
                        $(this).closest('.footer-list-item').remove();
                    });
                });
            })();
            // $(`#specialPopUpModal .filters-modal-wizard`).each(function (index) {
            //     const group_id = $(this).attr('data-group');
            //     const filter = [];
            //
            //     let dg = null;
            //     let filter_limit = 0;
            //
            //     $("body").on('click', `.filters-modal-wizard[data-group="${group_id}"]`, function () {
            //         dg = $(this).attr('data-group');
            //         let group = $(this).attr('data-group');
            //         filter_limit = $(this).closest('.limit').attr('data-limit');
            //         const selectedIds = $(this).closest('.product-single-info_row').find('.menu-item-selected').toArray().map(function (item) {
            //             return $(item).attr('data-id');
            //         });
            //         // console.log('index',index);
            //         $.ajax({
            //             type: "post",
            //             url: "/products/select-items",
            //             cache: false,
            //             data: {
            //                 group,
            //                 selectedIds,
            //                 type: "popup"
            //             },
            //             headers: {
            //                 "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            //             },
            //             success: function (data) {
            //                 if (!data.error) {
            //                     $("#wizardViewModal .selected-items_filter").empty();
            //                     $(`.filter[data-group-id="${group}"]`).closest('.product-single-info_row').find('.menu-item-selected').toArray().map((selectedItem) => {
            //                         const selectedItemId = $(selectedItem).attr('data-id');
            //                         const selectedItemTitle = $(selectedItem).find('.delete-menu-item').parent().text().trim();
            //                         // $("#wizardViewModal .selected-items_filter").append(makeSelectedItemModal(selectedItemId, selectedItemTitle, true));
            //                     });
            //                     $("#wizardViewModal").modal();
            //                 } else {
            //                     alert("error");
            //                 }
            //             }
            //         });
            //     });
            //
            //     $("body").on('click', `#wizardViewModal[data-group="${group_id}"] .shopping-cart_wrapper .wrap-item`, function (ev) {
            //         const id = $(this).attr('data-id');
            //         const title = $(this).find('.name').text().trim();
            //         filter_limit = $(`.filters-modal-wizard[data-group="${$(this).closest('[data-group]').attr('data-group')}"]`).closest('.limit').attr('data-limit');
            //         // filter_limit > new_qty(null, 'filter') &&
            //         if (!$(this).hasClass('active')) {
            //             $(this).addClass('active');
            //             // $('.selected-items_filter').append(makeSelectedItemModal(id, title, true));
            //         } else if ($(this).hasClass('active')) {
            //             $(`[data-id-popup="${id}"]`).remove();
            //             $(this).removeClass('active');
            //         }
            //     });
            //
            //     $('body').on('click', '#wizardViewModal .selected-item-popup_qty-minus', function (ev) {
            //         eventInitialDefault(ev);
            //         $(this).siblings(".popup_field-input").val() > 1 && $(this).siblings(".popup_field-input").val(Number($(this).siblings(".popup_field-input").val()) - 1);
            //     });
            //
            //     $('body').on('click', '#wizardViewModal .selected-item-popup_qty-plus', function (ev) {
            //         eventInitialDefault(ev);
            //         filter_limit = $(`.filters-modal-wizard[data-group="${$(this).closest('[data-group]').attr('data-group')}"]`).closest('.limit').attr('data-limit');
            //         if (filter_limit > new_qty(null, 'filter')) {
            //             $(this).siblings(".popup_field-input").val(Number($(this).siblings(".popup_field-input").val()) + 1);
            //         }
            //     });
            //
            //     $('body').on('click', '#wizardViewModal .selected-item_popup .delete-menu-item', function () {
            //         const remove_id = $(this).attr('data-el-id');
            //         $('#wizardViewModal').find(`.wrap-item[data-id="${remove_id}"]`).removeClass('active');
            //         $(this).closest('.selected-item_popup').remove();
            //     });
            //
            //
            //     $('body').on('click', `#wizardViewModal[data-group="${group_id}"] .add-items-btn`, function () {
            //         const items_array = [];
            //         // console.log(2, '*****************************')
            //
            //         $('#wizardViewModal .modal-body').find('.wrap-item').each(function () {
            //             $(this).hasClass('active') && (items_array.push($(this).attr('data-id')));
            //         });
            //
            //         const popup_items_qty = [];
            //         // console.log($(`[data-id-popup].selected-item_popup`).find('.popup_field-input'));
            //         $(`[data-id-popup].selected-item_popup`).find('.popup_field-input').each(function () {
            //             const $this = $(this);
            //             popup_items_qty.push({
            //                 id: $this.closest('.selected-item_popup').attr('data-id-popup'),
            //                 value: $this.val()
            //             });
            //         });
            //
            //         fetch("/products/get-offer-menu-raws", {
            //             method: "post",
            //             headers: {
            //                 "Content-Type": "application/json",
            //                 Accept: "application/json",
            //                 "X-Requested-With": "XMLHttpRequest",
            //                 "X-CSRF-Token": $('input[name="_token"]').val()
            //             },
            //             credentials: "same-origin",
            //             body: JSON.stringify({ids: items_array})
            //         })
            //             .then(function (response) {
            //                 return response.json();
            //             })
            //             .then(function (json) {
            //                 const items_row = $(`[data-group-id="${dg}"]`).find('.product-single-info_row-items');
            //                 items_row.append(json.html);
            //                 const selects = items_row.find('.select-2');
            //                 selects.length > 0 && selects.each(function() {
            //                     $(this).select2({minimumResultsForSearch: -1});
            //                 });
            //                 $(`[data-group-id="${dg}"]`).closest('.product__single-item-info').css('border-color', '#d7d7d7');
            //                 // $(`[data-group-id="${dg}"]`).closest('.product-single-info_row').find('.field-input').each(function () {
            //                 //     const d_id = $(this).attr('data-id');
            //                 //     const value = popup_items_qty.length > 0 && popup_items_qty.find((el) => {
            //                 //         return el.id === d_id;
            //                 //     }).value;
            //                 //     $(this).val(value);
            //                 //     $(this).closest('.menu-item-selected').find('.price-placee').html(getCurrencySymbol() + $(this).closest('.menu-item-selected').attr('data-price') * Number($(this).val()));
            //                 // });
            //                 countOfferPrice();
            //                 countOfferTotalPrice();
            //
            //                 $('#wizardViewModal').modal('hide');
            //
            //
            //
            //                 $(`[data-group="${dg}"]`).closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
            //                     $(this).closest('.menu-item-selected').remove();
            //                     setTotalPrice(countTotalPrice());
            //                 });
            //
            //                 $(`[data-group="${dg}"]`).closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
            //                     ev.preventDefault();
            //                     ev.stopImmediatePropagation();
            //                     const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
            //
            //                     handleProductCountMinus($(this), $(`[data-group="${dg}"]`), 'popup', limit);
            //                     setTotalPrice(countTotalPrice());
            //
            //                 });
            //
            //                 $(`[data-group="${dg}"]`).closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
            //                     ev.preventDefault();
            //                     ev.stopImmediatePropagation();
            //                     const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
            //
            //                     handleProductCountPlus($(this), $(`[data-group="${dg}"]`), 'popup', limit);
            //                     setTotalPrice(countTotalPrice());
            //                 });
            //             });
            //     });
            //
            //     $(this).on('click', function (e) {
            //         const first_category_id = $(this).attr('data-action');
            //         let self = $(this);
            //         let selectMoreItems = [];
            //         let selectSingleItems;
            //
            //         $body.on('click', `#wizardViewModal[data-group="${group_id}"] .shopping-cart_wrapper .item-content`, function () {
            //             $('.shopping-cart_wrapper .item-content').removeClass('active');
            //             $(this).addClass('active');
            //         });
            //
            //         $body.on('click', `#wizardViewModal[data-group="${group_id}"] .add-items-btn`, function (e) {
            //             eventInitialDefault(e);
            //             // console.log(1, '*****************************')
            //
            //             $(`.filter[data-group-id="${group_id}"]`).find('.product-single-info_row-items').empty();
            //
            //             if (Number(self.attr('data-multiple')) === 1) {
            //                 $(this).closest('.contents-wrapper').find('.wrap-item.active').each(function () {
            //                     selectMoreItems.push($(this).attr('data-id'));
            //                 });
            //                 selectMoreItems.forEach((item) => {
            //                     createInputHiddenForFilter(item, self);
            //                 });
            //             } else {
            //                 selectSingleItems = $(this).closest('.contents-wrapper').find('.wrap-item.active').attr('data-id');
            //                 createInputHiddenForFilter(selectSingleItems, self);
            //             }
            //
            //             $('#wizardViewModal').modal('hide');
            //         });
            //
            //         $.ajax({
            //             type: "post",
            //             url: "/filters",
            //             cache: false,
            //             data: {
            //                 group: self.attr('data-group'),
            //                 category_id: first_category_id,
            //                 filters: filter,
            //                 type: "popup"
            //             },
            //             headers: {
            //                 "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            //             },
            //             success: function (data) {
            //                 if (!data.error) {
            //                     const modal_group_id = self.attr('data-group');
            //                     $('#wizardViewModal').attr('data-group', modal_group_id);
            //                     const contantPlace = $('.contents-wrapper .content');
            //                     const wizardPlace = $('.shopping-cart-head .nav-pills');
            //
            //                     wizardPlace.empty();
            //                     wizardPlace.append(data.wizard);
            //                     if (data.type === "filter") {
            //                         contantPlace.html(data.filters);
            //                     } else if (data.type === "items") {
            //                         contantPlace.html(data.items_html);
            //                         makeOutOfStockSelectOption($('#wizardViewModal'), 'filter');
            //                         $('.shopping-cart_wrapper .next-btn').addClass('d-none');
            //                         $('.shopping-cart_wrapper .add-items-btn').removeClass('d-none');
            //                     }
            //                 } else {
            //                     alert("error");
            //                 }
            //             },
            //             error: function (error) {
            //                 filter.pop();
            //             }
            //         });
            //
            //         $body.on('click', `#wizardViewModal[data-group="${group_id}"] .shopping-cart_wrapper .next-btn`, function (e) {
            //             eventInitialDefault(e);
            //             $('.content-wrap').find('.active').toArray().map(function (actv) {
            //                 filter.push($(actv).closest('[data-id]').attr('data-id'));
            //             });
            //             // console.log(filter);
            //
            //             $('.content-wrap').find('.active').length === 0 ? alert('select item') : $.ajax({
            //                 type: "post",
            //                 url: "/filters",
            //                 cache: false,
            //                 data: {
            //                     group: self.attr('data-group'),
            //                     category_id: first_category_id,
            //                     filters: filter,
            //                     type: "popup"
            //                 },
            //                 headers: {
            //                     "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            //                 },
            //                 success: function (data) {
            //                     if (!data.error) {
            //                         $('.shopping-cart-head .nav-pills').empty();
            //                         $('.shopping-cart-head .nav-pills').append(data.wizard);
            //                         $('.back-btn').removeClass('d-none');
            //                         if (data.type === "filter") {
            //                             $('.contents-wrapper .content').html(data.filters);
            //                         } else if (data.type === "items") {
            //                             $('.contents-wrapper .content').html(data.items_html);
            //                             $(`#wizardViewModal[data-group="${group_id}"] .selected-item_popup`).each(function () {
            //                                 $(this).closest('#wizardViewModal').find(`.wrap-item[data-id="${$(this).attr('data-id-popup')}"]`).length > 0
            //                                 && $(this).closest('#wizardViewModal').find(`.wrap-item[data-id="${$(this).attr('data-id-popup')}"]`).addClass('active');
            //                             });
            //                             makeOutOfStockSelectOption($('#wizardViewModal'), 'filter');
            //                             $('.shopping-cart_wrapper .next-btn').addClass('d-none');
            //                             $('.shopping-cart_wrapper .add-items-btn').removeClass('d-none');
            //                         }
            //                     } else {
            //                         alert("error");
            //                     }
            //                 },
            //                 error: function (error) {
            //                     filter.pop();
            //                 }
            //             });
            //         });
            //         $('body').on('click', '.shopping-cart_wrapper .back-btn', function (e) {
            //             e.preventDefault();
            //             e.stopImmediatePropagation();
            //
            //             filter.pop();
            //             // console.log(filter)
            //             $.ajax({
            //                 type: "post",
            //                 url: "/filters",
            //                 cache: false,
            //                 data: {
            //                     group: self.attr('data-group'),
            //                     category_id: first_category_id,
            //                     filters: filter,
            //                     type: 'popup'   //self.attr('data-type')
            //                 },
            //                 headers: {
            //                     "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            //                 },
            //                 success: function (data) {
            //                     if (!data.error) {
            //
            //                         $('.shopping-cart-head .nav-pills').empty();
            //                         $('.shopping-cart-head .nav-pills').append(data.wizard);
            //                         if (data.type === "filter") {
            //                             $('.contents-wrapper .content').html(data.filters);
            //                             $('.shopping-cart_wrapper .next-btn').removeClass('d-none');
            //                             $('.shopping-cart_wrapper .add-items-btn').addClass('d-none');
            //                         } else if (data.type === "items") {
            //                             $('.contents-wrapper .content').html(data.items_html);
            //                         }
            //                         if (filter.length === 0) {
            //                             $('.shopping-cart_wrapper .back-btn').addClass('d-none');
            //                         }
            //                     } else {
            //                         alert("error");
            //                     }
            //                 },
            //                 error: function (error) {
            //                     console.log(error);
            //                 }
            //             });
            //         });
            //     });
            //     $('#wizardViewModal').on('hidden.bs.modal', function (e) {
            //         filter.length = 0;
            //         $('.shopping-cart_wrapper .next-btn').removeClass('d-none');
            //         $('.shopping-cart_wrapper .back-btn').addClass('d-none');
            //         $('.shopping-cart_wrapper .add-items-btn').addClass('d-none');
            //         $('#wizardViewModal .selected-items_filter').empty();
            //         $('#wizardViewModal .content-wrap .wrap-item').removeClass('active');
            //     });
            // });

        };

        filterModalSingleInit();

        const filterSelectSingleInit = () => {
            (function () {

                $(`#singleProductPageCnt .filters-select-wizard`).each(function () {
                    const group_id = $(this).attr('data-group');

                    $(`[data-group="${group_id}"]`).on('change', function () {
                        let self = $(this);
                        let parentRow = $(this).closest('.product__single-item-info-bottom');
                        let data = parentRow.find('form#filter-form').serialize();
                        const limit = $(this).closest('[data-limit]').attr('data-limit');

                        AjaxCall("/filters",
                            data,
                            function (res) {
                                if (!res.error) {
                                    switch (res.type) {
                                        case 'filter':
                                            parentRow.find('.filter-children-items').empty();
                                            parentRow.find('.filter-children-selects').html(res.filters);
                                            Number(parentRow.find('.limit[data-limit]').attr('data-limit')) === 1
                                            && parentRow.find('.limit[data-per-price]').attr('data-per-price') !== 'product'
                                            && parentRow.find('.filter .col-sm-2.pl-sm-3.p-0.text-sm-center').empty();
                                            break;
                                        case 'items':
                                            const isMultiple = self.closest('[data-limit]').attr('data-limit') === '1' ? false : true;
                                            parentRow.find('.filter-children-selects').html(res.filters);
                                            parentRow.find('.filter-children-items').children().length === 0 && parentRow.find('.filter-children-items').html(res.items_html);
                                            parentRow.find(".product--select-items").select2({
                                                multiple: isMultiple,
                                                placeholder: "Select Products",
                                            });
                                            makeOutOfStockSelectOption(parentRow.find(".product--select-items"), 'select');
                                            if (isMultiple) {
                                                // select2MaxLimit(parentRow.find('.product--select-items'), limit);
                                            } else {
                                                setTimeout(function () {
                                                    const selectElementId = $(parentRow.find(".product--select-items").children()[0]).val();
                                                    const id = parentRow.find(".product--select-items").val();
                                                    selectHandle(self, id, selectElementId, limit, parentRow.find(".product--select-items"));
                                                }, 0);

                                            }
                                            parentRow.find(".product--select-items").find('option[value=""]').remove();

                                            break;
                                    }
                                }
                            });
                    });

                    $(`[data-group="${group_id}"]`).on('select2:select', '.product--select-items', function (e) {
                        const id = e.params.data.id;
                        const limit = $(this).closest('[data-limit]').attr('data-limit');
                        const selectElementId = $(e.params.data.element).attr('data-select2-id');
                        // console.log(1111111111111, e.params);
                        selectHandle($(e.target), id, selectElementId, limit, $(this));
                    });

                    $(`[data-group="${group_id}"]`).on('select2:unselect', '.product--select-items', function (e) {
                        // console.log(e)

                        // const limit = $(this).closest('[data-limit]').attr('data-limit');
                        unselectHandle($(this), e.params.data.id);
                    });

                    $(`[data-group="${group_id}"]`).on('click', '.product-count-minus', function (ev) {
                        eventInitialDefault(ev);
                        const limit = $(this).closest('[data-limit]').attr('data-limit');
                        const row = $(this).closest('.product-single-info_row');
                        const select = row.find('.product--select-items');

                        handleProductCountMinus($(this), select, 'select', limit);
                        setTotalPrice(countTotalPrice());
                    });

                    $(`[data-group="${group_id}"]`).on('click', '.product-count-plus', function (ev) {
                        eventInitialDefault(ev);
                        const limit = $(this).closest('[data-limit]').attr('data-limit');
                        const row = $(this).closest('.product-single-info_row');
                        const select = row.find('.product--select-items');

                        handleProductCountPlus($(this), select, 'select', limit);
                        setTotalPrice(countTotalPrice());
                    });

                    $(`[data-group="${group_id}"]`).on('click', '.remove-single_product-item', function () {
                        // const limit = $(this).closest('[data-limit]').attr('data-limit');

                        if ($(this).closest('.filters-select-wizard').length > 0) {
                            const $this = $(this);
                            const s_id = $this.attr('data-el-id');

                            $(`.select2-selection__choice[data-select2-id="${s_id}"].select2-selection__choice__remove`).click();
                            $(this).closest('.filters-select-wizard').find(`option[data-select2-id="${s_id}"]`);
                            const deleted = $this.closest('.product__single-item-info-bottom').attr('data-id');
                            const values = $(this).closest('.filters-select-wizard').find('.product--select-items').val().filter((value) => value !== deleted);
                            // console.log('$this', $this, 's_id', s_id, 'deleted', deleted, 'values', values)
                            $(this).closest('.filters-select-wizard').find('.product--select-items').val(values).trigger('change.select2');
                            $this.closest('.menu-item-selected').remove();
                            // select2MaxLimit($(this).closest('.filters-select-wizard').find('.product--select-items'), limit);
                            setTotalPrice(countTotalPrice());
                        }
                    });
                });

            })();
        };

        filterSelectSingleInit();



        const filterSelectOfferInit = () => {
            (function () {

                $(`#specialPopUpModal .filters-select-wizard`).each(function () {
                    const group_id = $(this).attr('data-group');

                    $(`[data-group="${group_id}"]`).on('change', function () {
                        let self = $(this);
                        let parentRow = $(this).closest('.product__single-item-info-bottom');
                        let data = parentRow.find('form#filter-form').serialize();
                        const limit = $(this).closest('[data-limit]').attr('data-limit');

                        AjaxCall("/filters",
                            data,
                            function (res) {
                                if (!res.error) {
                                    switch (res.type) {
                                        case 'filter':
                                            parentRow.find('.filter-children-items').empty();
                                            parentRow.find('.filter-children-selects').html(res.filters);
                                            Number(parentRow.find('.limit[data-limit]').attr('data-limit')) === 1
                                            && parentRow.find('.limit[data-per-price]').attr('data-per-price') !== 'product'
                                            && parentRow.find('.filter .col-sm-2.pl-sm-3.p-0.text-sm-center').empty();
                                            break;
                                        case 'items':
                                            const isMultiple = self.closest('[data-limit]').attr('data-limit') === '1' ? false : true;
                                            parentRow.find('.filter-children-selects').html(res.filters);
                                            parentRow.find('.filter-children-items').children().length === 0 && parentRow.find('.filter-children-items').html(res.items_html);
                                            parentRow.find(".product--select-items").select2({
                                                multiple: isMultiple,
                                                placeholder: "Select Products",
                                            });
                                            makeOutOfStockSelectOption(parentRow.find(".product--select-items"), 'select');
                                            if (isMultiple) {
                                                // select2MaxLimit(parentRow.find('.product--select-items'), limit);
                                            } else {
                                                setTimeout(function () {
                                                    const selectElementId = $(parentRow.find(".product--select-items").children()[0]).val();
                                                    const id = parentRow.find(".product--select-items").val();
                                                    selectOfferHandle(self, id, selectElementId, limit, parentRow.find(".product--select-items"));
                                                    countOfferPrice();
                                                }, 0);

                                            }
                                            parentRow.find(".product--select-items").find('option[value=""]').remove();

                                            break;
                                    }
                                }
                            });
                    });

                    $(`[data-group="${group_id}"]`).on('select2:select', '.product--select-items', function (e) {
                        const id = e.params.data.id;
                        const limit = $(this).closest('[data-limit]').attr('data-limit');
                        const selectElementId = $(e.params.data.element).attr('data-select2-id');
                        // console.log(1111111111111, e.params);
                        selectOfferHandle($(e.target), id, selectElementId, limit, $(this));
                        countOfferPrice();
                        countOfferTotalPrice();
                    });

                    $(`[data-group="${group_id}"]`).on('select2:unselect', '.product--select-items', function (e) {
                        // console.log(e)

                        // const limit = $(this).closest('[data-limit]').attr('data-limit');
                        unselectHandle($(this), e.params.data.id);
                        countOfferPrice();
                        countOfferTotalPrice();
                    });

                    $(`[data-group="${group_id}"]`).on('click', '.product-count-minus', function (ev) {
                        eventInitialDefault(ev);
                        const limit = $(this).closest('[data-limit]').attr('data-limit');
                        const row = $(this).closest('.product-single-info_row');
                        const select = row.find('.product--select-items');

                        handleProductCountMinus($(this), select, 'select', limit);
                        countOfferPrice();
                        countOfferTotalPrice();
                    });

                    $(`[data-group="${group_id}"]`).on('click', '.product-count-plus', function (ev) {
                        eventInitialDefault(ev);
                        const limit = $(this).closest('[data-limit]').attr('data-limit');
                        const row = $(this).closest('.product-single-info_row');
                        const select = row.find('.product--select-items');

                        handleProductCountPlus($(this), select, 'select', limit);
                        countOfferPrice();
                        countOfferTotalPrice();
                    });

                    $(`[data-group="${group_id}"]`).on('click', '.remove-single_product-item', function () {
                        // const limit = $(this).closest('[data-limit]').attr('data-limit');

                        if ($(this).closest('.filters-select-wizard').length > 0) {
                            const $this = $(this);
                            const s_id = $this.attr('data-el-id');

                            $(`.select2-selection__choice[data-select2-id="${s_id}"].select2-selection__choice__remove`).click();
                            $(this).closest('.filters-select-wizard').find(`option[data-select2-id="${s_id}"]`);
                            const deleted = $this.closest('.product__single-item-info-bottom').attr('data-id');
                            const values = $(this).closest('.filters-select-wizard').find('.product--select-items').val().filter((value) => value !== deleted);
                            // console.log('$this', $this, 's_id', s_id, 'deleted', deleted, 'values', values)
                            $(this).closest('.filters-select-wizard').find('.product--select-items').val(values).trigger('change.select2');
                            $this.closest('.menu-item-selected').remove();
                            // select2MaxLimit($(this).closest('.filters-select-wizard').find('.product--select-items'), limit);
                            countOfferPrice();
                            countOfferTotalPrice();
                        }
                    });
                });

            })();
        };

        $('body').on('click', '#specialPopUpModal .bottom-btn-cart', function() {

            const activeProducts = $('body').find(' .special__popup-main-product-item.active');
            const products = [];
            //Edo
            if(location.pathname === "/my-cart") {
                if(activeProducts.length > 0) {
                    activeProducts.each(function() {
                        const product_id = $(this).data('id');
                        const product_qty = 1;
                        const variations = [];

                        const pr_items = $(this).find('.pr-wrap');

                        pr_items.each(function() {
                            const group_id = $(this).data('group-id');
                            const products = [];
                            $(this).find('.product__single-item-info-bottom').each(function() {

                                // console.log('.product__single-item-info-bottom', this);
                                let id;
                                let qty;
                                let discount_id;
                                if($(this).closest('.filter').length > 0 && $(this).hasClass('get-single-price')) {
                                    id = $(this).data('id');
                                    if($(this).find('.input-qty').length>0) {
                                        qty = $(this).find('.input-qty').val();
                                        discount_id = null;
                                    } else if($(this).find('.select-qty').length>0) {
                                        qty = null;
                                        discount_id = $(this).find('.select-qty').val();
                                    } else {
                                        qty = '1';
                                        discount_id = null;
                                    }
                                } else if($(this).find('.single-product-select').length > 0 && $(this).closest('.filter').length === 0) {
                                    id = $(this).find('.single-product-select').val();
                                    if($(this).find('.input-qty').length>0) {
                                        qty = $(this).find('.input-qty').val();
                                        discount_id = null;
                                    } else if($(this).find('.select-qty').length>0) {
                                        qty = null;
                                        discount_id = $(this).find('.select-qty').val();
                                    } else {
                                        qty = '1';
                                        discount_id = null;
                                    }
                                } else if($(this).find('.custom-control-input').length > 0) {
                                    id = $(this).find('.custom-control-input:checked').val();
                                    // console.log('id', id, $(this), $(this).find('.custom-control-input:checked'),  555555555);
                                    if($(this).find('.input-qty').length>0) {
                                        qty = $(this).find('.input-qty').val();
                                        discount_id = null;
                                    } else if($(this).find('.select-qty').length>0) {
                                        qty = null;
                                        discount_id = $(this).find('.select-qty').val();
                                    } else {
                                        qty = '1';
                                        discount_id = null;
                                    }
                                } else if($(this).closest('.pr-wrap').find('.popup-select').length > 0) {
                                    id = $(this).data('id');

                                    if($(this).find('.input-qty').length>0) {
                                        qty = $(this).find('.input-qty').val();
                                        discount_id = null;
                                    } else if($(this).find('.select-qty').length>0) {
                                        qty = null;
                                        discount_id = $(this).find('.select-qty').val();
                                    } else {
                                        qty = '1';
                                        discount_id = null;
                                    }
                                } else if($(this).closest('.filter').length > 0 && $(this).hasClass('.get-single-price')) {
                                    id = $(this).data('id');

                                    if($(this).find('.input-qty').length>0) {
                                        qty = $(this).find('.input-qty').val();
                                        discount_id = null;
                                    } else if($(this).find('.select-qty').length>0) {
                                        qty = null;
                                        discount_id = $(this).find('.select-qty').val();
                                    } else {
                                        qty = '1';
                                        discount_id = null;
                                    }
                                }
                                products.push({
                                    id,
                                    qty,
                                    discount_id
                                });
                            });



                            variations.push({
                                group_id,
                                products: products.filter(function(el) {
                                    return el.id !== undefined;
                                })
                            });


                        });
                        products.push({product_id,product_qty, variations});
                        // console.log(products);
                    });


                    fetch("/add-extra-to-cart", {
                        method: "post",
                        headers: {
                            "Content-Type": "application/json",
                            Accept: "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-Token": $('input[name="_token"]').val()
                        },
                        credentials: "same-origin",
                        body: JSON.stringify({
                            key: $('.special__popup-content').data('key'),
                            product_id: $('.special__popup-content').data('product-id'),
                            variations: products
                        })
                    }).then(function (response) {
                        return response.json();
                    })
                        .then(function (data) {
                            // $self.closest('.special__popup-main-product-item').addClass('active');
                            // console.log($self.closest('.special__popup-main-product-item'));
                            // btnAddToRemove($self);
                            // $('.special__popup-content-right-item.added-offers').append(data.html);
                            $(".cart-area").html(data.html);
                            // addOfferEvent();
                            $("#specialPopUpModal").modal('hide');

                            // $('#headerShopCartBtn').click();
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {

                }
            } else {

                if(activeProducts.length > 0) {
                    activeProducts.each(function() {
                        const product_id = $(this).data('id');
                        const product_qty = 1;
                        const variations = [];

                        const pr_items = $(this).find('.pr-wrap');

                        pr_items.each(function() {
                            const group_id = $(this).data('group-id');
                            const products = [];
                            $(this).find('.product__single-item-info-bottom').each(function() {
                                // console.log('.product__single-item-info-bottom', this)
                                let id;
                                let qty;
                                let discount_id;

                                if($(this).closest('.filter').length > 0 && $(this).hasClass('get-single-price')) {
                                    // console.log(1111111111)
                                    id = $(this).data('id');
                                    if($(this).find('.input-qty').length>0) {
                                        qty = $(this).find('.input-qty').val();
                                        discount_id = null;
                                    } else if($(this).find('.select-qty').length>0) {
                                        qty = null;
                                        discount_id = $(this).find('.select-qty').val();
                                    } else {
                                        qty = '1';
                                        discount_id = null;
                                    }
                                } if($(this).find('.single-product-select').length > 0 && $(this).closest('.filter').length == 0) {
                                    // console.log(222222222)

                                    id = $(this).find('.single-product-select').val();
                                    if($(this).find('.input-qty').length>0) {
                                        qty = $(this).find('.input-qty').val();
                                        discount_id = null;
                                    } else if($(this).find('.select-qty').length>0) {
                                        qty = null;
                                        discount_id = $(this).find('.select-qty').val();
                                    } else {
                                        qty = '1';
                                        discount_id = null;
                                    }
                                } else if($(this).find('.custom-control-input').length > 0) {
                                    // console.log(333333333333)

                                    id = $(this).find('.custom-control-input:checked').val();
                                    // console.log('id', id, $(this), $(this).find('.custom-control-input:checked'),  555555555);
                                    if($(this).find('.input-qty').length>0) {
                                        qty = $(this).find('.input-qty').val();
                                        discount_id = null;
                                    } else if($(this).find('.select-qty').length>0) {
                                        qty = null;
                                        discount_id = $(this).find('.select-qty').val();
                                    } else {
                                        qty = '1';
                                        discount_id = null;
                                    }
                                } else if($(this).closest('.pr-wrap').find('.popup-select').length > 0) {

                                    id = $(this).data('id');

                                    if($(this).find('.input-qty').length>0) {
                                        qty = $(this).find('.input-qty').val();
                                        discount_id = null;
                                    } else if($(this).find('.select-qty').length>0) {
                                        qty = null;
                                        discount_id = $(this).find('.select-qty').val();
                                    } else {
                                        qty = '1';
                                        discount_id = null;
                                    }
                                }
                                products.push({
                                    id,
                                    qty,
                                    discount_id
                                });
                            });



                            variations.push({
                                group_id,
                                products: products.filter(function(el) {
                                    return el.id !== undefined;
                                })
                            });


                        });
                        products.push({product_id,product_qty, variations});
                        // console.log(products);
                    });


                    fetch("/add-extra-to-cart", {
                        method: "post",
                        headers: {
                            "Content-Type": "application/json",
                            Accept: "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-Token": $('input[name="_token"]').val()
                        },
                        credentials: "same-origin",
                        body: JSON.stringify({
                            key: $('.special__popup-content').data('key'),
                            product_id: $('.special__popup-content').data('product-id'),
                            variations: products
                        })
                    }).then(function (response) {
                        return response.json();
                    })
                        .then(function (data) {
                            // $self.closest('.special__popup-main-product-item').addClass('active');
                            // console.log($self.closest('.special__popup-main-product-item'));
                            // btnAddToRemove($self);
                            // $('.special__popup-content-right-item.added-offers').append(data.html);
                            $("#specialPopUpModal").modal('hide');
                            $("#headerShopCartBtn").click();
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {

                }
            }



        });







        $('body').on('change', '[data-discount-type] input, [data-discount-type] select', function(ev) {
            const discount_type = $(ev.target).closest('[data-discount-type]').attr('data-discount-type');
            discountInputChange($(ev), $(ev.target), discount_type);
        });

        setTotalPrice();

        let initCount = 0,
            initPopupCount = 0,
            initFilterModalCount = 0;



                        let dg_popup;

                        $("body").on('click', `.popup-select`, function() {
                            const $this = $(this);
                            const selected_ids = [];
                            $this.closest('.limit.pr-wrap').length > 0 && setTimeout(function() {
                                $this.closest('.limit.pr-wrap').css('border', 'none');
                            }, 1000)
                            if($(this).closest('#singleProductPageCnt').length > 0) {
                                $('#popUpModal').attr('product-or-offer', 'product');
                            } else if($(this).closest('#specialPopUpModal').length > 0) {
                                $('#popUpModal').attr('product-or-offer', 'offer');
                            }

                            dg_popup = $this.data('group');
                            $this.closest('.product__single-item-info').find('.product__single-item-info-bottom').length > 0 && $this.closest('.product__single-item-info').find('.product__single-item-info-bottom').each(function() {
                                selected_ids.push($(this).data('id'));
                            });
                            // console.log('selected_ids', selected_ids)
                            $.ajax({
                                type: "post",
                                url: "/products/select-items",
                                cache: false,
                                data: {
                                    group: dg_popup,
                                    ids: selected_ids
                                },
                                headers: {
                                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                                },
                                success: function (data) {
                                    if (!data.error) {
                                        $("#popUpModal .modal-content").html(data.html);
                                        // $('#popUpModal .title_popup').text(`You can add ${limit} product`);
                                        // makeSelectedItem(data_group_id);
                                        $("#popUpModal").attr('data-group', dg_popup);
                                        makeOutOfStockSelectOption($("#popUpModal .modal-content"), 'popup');
                                        $("#popUpModal").attr('limit', $this.closest('.product__single-item-info.limit').data('limit') || $this.closest('.pr-wrap.limit').data('limit'));
                                        $("#popUpModal").modal();
                                    } else {
                                        console.log(data.error);
                                    }
                                }
                            });
                        });
//[data-group="${dg_popup}"]
                        $("body").on('click', `#popUpModal .single-item-wrapper .single-item`, function (ev) {
                            console.log(181818, '-------')
                            const offer = $(this).closest('#popUpModal').attr('product-or-offer') === 'offer';
                            const id = $(this).closest(".single-item-wrapper").attr('data-id');
                            const title = $(this).find('.name-item').text().trim();
                            const selectedCount = $(this).closest('.modal-body').find('.single-item-wrapper.active').length;
                            const limit = $(this).closest('#popUpModal').attr('limit')*1;
                            const group = $(this).closest('#popUpModal').attr('data-group');
                            const selectedItemsCountInPage = $('#singleProductPageCnt').find(`[data-group-id="${group}"]`).find('.product__single-item-info-bottom').length || $('#specialPopUpModal').find(`[data-group-id="${group}"]`).find('.product__single-item-info-bottom').length;
                            console.log({
                                id,
                                title,
                                selectedCount,
                                limit,
                                group,
                                offer,
                                selectedItemsCountInPage
                            });
                            if (!$(this).closest(".single-item-wrapper").hasClass('active') && selectedCount + 1 + selectedItemsCountInPage <= limit) {
                                $(this).closest(".single-item-wrapper").addClass('active');
                                // $(this).closest('.modal').find('.selected-items_popup')
                                //     .append(makeSelectedItemModal(id, title));
                            } else if ($(this).closest(".single-item-wrapper").hasClass('active')) {
                                // $(`[data-id-popup="${id}"]`).remove();
                                $(this).closest(".single-item-wrapper").removeClass('active');
                            }
                        });

                        $("body").on('click', `#popUpModal .modal-footer .b_save`, function () {
                            const items_value_array = [];
                            const items_array = [];
                            $('#popUpModal').find('.single-item-wrapper.active').each(function () {
                                items_value_array.push({
                                    id: $(this).data('id'),
                                    value: 1
                                        // $(this).find('.selected-item-popup_qty-select').val()
                                });
                                items_array.push($(this).data('id'));
                            });

                            if($(this).closest('#popUpModal').attr('product-or-offer') === 'product') {
                                fetch("/products/get-variation-menu-raws", {
                                    method: "post",
                                    headers: {
                                        "Content-Type": "application/json",
                                        Accept: "application/json",
                                        "X-Requested-With": "XMLHttpRequest",
                                        "X-CSRF-Token": $('input[name="_token"]').val()
                                    },
                                    credentials: "same-origin",
                                    body: JSON.stringify({
                                        ids: items_array,
                                        items: items_value_array
                                    })
                                })
                                    .then(function (response) {
                                        return response.json();
                                    })
                                    .then(function (json) {
                                        const selected_product_wrapper = $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').find('.product-single-info_row-items');

                                        $(`.product__single-item-info[data-group-id="${dg_popup}"]`).append(json.html);
                                        $(`.product__single-item-info[data-group-id="${dg_popup}"]`).find('.select-2').each(function() {
                                            $(this).select2({minimumResultsForSearch: -1});
                                        });
                                        selected_product_wrapper.empty();
                                        selected_product_wrapper.append(json.html);

                                        json.items.map((item) => {
                                            const item_price = Number(selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).attr('data-price'));
                                            selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).find('.product-qty').val(Number(item.value));
                                            selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).find('.price-placee').html(`${getCurrencySymbol()}${item_price * Number(item.value)}`);
                                        });
                                        $(`.product__single-item-info[data-group-id="${dg_popup}"]`).closest('.product__single-item-info').css('border-color', '#d7d7d7');
                                        // setTotalPrice(modal);
                                        setTotalPrice(countTotalPrice());
                                        $('#popUpModal').modal('hide');

                                        $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
                                            $(this).closest('.menu-item-selected').remove();
                                            setTotalPrice(countTotalPrice());
                                        });

                                        // $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
                                        //     eventInitialDefault(ev);
                                        //     // const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
                                        //
                                        //     // handleProductCountMinus($(this), $(`[data-group="${data_group_id}"]`), 'popup', limit);
                                        //     // setTotalPrice(modal);
                                        // });
                                        //
                                        // $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
                                        //     eventInitialDefault(ev);
                                        //     // const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
                                        //
                                        //     // handleProductCountPlus($(this), $(`[data-group="${dg_popup}"]`), 'popup', limit);
                                        //     // setTotalPrice(modal);
                                        // });
                                    });
                            } else if($(this).closest('#popUpModal').attr('product-or-offer') === 'offer') {
                                fetch("/products/get-offer-menu-raws", {
                                    method: "post",
                                    headers: {
                                        "Content-Type": "application/json",
                                        Accept: "application/json",
                                        "X-Requested-With": "XMLHttpRequest",
                                        "X-CSRF-Token": $('input[name="_token"]').val()
                                    },
                                    credentials: "same-origin",
                                    body: JSON.stringify({
                                        ids: items_array,
                                        items: items_value_array
                                    })
                                })
                                    .then(function (response) {
                                        return response.json();
                                    })
                                    .then(function (json) {
                                        const selected_product_wrapper = $(`.pr-wrap[data-group-id="${dg_popup}"]`);
                                        // console.log(111111111111111111, selected_product_wrapper, dg_popup)
                                        selected_product_wrapper.append(json.html);


                                        // $(`.product__single-item-info[data-group-id="${dg_popup}"]`).append(json.html);
                                        $(`.pr-wrap[data-group-id="${dg_popup}"]`).find('.select-2').each(function() {
                                            $(this).select2({minimumResultsForSearch: -1});
                                        });

                                            // $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price', data.price)
                                            countOfferPrice();

                                        // selected_product_wrapper.find('.product__single-item-info-bottom').remove();
                                        //
                                        //
                                        // json.items.map((item) => {
                                        //     const item_price = Number(selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).attr('data-price'));
                                        //     selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).find('.product-qty').val(Number(item.value));
                                        //     selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).find('.price-placee').html(`${getCurrencySymbol()}${item_price * Number(item.value)}`);
                                        // });

                                        // setTotalPrice(modal);
                                        // setTotalPrice(countTotalPrice());
                                        $('#popUpModal').modal('hide');

                                        $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
                                            $(this).closest('.menu-item-selected').remove();
                                            setTotalPrice(countTotalPrice());
                                        });

                                        // $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
                                        //     eventInitialDefault(ev);
                                        //     // const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
                                        //
                                        //     // handleProductCountMinus($(this), $(`[data-group="${data_group_id}"]`), 'popup', limit);
                                        //     // setTotalPrice(modal);
                                        // });
                                        //
                                        // $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
                                        //     eventInitialDefault(ev);
                                        //     // const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
                                        //
                                        //     // handleProductCountPlus($(this), $(`[data-group="${dg_popup}"]`), 'popup', limit);
                                        //     // setTotalPrice(modal);
                                        // });
                                    });
                            }


                        });


        $("body").on('click', ".select-extra", function () {
            $("#extraModal").find(".select-extra").removeClass("active");
            $(this).addClass("active");
            AjaxCall("/products/get-extra-item", {
                id: $(this).attr('data-id'),
                group: $(this).attr('data-group')
            }, function (res) {
                if (!res.error) {
                    $("#extraModal").find(".extra-main-content").html(res.html);
                    const selectedExtra = selectedGroupId.find(({group}) => {
                        return group === $(`#extraModal [data-group-id]`).attr('data-group-id');
                    });

                    if (selectedExtra) {
                        $(`#extraModal [data-group-id]`).closest('.product-single-info_row ').addClass('pointer-events-none');
                        $('#extraModal .product-card_btn').removeClass('d-inline-flex').addClass('d-none');
                        $('#extraModal .product-card_edit').removeClass('d-none').addClass('d-inline-flex');
                        $("#extraModal").find(".extra-main-content").html(selectedExtra.view);
                        productsInit(true, res.type);
                    } else {
                        $('#extraModal .product-card_btn').removeClass('d-none').addClass('d-inline-flex');
                        $('#extraModal .product-card_edit').removeClass('d-inline-flex').addClass('d-none');
                        productsInit(true, res.type);
                    }
                }
            });
        });



        $('#extraModal').on('hidden.bs.modal', function () {
            $(this).find('.extra-main-content').empty();
            $("#extraModal .modal-price-place-summary").html(getCurrencySymbol() + '0');
            !isCartPage() && $('#headerShopCartBtn').click();
            selectedGroupId.length = 0;
        });
        // productsInit();

        $("body").on('click', '.bottom-btn-cart.no-btn', function() {
            $("#specialPopUpModal").modal('hide');
            setTimeout(function() {
                $("#headerShopCartBtn").click();
            }, 0);

        });

        $("body").on('click', '.btn-add-to-cart', function (e) {
            e.stopImmediatePropagation();
            e.preventDefault();
            const product_id = $('#singleProductPageCnt #vpid').val();
            const product_qty = $('.continue-shp-wrapp_qty .field-input.product-qty-select').val();
            const variations = [];
            const bad = [];
            const product__single_items = $('.product__single-item-info');

            product__single_items.each(function() {
                const group_id = $(this).data('group-id');
                let products = [];
                $(this).find('.product__single-item-info-bottom').each(function() {
                    let id;
                    let qty;
                    let discount_id;
                    if($(this).closest('.filter').length > 0) {
                        id = $(this).data('id');
                        if($(this).find('.input-qty').length>0) {
                            qty = $(this).find('.input-qty').val();
                            discount_id = null;
                        } else if($(this).find('.select-qty').length>0) {
                            qty = null;
                            discount_id = $(this).find('.select-qty').val();
                        } else {
                            qty = '1';
                            discount_id = null;
                        }
                    } else {
                        if($(this).find('.single-product-select').length > 0) {
                            id = $(this).find('.single-product-select').val();
                            if($(this).find('.input-qty').length>0) {
                                qty = $(this).find('.input-qty').val();
                                discount_id = null;
                            } else if($(this).find('.select-qty').length>0) {
                                qty = null;
                                discount_id = $(this).find('.select-qty').val();
                            } else {
                                qty = '1';
                                discount_id = null;
                            }
                        } else if($(this).find('.custom-control-input').length > 0) {
                            id = $(this).find('.custom-control-input:checked').val();

                            if($(this).find('.input-qty').length>0) {
                                qty = $(this).find('.input-qty').val();
                                discount_id = null;
                            } else if($(this).find('.select-qty').length>0) {
                                qty = null;
                                discount_id = $(this).find('.select-qty').val();
                            } else {
                                qty = '1';
                                discount_id = null;
                            }
                        } else if($(this).closest('.product__single-item-info').find('.popup-select').length > 0) {
                            id = $(this).data('id');

                            if($(this).find('.input-qty').length>0) {
                                qty = $(this).find('.input-qty').val();
                                discount_id = null;
                            } else if($(this).find('.select-qty').length>0) {
                                qty = null;
                                discount_id = $(this).find('.select-qty').val();
                            } else {
                                qty = '1';
                                discount_id = null;
                            }
                        }
                    }

                    id === 'no' ? (products = 'no') : products.push({
                        id,
                        qty,
                        discount_id
                    });
                });

                variations.push({
                    group_id,
                    products: products !== 'no' ? products.filter(function(el) {
                        return el.id !== undefined;
                    }) : 'no'
                });


            });
            // console.log({product_id,product_qty, variations});
            variations.map((gr) => {
                const minLimit = $('#singleProductPageCnt').find(`[data-group-id="${gr.group_id}"]`).attr('data-min-limit')*1;
                const maxLimit = $('#singleProductPageCnt').find(`[data-group-id="${gr.group_id}"]`).attr('data-limit')*1;
                console.log(gr.group_id, minLimit)
                gr.products.length < minLimit && minLimit !== 0 && bad.push(gr.group_id);
            });
            // console.log(variations);
            if(bad.length !== 0) {
                bad.map(function(group_id) {
                    $(`.product__single-item-info[data-group-id="${group_id}"]`).css('border-color', 'red');
                });
                return false;
            } else {
                $.ajax({
                    type: "post",
                    url: "/add-to-cart",
                    cache: false,
                    datatype: "json",
                    data: {product_id, product_qty, variations},
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function (data) {
                        if (!data.error) {

                            if(data.message === 'added') {
                                $('#cartSidebar').html(data.headerHtml);
                                $('.add-cart-number.cart-count').html(data.count);
                                console.log('data.show_popup', data.show_popup)
                                if(data.show_popup) {
                                    $('#specialPopUpModal .modal-body').html(data.specialHtml);
                                    $('.special__popup-main-product-item .select-2').each(function() {
                                        $(this).select2({minimumResultsForSearch: -1});
                                    });
                                    filterModalOfferInit();
                                    filterSelectOfferInit();
                                    countOfferPrice();
                                    $("#specialPopUpModal").modal('show');
                                } else {
                                    $('#headerShopCartBtn').trigger('click');
                                }
                            }

                            // $(".cart-count").html(data.count);
                            // $('#cartSidebar').html(data.headerHtml);
                            // addDataKey.key = data.key;
                            // addDataKey.product_id = data.product_id;
                            // AjaxCall("/products/get-extra-content", {id: $("#vpid").val()}, function (res) {
                            //     if (!res.error) {
                            //         $("#extraModal .modal-body").html(res.html);
                            //         productsInit();
                            //         $("#extraModal").modal();
                            //     }
                            // });
                            //
                            // $('#extraModal .extra-content-left .select-extra.item.active').click();
                        } else {
                            //test
                            // alert(data.message);
                        }
                    }
                });
            }
        });

        $('#specialPopUpModal').on('hidden.bs.modal', function (e) {
            // $('#cartSidebar').empty();
            // $('.add-cart-number.cart-count').empty();
            $('#specialPopUpModal .modal-body').empty();
        });

        $("body").on("click", ".extra-sections", function () {
            let id = $(this).attr('data-product-id');
            let key = $(this).attr('data-key');
            AjaxCall("/products/get-extra-content", {id: id}, function (res) {
                if (!res.error) {
                    $("#extraModal .modal-body").html(res.html);
                    productsInit();
                    addDataKey.product_id = id;
                    addDataKey.key = key;
                    $("#extraModal").modal();
                    $('#extraModal .extra-content-left .select-extra.item.active').click();
                }
            });
        });

        $('.shopping-cart-inner').find('.product-qty-select').addClass('none-touchable');

        // $("body").on('click', '.qty-count', function (ev) {
        //     const inCartList = typeof ev.originalEvent.path.find((path) => {
        //         return $(path).hasClass('shopping-cart-inner');
        //     }) !== "undefined";
        //     if (inCartList) {
        //         return;
        //     } else {
        //         let qty = $('.product-qty-select').val();
        //         let type = $(this).data('type');
        //         if (type == 'plus') {
        //             qty = parseInt(qty) + 1;
        //             $('.product-qty-select').val(qty);
        //             setTotalPrice();
        //         } else {
        //             if (qty > 1) {
        //                 qty -= 1;
        //                 $('.product-qty-select').val(qty);
        //                 setTotalPrice();
        //             }
        //         }
        //     }
        // });


        // function addOfferEvent() {
        //     $("body").find().each(function() {

                // const items = [];
                // $(this).closest('.footer').find('.remove-extra-from-cart').each(function() {
                //     items.push($(this).data('uid'));
                // });
                $("body").on('click', '.add-offers-btn', function(ev) {
                    const item_id = $(this).data('uid');
                    eventInitialDefault(ev);

                    $.ajax({
                        type: "post",
                        url: "/my-cart-special-offer",
                        cache: false,
                        datatype: "json",
                        data: {item_id},
                        headers: {
                            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        },
                        success: function (data) {
                            if (!data.error) {
                                // console.log(data.html)
                                $('#specialPopUpModal .modal-body').html(data.html);

                                $('#specialPopUpModal .modal-body').find('.select-2').select2({minimumResultsForSearch: -1});
                                $('.special__popup-content-right-product').each(function() {
                                    if($(`.special__popup-main-product-item[data-id="${$(this).data('id')}"]`).length > 0) {
                                        $(`.special__popup-main-product-item[data-id="${$(this).data('id')}"]`).addClass('user-non-select');
                                    }
                                });
                                $('.user-non-select').find('.special__popup-main-product-item-btn').removeClass('add-btn').addClass('remove-btn').html('remove');
                                filterModalOfferInit();
                                filterSelectOfferInit();
                                countOfferPrice();
                                countOfferTotalPrice();
                                $('#specialPopUpModal .product__single-item_price').each(function() {
                                    $(this).closest('.special__popup-main-product-item-price').length === 0 && $(this).css('display', 'none')
                                });
                                $("#specialPopUpModal").modal();
                                // if(data.message === 'added') {
                                //     $('#cartSidebar').html(data.headerHtml);
                                //     $('.add-cart-number.cart-count').html(data.count);
                                //     $('#specialPopUpModal .modal-body').html(data.specialHtml);
                                //     $('.special__popup-main-product-item .select-2').each(function() {
                                //         $(this).select2();
                                //     });
                                //     filterModalOfferInit();
                                //     filterSelectOfferInit();
                                //     countOfferPrice();
                                //     $("#specialPopUpModal").modal();
                                // }

                                // $(".cart-count").html(data.count);
                                // $('#cartSidebar').html(data.headerHtml);
                                // addDataKey.key = data.key;
                                // addDataKey.product_id = data.product_id;
                                // AjaxCall("/products/get-extra-content", {id: $("#vpid").val()}, function (res) {
                                //     if (!res.error) {
                                //         $("#extraModal .modal-body").html(res.html);
                                //         productsInit();
                                //         $("#extraModal").modal();
                                //     }
                                // });
                                //
                                // $('#extraModal .extra-content-left .select-extra.item.active').click();
                            } else {
                                //test
                                // alert(data.message);
                            }
                        }
                    });
                });
            // });
        // };

        // addOfferEvent();
        //------------------------------------------------------------------------------------------------------------------------
    });
});


// my account select start
$('#accounts--selects').on('select2:select', function (e) {
    var locUrl = e.params.data.id;
    window.location.replace(locUrl);
});
// my account select end

// header search for mobile
$('body').on('click', '.search-icon-mobile .icon', function () {
    $(this).closest('.header-bottom').find('.cat-search').toggleClass('closed');
});


$('.nav-item.nav-item--has-dropdown').hover(
    function () {
        let darkBg = $(this).closest('body').find('.dark-bg_body');
        if ($('body').hasClass('show-filter')) {
            $('body').removeClass('show-filter');
        } else {
            darkBg.addClass('show');
        }

    }, function () {
        let darkBg = $(this).closest('body').find('.dark-bg_body');
        if (!$('.top-filters .nav-item--has-dropdown_dropdown').hasClass('open')) {
            darkBg.removeClass('show');
        } else {
            $('body').addClass('show-filter');
        }
    }
);
// filter show
$('body').on('click', '.top-filters .arrow-wrap .arrow-filters', function () {
    let darkBg = $(this).closest('body').find('.dark-bg_body');
    if (darkBg.hasClass('show')) {
        darkBg.removeClass('show');
    } else {
        darkBg.addClass('show');
    }
    $(this).find('.arrow').toggleClass('opened');
    $(this).closest('.top-filters').find('.main-filters').toggleClass('closed-mobile');
    $(this).closest('.arrow-wrap').find('.nav-item--has-dropdown_dropdown').toggleClass('open');

    $(this).closest('body').toggleClass('show-filter');
});

// range
// $('.range-steps_item.active').nextAll($('.range-steps_item')).addClass('line-none');


// cards change display
$('body').on('click', '.display-icon', function (e) {
    e.preventDefault();
    $('.display-icon').removeClass('active');
    $(this).addClass('active');
    if ($(this).attr('id') === 'dispGrid') {
        localStorage.setItem('display-grid', "grid");
        $('.change-display-wrap').addClass('display-grid');
    } else {
        localStorage.setItem('display-grid', "list");
        $('.change-display-wrap').removeClass('display-grid');
    }
});

localStorage.getItem('display-grid') == "list" && $('#displVertBtn').click();


// scroll top button
$('body').on('click', '#scrollTopBtn', function () {
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
openSidebar($('#ptofileBtn'), $('#profileSidebar'), []);
openSidebar($('#headerShopCartBtn'), $('#cartSidebar'));
openSidebar($('.share-button.facebook-share-button'), $('#share_modal'));

// my account select make fixed when scrolled
$(window).scroll(function () {
    var wScroll = $(this).scrollTop();


    if (wScroll > 0) {
        $('.my-account--selects').addClass('pos-fixed');
    } else {
        $('.my-account--selects').removeClass('pos-fixed');
    }
});

function checkSidebar() {
    let active = 0;
    $('.hidden-sidebar').each(function() {
        if($(this).hasClass('show')) {
            active = 1;
        }
    });
    if(!!active) {
        $('.dark-bg_body').addClass('show');
        $('body').addClass('body-over-hidden');
    } else {
        $('.dark-bg_body').removeClass('show');
        $('body').removeClass('body-over-hidden');
    }
};

function openSidebar(btn, sidebar) {
    btn.on('click', function (e) {
        e.stopPropagation();
        $('.sidebar_button_active_detector').each(function() {
            // console.log($(this), btn);
            $(this)[0] != btn[0] && $(this).removeClass('active');
        });
        $('.hidden-sidebar').each(function() {
            $(this)[0] != sidebar[0] && $(this).removeClass('show');
        });

        $(this).toggleClass('active');
        sidebar.toggleClass('show');
        checkSidebar();
    });

    $('body').on('click', function (e) {
        if (btn.hasClass('active')) {
            btn.removeClass('active');
        }
        if (!$(e.target).closest(sidebar).length) {
            sidebar.removeClass('show');
        }

        if ($(e.target).hasClass('share_modal_close')) {
            sidebar.removeClass('show');
        }
        checkSidebar();
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
            var resetHeaderPaddingTop = headerPaddingTop + 'px';
            $('.main-header').css('padding-top', resetHeaderPaddingTop);
            $('.main-header .header-top').css('top', 0);

            $('.my-account--selects').css('top', headerHeight);

        });


    }
}

function heightBlock(mainDiv, element) {
    let countElement = 0;
    $(element).each(function () {
        countElement += $(this).outerHeight();
    });
    if ($(mainDiv).outerHeight() < countElement) {
        $(mainDiv).css('display', 'block');
    } else {
        $(mainDiv).css('display', 'flex');
    }
}

// console.log(1111111111111111111);
$('body').on('click', function(ev) {
    // console.log(2, $(ev.target));
    if($(ev.target).closest('.navbar-toggler').length === 0) {
        if($('.navbar-collapse').hasClass('show') && !($(ev.target).hasClass('navbar-nav') || $(ev.target).closest('.navbar-nav').length > 0)) {
            $('.navbar-collapse').removeClass('show');
            // console.log(1);
        }
    }
});
// $("body").on('click', `#popUpModal .modal-footer .b_save`, function () {
//     const items_value_array = [];
//     const items_array = [];
//     $('#popUpModal').find('.single-item-wrapper.active').each(function () {
//         items_value_array.push({
//             id: $(this).data('id'),
//             value: 1
//             // $(this).find('.selected-item-popup_qty-select').val()
//         });
//         items_array.push($(this).data('id'));
//     });
//     fetch("/products/get-variation-menu-raws", {
//         method: "post",
//         headers: {
//             "Content-Type": "application/json",
//             Accept: "application/json",
//             "X-Requested-With": "XMLHttpRequest",
//             "X-CSRF-Token": $('input[name="_token"]').val()
//         },
//         credentials: "same-origin",
//         body: JSON.stringify({
//             ids: items_array,
//             items: items_value_array
//         })
//     })
//         .then(function (response) {
//             return response.json();
//         })
//         .then(function (json) {
//             const selected_product_wrapper = $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').find('.product-single-info_row-items');
//
//             $(`.product__single-item-info[data-group-id="${dg_popup}"]`).append(json.html);
//             $(`.product__single-item-info[data-group-id="${dg_popup}"]`).find('.select-2').each(function() {
//                 $(this).select2();
//             });
//             selected_product_wrapper.empty();
//             selected_product_wrapper.append(json.html);
//
//             json.items.map((item) => {
//                 const item_price = Number(selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).attr('data-price'));
//                 selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).find('.product-qty').val(Number(item.value));
//                 selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).find('.price-placee').html(`${getCurrencySymbol()}${item_price * Number(item.value)}`);
//             });
//
//             // setTotalPrice(modal);
//             setTotalPrice(countTotalPrice());
//             $('#popUpModal').modal('hide');
//
//             $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
//                 $(this).closest('.menu-item-selected').remove();
//                 setTotalPrice(modal);
//             });
//
//             // $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
//             //     eventInitialDefault(ev);
//             //     // const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
//             //
//             //     // handleProductCountMinus($(this), $(`[data-group="${data_group_id}"]`), 'popup', limit);
//             //     // setTotalPrice(modal);
//             // });
//             //
//             // $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
//             //     eventInitialDefault(ev);
//             //     // const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
//             //
//             //     // handleProductCountPlus($(this), $(`[data-group="${dg_popup}"]`), 'popup', limit);
//             //     // setTotalPrice(modal);
//             // });
//         });
// });

// $('body').on('click', '.filter-sidebar-wrapper .head.filter-main__head', function () {
//     let blockId = $(this).parent().find('.all-filters');
//     if ($(blockId).css('display') == 'none')
//     {
//         $(blockId).animate({height: 'show'}, 400);
//         $(this).find('i').toggleClass('fa-plus fa-minus');
//     }
//     else
//     {
//         $(blockId).animate({height: 'hide'}, 400);
//         $(this).find('i').toggleClass('fa-minus fa-plus');
//     }
// });

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

// grid brands products

//counts qty for group
//         const new_qty = function (group, type) {
//             let qty = 0;
//             if (type === 'popup') {
//                 $('.selected-items_popup').find('.popup_field-input').each(function () {
//                     qty += Number($(this).val());
//                 });
//             } else if (type === 'filter') {
//                 $('#wizardViewModal .selected-items_filter').find('.popup_field-input').each(function () {
//                     qty += Number($(this).val());
//                 });
//             } else {
//                 group.closest('.product-single-info_row').find('.product-qty').each(function () {
//                     qty += Number($(this).val());
//                 });
//             }
//
//             return qty;
//         };

//set select2 max limit
//         const select2MaxLimit = (section, limit) => {
//             section.select2({
//                 maximumSelectionLength:
//                     Number(limit)
//                     - Number(new_qty(section))
//                     + section.closest('.product-single-info_row').find('input[name="qty"]').length
//             });
//         };

//product-count-minus event callback
//         const handleProductCountMinus = (minus_button, section, type, limit) => {
//             const counter = $(minus_button.closest('.continue-shp-wrapp_qty').find('.field-input')[0]);
//
//             Number(counter.val()) > 1 && counter.val(Number(counter.val()) - 1);
//             new_qty(section);
//
//             if (type === 'select') {
//                 select2MaxLimit(section, limit);
//             } else if (type === 'checkbox') {
//
//             }
//
//             const price = minus_button.closest('[data-price]').attr('data-price');
//             minus_button.closest('[data-price]').find('.price-placee').html(`${getCurrencySymbol()}${price * Number(counter.val())}`);
//         };
// const countPrices = (modal) => {
//     section_price = 0;
//     item_price = 0;
//     $(`${modal ? '#extraModal' : '.single-product-dtls-wrap'} [data-per-price]`).each(function () {
//         const $this = $(this);
//         if ($this.attr('data-per-price') === 'product') {
//             section_price += Number($this.attr('data-price'));
//         } else if ($this.attr('data-per-price') === 'item') {
//             $this.closest('.product-single-info_row').find('.product-qty').length !== 0
//             && $this.closest('.product-single-info_row').find('.product-qty').each(function () {
//                 const $product_qty_input = $(this);
//                 const qty = Number($product_qty_input.val());
//                 const price = Number($product_qty_input.closest('[data-price]').attr('data-price'));
//                 item_price = item_price + (qty * price);
//             });
//         }
//     });
//     return section_price + item_price;
// };
//
// const setTotalPrice = (modal) => {
//     const total_price_count = Number($('.product-qty-select').val());
//     //total price element
//     const $total = modal ? $('.modal-price-place-summary') : $('.price-place-summary');
//     $total.html(`${getCurrencySymbol()}${countPrices(modal) * total_price_count}`);
// };

// const makeSelectedItem = (data_group) => {
//     $(`.package_product[data-group-id="${data_group}"]`).closest('.product-single-info_row').find('.menu-item-selected').each(function () {
//         $('#popUpModal').find(`.single-item-wrapper[data-id="${$(this).attr('data-id')}"]`).find('.single-item').click();
//         $(`.selected-item_popup[data-id-popup="${$(this).attr('data-id')}"]`).find('.selected-item-popup_qty-select').val(Number($(this).find('.product-qty').val()));
//     });
// };
//         const productsInit = (modal, modalType = 'all') => {
//             const getParentId = modal ? '#extraModal' : '#requiredProducts';
// //--------------------------------select start
//             const selectInit = () => {
//                 (function () {
//                     $(`${getParentId} .product-pack-select`) && $(`${getParentId} .product-pack-select`).each(function (i, e) {
//                         makeOutOfStockSelectOption($(this), 'select');
//                         const products_id = $(e).attr('data-id');
//                         const select = $(e);
//                         fetch("/products/get-package-type-limit", {
//                             method: "post",
//                             headers: {
//                                 "Content-Type": "application/json",
//                                 Accept: "application/json",
//                                 "X-Requested-With": "XMLHttpRequest",
//                                 "X-CSRF-Token": $('input[name="_token"]').val()
//                             },
//                             credentials: "same-origin",
//                             body: JSON.stringify({id: products_id})
//                         })
//                             .then(function (response) {
//                                 return response.json();
//
//                             })
//                             .then(function (json) {
//                                 const limit = Number(json.limit);
//
//                                 select.select2({
//                                     minimumResultsForSearch: Infinity,
//                                     maximumSelectionLength: isSingle(select) ? Infinity : Number(json.limit),
//                                     placeholder: 'Select an option'
//                                 });
//
//                                 select.closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
//                                     eventInitialDefault(ev);
//                                     handleProductCountMinus($(this), select, 'select', limit);
//                                     setTotalPrice(modal);
//                                 });
//
//                                 select.closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
//                                     eventInitialDefault(ev);
//                                     handleProductCountPlus($(this), select, 'select', limit);
//                                     setTotalPrice(modal);
//                                 });
//
//                                 select.on('select2:select', function (e) {
//                                     const $this = $(this);
//                                     const current_item_id = $(e.params.data.element).val();
//                                     new_qty(select);
//                                     console.log({
//                                         id: e.params.data.id,
//                                             selectElementId: current_item_id
//                                     })
//                                     fetch("/products/get-variation-menu-raw", {
//                                         method: "post",
//                                         headers: {
//                                             "Content-Type": "application/json",
//                                             Accept: "application/json",
//                                             "X-Requested-With": "XMLHttpRequest",
//                                             "X-CSRF-Token": $('input[name="_token"]').val()
//                                         },
//                                         credentials: "same-origin",
//                                         body: JSON.stringify({
//                                             id: e.params.data.id,
//                                             selectElementId: current_item_id
//                                         })
//                                     })
//                                         .then(function (response) {
//                                             return response.json();
//                                         })
//                                         .then(function (json) {
//                                             if (isSingle(select)) {
//                                                 !isSection(select) && ($this.closest('.product-single-info_row').find('.selected-menu-options').html(json.html));
//                                             } else {
//                                                 $this.closest('.product-single-info_row').find('.product-single-info_row-items').append(json.html);
//                                             }
//                                             setTotalPrice(modal);
//
//                                             $('.delete-menu-item').on('click', function () {
//                                                 const $this = $(this);
//                                                 const s_id = $this.attr('data-el-id');
//                                                 $(`.select2-selection__choice[data-select2-id="${s_id}"].select2-selection__choice__remove`).click();
//                                                 $(`#multi_v_select_${products_id} option[data-select2-id="${s_id}"]`);
//                                                 const deleted = $this.closest('.menu-item-selected').attr('data-id');
//                                                 const values = select.val().filter((value) => value !== deleted);
//                                                 select.val(values).trigger('change.select2');
//                                                 $this.closest('.menu-item-selected').remove();
//                                                 new_qty(select);
//                                                 select2MaxLimit(select, limit);
//                                                 setTotalPrice(modal);
//                                             });
//
//                                         })
//                                         .catch(function (error) {
//                                             console.log(error);
//                                         });
//                                 });
//
//                                 isSingle(select) && select.ready(function (e) {
//                                     const current_item_id = select.children().first().attr('data-select2-id');
//
//                                     fetch("/products/get-variation-menu-raw", {
//                                         method: "post",
//                                         headers: {
//                                             "Content-Type": "application/json",
//                                             Accept: "application/json",
//                                             "X-Requested-With": "XMLHttpRequest",
//                                             "X-CSRF-Token": $('input[name="_token"]').val()
//                                         },
//                                         credentials: "same-origin",
//                                         body: JSON.stringify({
//                                             id: select.children().first().attr('value'),
//                                             selectElementId: current_item_id
//                                         })
//                                     })
//                                         .then(function (response) {
//                                             return response.json();
//                                         })
//                                         .then(function (json) {
//                                             if (isSingle(select)) {
//                                                 !isSection(select) && (item_price += select.closest('.product-single-info_row').find('.menu-item-selected').find('[data-price]'));
//                                             } else {
//                                                 select.closest('.product-single-info_row').find('.product-single-info_row-items').append(json.html);
//                                             }
//
//                                             setTotalPrice(modal);
//                                         })
//                                         .catch(function (error) {
//                                             console.log(error);
//                                         });
//                                 });
//
//                                 $(`#multi_v_select_${products_id}`).on('select2:unselect', function (e) {
//                                     $(this).closest('.product-single-info_row').find(`.menu-item-selected[data-id="${e.params.data.id}"]`).remove();
//                                     setTimeout(function () {
//                                         new_qty(select);
//                                         select2MaxLimit(select, limit);
//                                         setTotalPrice(modal);
//                                     }, 0);
//                                 });
//                             })
//                             .catch(function (error) {
//                                 console.log(error);
//                             });
//
//                     });
//                 })();
//             };
// //--------------------------------select end
//
// //--------------------------------list start
//             const listInit = () => {
//                 (function () {
//                     const hasQtyCounter = (qty_section) => {
//                         return qty_section.children().length !== 0;
//                     };
//
//                     const counterHtml = (id) => {
//                         return (`<div class="continue-shp-wrapp_qty position-relative product-counts-wrapper w-100">
//                                     <span class="d-flex align-items-center h-100 pointer position-absolute product-count-minus">
//                                         <svg viewBox="0 0 20 3" width="20px" height="3px">
//                                             <path fill-rule="evenodd" fill="rgb(214, 217, 225)" d="M20.004,2.938 L-0.007,2.938 L-0.007,0.580 L20.004,0.580 L20.004,2.938 Z"></path>
//                                         </svg>
//                                     </span>
//                                     <input name="qty" data-id="${id}" min="1" value="1" type="number" class="field-input w-100 h-100 font-23 text-center border-0 form-control product-qty none-touchable"/>
//                                     <span  class="d-flex align-items-center h-100 pointer position-absolute product-count-plus">
//                                         <svg viewBox="0 0 20 20" width="20px" height="20px">
//                                             <path fill-rule="evenodd" fill="rgb(211, 214, 223)" d="M20.004,10.938 L11.315,10.938 L11.315,20.000 L8.696,20.000 L8.696,10.938 L-0.007,10.938 L-0.007,8.580 L8.696,8.580 L8.696,0.007 L11.315,0.007 L11.315,8.580 L20.004,8.580 L20.004,10.938 Z"></path>
//                                         </svg>
//                                     </span>
//                                 </div>`);
//                     };
//
//                     $(`${getParentId} .products-list-wrap`).each(function (index, data_el) {
//                         makeOutOfStockSelectOption($(this), 'list');
//                         const products_id = $(data_el).attr('data-id');
//                         const limit = Number($(data_el).attr('data-limit'));
//
//                         $(`#products-list_${products_id}`).on('click', '.package_checkbox_label', function (event) {
//                             eventInitialDefault(event);
//                             const checkbox = $(event.target).closest('.checkbox-wrap').find('.package_checkbox')[0];
//                             const id = $(checkbox).val();
//                             const counter_wrap = $($(event.target).closest('.product-list-item').find('.list-qty')[0]);
//                             const price = $(counter_wrap[0]).closest('[data-price]').attr('data-price');
//                             const block_id = $(this).closest('.products-list-wrap').attr('data-id');
//
//                             if (new_qty(counter_wrap) === limit && !isChecked($(checkbox))) {
//                                 return false;
//                             }
//                             if (!hasQtyCounter(counter_wrap)) {
//                                 // products-list-wrap
//                                 fetch("/products/get-variation-menu-raw", {
//                                     method: "post",
//                                     headers: {
//                                         "Content-Type": "application/json",
//                                         Accept: "application/json",
//                                         "X-Requested-With": "XMLHttpRequest",
//                                         "X-CSRF-Token": $('input[name="_token"]').val()
//                                     },
//                                     credentials: "same-origin",
//                                     body: JSON.stringify({id: block_id, selectElementId: id})
//                                 })
//                                     .then(function (response) {
//                                         return response.json();
//                                     })
//                                     .then(function (json) {
//                                         $(counter_wrap[0]).append(json.html);
//                                     })
//                                     .catch(function (error) {
//                                         console.log(error);
//                                     });
//                                 // $(counter_wrap[0]).append(counterHtml(id));
//                                 setTotalPrice(modal);
//                             } else {
//                                 $(counter_wrap[0]).closest('[data-price]').find('.price-placee').html(`${getCurrencySymbol()}${price}`);
//                                 $(counter_wrap[0]).empty();
//                                 setTotalPrice(modal);
//                             }
//                             $(this).closest('div').find('.package_checkbox')[0].click();
//                         });
//
//                         $(`#products-list_${products_id}`).on('click', '.product-count-minus', function (ev) {
//                             eventInitialDefault(ev);
//                             handleProductCountMinus($(this), $(`#products-list_${products_id}`), 'checkbox', limit);
//                             setTotalPrice(modal);
//                         });
//
//                         $(`#products-list_${products_id}`).on('click', '.product-count-plus', function (ev) {
//                             eventInitialDefault(ev);
//                             handleProductCountPlus($(this), $(`#products-list_${products_id}`), 'checkbox', limit);
//                             setTotalPrice(modal);
//                         });
//                     });
//                 })();
//             };
// //--------------------------------list end
//
// //--------------------------------popup start
//             const popupInit = () => {
//                 (function () {
//
//                     $(`${getParentId} .popup-select`).each(function () {
//                         const data_group_id = $(this).closest('.package_product').attr('data-group-id');
//                         let limit = 0;
//
//
//                         $('body').on('click', '.delete-menu-item_popup', function () {
//                             const id = $(this).attr('data-el-id');
//
//                             $(this).closest('.modal').find(`.single-item-wrapper[data-id="${id}"]`).removeClass('active');
//                             $(this).closest('.selected-item_popup').remove();
//                         });
//
//                         $('body').on('click', `#popUpModal[data-group="${data_group_id}"] .selected-item-popup_qty-plus`, function (ev) {
//                             eventInitialDefault(ev);
//                             if (limit > new_qty(null, 'popup')) {
//                                 $(this).siblings(".popup_field-input").val(Number($(this).siblings(".popup_field-input").val()) + 1);
//                             }
//                         });
//
//                         $('body').on('click', `#popUpModal[data-group="${data_group_id}"] .selected-item-popup_qty-minus`, function (ev) {
//                             eventInitialDefault(ev);
//                             $(this).siblings(".popup_field-input").val() > 1 && $(this).siblings(".popup_field-input").val(Number($(this).siblings(".popup_field-input").val()) - 1);
//                         });
//
//                         $('#popUpModal').on('click', '.b_close', function () {
//                             $(".single-item-wrapper").removeClass('active');
//                         });
//
//                     });
//
//                 })();
//             };
// //--------------------------------popup end
//
//--------------------------------filter modal start

//--------------------------------filter modal end
//
// //--------------------------------filter select start
//             const filterSelectInit = () => {
//                 (function () {
//
// //select handle function
//                     const selectHandle = (el, id, selectElementId, limit, select) => {
//                         fetch("/products/get-variation-menu-raw", {
//                             method: "post",
//                             headers: {
//                                 "Content-Type": "application/json",
//                                 Accept: "application/json",
//                                 "X-Requested-With": "XMLHttpRequest",
//                                 "X-CSRF-Token": $('input[name="_token"]').val()
//                             },
//                             credentials: "same-origin",
//                             body: JSON.stringify({id: id, selectElementId: id})
//                         })
//                             .then(function (response) {
//                                 return response.json();
//                             })
//                             .then(function (json) {
//                                 const isMultiple = select.closest('[data-limit]').attr('data-limit') === '1' ? false : true;
//                                 if (isMultiple) {
//                                     el.closest('.product-single-info_row').find('.filter-children-items').append(json.html);
//                                     select2MaxLimit(select, limit);
//                                 } else {
//                                     el.closest('.product-single-info_row').find('.menu-item-selected').remove();
//                                     el.closest('.product-single-info_row').find('.filter-children-items').append(json.html);
//                                     // el.closest('.product-single-info_row').find('.filter .col-sm-2.pl-sm-3.p-0.text-sm-center').html($(el.closest('.product-single-info_row').find('.filter-children-items').children()[1]));
//                                     $(el.closest('.product-single-info_row').find('.filter-children-items').children()[1]).remove();
//                                 }
//                                 setTotalPrice(modal);
//                             })
//                             .catch(function (error) {
//                                 console.log(error);
//                             });
//                     };
//
// //unselect handle function
//                     const unselectHandle = (select, id, limit) => {
//                         select.closest('.filters-select-wizard').find(`.menu-item-selected[data-id="${id}"]`).remove();
//                         setTimeout(function () {
//                             select2MaxLimit(select, limit);
//                             setTotalPrice(modal);
//                         }, 0);
//                     };
//
//
//                     $(`${getParentId} .filters-select-wizard`).each(function () {
//                         const group_id = $(this).attr('data-group');
//
//                         $(`[data-group="${group_id}"]`).on('change', function () {
//                             let self = $(this);
//                             let parentRow = $(this).closest('.product-single-info_row');
//                             let data = parentRow.find('form#filter-form').serialize();
//                             const limit = $(this).closest('[data-limit]').attr('data-limit');
//
//                             AjaxCall("/filters",
//                                 data,
//                                 function (res) {
//                                     if (!res.error) {
//                                         switch (res.type) {
//                                             case 'filter':
//                                                 parentRow.find('.filter-children-items').empty();
//                                                 parentRow.find('.filter-children-selects').html(res.filters);
//                                                 Number(parentRow.find('.limit[data-limit]').attr('data-limit')) === 1
//                                                 && parentRow.find('.limit[data-per-price]').attr('data-per-price') !== 'product'
//                                                 && parentRow.find('.filter .col-sm-2.pl-sm-3.p-0.text-sm-center').empty();
//                                                 break;
//                                             case 'items':
//                                                 const isMultiple = self.closest('[data-limit]').attr('data-limit') === '1' ? false : true;
//                                                 parentRow.find('.filter-children-selects').html(res.filters);
//                                                 parentRow.find('.filter-children-items').children().length === 0 && parentRow.find('.filter-children-items').html(res.items_html);
//                                                 parentRow.find(".product--select-items").select2({
//                                                     multiple: isMultiple,
//                                                     placeholder: "Select Products",
//                                                 });
//                                                 makeOutOfStockSelectOption(parentRow.find(".product--select-items"), 'select');
//                                                 if (isMultiple) {
//                                                     select2MaxLimit(parentRow.find('.product--select-items'), limit);
//                                                 } else {
//                                                     setTimeout(function () {
//                                                         const selectElementId = $(parentRow.find(".product--select-items").children()[0]).val();
//                                                         const id = parentRow.find(".product--select-items").val();
//                                                         selectHandle(self, id, selectElementId, limit, parentRow.find(".product--select-items"));
//                                                     }, 0);
//
//                                                 }
//                                                 parentRow.find(".product--select-items").find('option[value=""]').remove();
//                                                 break;
//                                         }
//                                     }
//                                 });
//                         });
//
//                         $(`[data-group="${group_id}"]`).on('select2:select', '.product--select-items', function (e) {
//                             const id = e.params.data.id;
//                             const limit = $(this).closest('[data-limit]').attr('data-limit');
//                             const selectElementId = $(e.params.data.element).attr('data-select2-id');
//                             selectHandle($(e.target), id, selectElementId, limit, $(this));
//                         });
//
//                         $(`[data-group="${group_id}"]`).on('select2:unselect', '.product--select-items', function (e) {
//                             const limit = $(this).closest('[data-limit]').attr('data-limit');
//                             unselectHandle($(this), e.params.data.id, limit);
//                         });
//
//                         $(`[data-group="${group_id}"]`).on('click', '.product-count-minus', function (ev) {
//                             eventInitialDefault(ev);
//                             const limit = $(this).closest('[data-limit]').attr('data-limit');
//                             const row = $(this).closest('.product-single-info_row');
//                             const select = row.find('.product--select-items');
//
//                             handleProductCountMinus($(this), select, 'select', limit);
//                             setTotalPrice(modal);
//                         });
//
//                         $(`[data-group="${group_id}"]`).on('click', '.product-count-plus', function (ev) {
//                             eventInitialDefault(ev);
//                             const limit = $(this).closest('[data-limit]').attr('data-limit');
//                             const row = $(this).closest('.product-single-info_row');
//                             const select = row.find('.product--select-items');
//
//                             handleProductCountPlus($(this), select, 'select', limit);
//                             setTotalPrice(modal);
//                         });
//
//                         $(`[data-group="${group_id}"]`).on('click', '.delete-menu-item', function () {
//                             const limit = $(this).closest('[data-limit]').attr('data-limit');
//
//                             if ($(this).closest('.filters-select-wizard').length > 0) {
//                                 const $this = $(this);
//                                 const s_id = $this.attr('data-el-id');
//
//                                 $(`.select2-selection__choice[data-select2-id="${s_id}"].select2-selection__choice__remove`).click();
//                                 $(this).closest('.filters-select-wizard').find(`option[data-select2-id="${s_id}"]`);
//                                 const deleted = $this.closest('.menu-item-selected').attr('data-id');
//                                 const values = $(this).closest('.filters-select-wizard').find('.product--select-items').val().filter((value) => value !== deleted);
//                                 $(this).closest('.filters-select-wizard').find('.product--select-items').val(values).trigger('change.select2');
//                                 $this.closest('.menu-item-selected').remove();
//                                 select2MaxLimit($(this).closest('.filters-select-wizard').find('.product--select-items'), limit);
//                                 setTotalPrice(modal);
//                             }
//                         });
//                     });
//
//                 })();
//             };
// //--------------------------------filter select end
//
//             if (!modal && initCount === 0) {
//                 selectInit();
//                 listInit();
//                 popupInit();
//                 filterModalInit();
//                 filterSelectInit();
//                 initCount++;
//             } else if (modal) {
//                 switch (modalType) {
//                     case 'menu':
//                         selectInit();
//                         break;
//                     case 'list':
//                         listInit();
//                         break;
//                     case 'popup':
//                         if (initPopupCount === 0) {
//                             popupInit();
//                             initPopupCount++;
//                         }
//                         break;
//                     case 'filter_popup':
//                         if (initFilterModalCount === 0) {
//                             filterModalInit();
//                             initFilterModalCount++;
//                         }
//                         break;
//                     case 'select_filter':
//                         filterSelectInit();
//                         break;
//                     default:
//                         return;
//                 }
//             }
//         };
// $("body").on('click', '#extraModal .product-card_btn', function () {
//     const variations = $('#extraModal [data-group-id]').toArray().map(function (el) {
//         const group_id = $(el).attr('data-group-id');
//         const products = [];
//         $(`#extraModal [data-group-id="${group_id}"]`).toArray().map(function (gr) {
//             console.log($(gr).find('.custom-control-input'))
//
//             if ($(gr).closest('.product-single-info_row').find('.product-qty').length !== 0) {
//                 $(gr).closest('.product-single-info_row').find('.product-qty').toArray().map(function (qt) {
//                     products.push({
//                         id: $(qt).attr('data-id'),
//                         qty: $(qt).val()
//                     });
//                 });
//             } else if ($(gr).find('.custom-control-input').length === 0 || $(gr).find('.custom-control-input').is(':checked')) {
//
//                 products.push({
//                     id: $($(gr).find('[data-id]')[0]).attr('data-id'),
//                     qty: 1
//                 });
//                 console.log(products, 'products')
//             } else {
//                 products.push({
//                     id: $($(gr).find('[data-id]')[0]).attr('data-id'),
//                     qty: 1
//                 });
//             }
//         });
//         return {
//             group_id,
//             products
//         };
//     });
//
//
//
//     const filtered_variations = variations.filter((variation) => {
//         return variation.products.length > 0;
//     });
//     console.log('filtered_variations', filtered_variations);
//     if (filtered_variations.length > 0) {
//         $.ajax({
//             type: "post",
//             url: "/add-extra-to-cart",
//             cache: false,
//             datatype: "json",
//             data: {
//                 key: addDataKey.key,
//                 product_id: addDataKey.product_id,
//                 variations: filtered_variations[0],
//                 cart: isCartPage()
//             },
//             headers: {
//                 "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
//             },
//             success: function (data) {
//                 if (!data.error) {
//                     $(`#extraModal [data-group-id]`).closest('.product-single-info_row ').addClass('pointer-events-none');
//                     selectedGroupId.push({
//                         group: $(`#extraModal [data-group-id]`).attr('data-group-id'),
//                         view: $(`#extraModal [data-group-id]`).closest('.product-single-info_row '),
//                     });
//
//                     $('#extraModal .product-card_btn').removeClass('d-inline-flex').addClass('d-none');
//                     $('#extraModal .product-card_edit').removeClass('d-none').addClass('d-inline-flex');
//
//                     $('.cart-area').html(data.html);
//                 } else {
//
//                 }
//             }
//         });
//     }
// });
// $("body").on('click', '.btn-add-to-cart', function () {
//     var variationId = $(this).data("id");
//     let all_validation = false;
//     let item_validation = 0;
//     $('#requiredProducts .limit').each(function (index, gr) {
//         const $group = $(gr);
//         const group_id = Number($group.attr('data-id'));
//         const group_limit = Number($group.attr('data-limit'));
//         const group_min_limit = Number($group.attr('data-min-limit'));
//         let qty = 0;
//
//         $group.closest('.product-single-info_row').find('.product-qty').each(function (index, i_qty) {
//             const $item_qty = $(i_qty)
//
//             qty += Number($item_qty.val());
//         });
//
//         if (group_limit >= qty && group_min_limit <= qty) {
//             item_validation += 1;
//         }
//     });
//     all_validation = true;
//     $('.product-qty').toArray().map(function (el) {
//         return {
//             id: $(el).attr('data-id'),
//             qty: $(el).val()
//         };
//     });
//
//     if (all_validation) {
//         const product_id = $('#vpid').val();
//         const product_qty = $('.product-qty-select').val();
//         const variations = $('#requiredProducts [data-group-id]').toArray().map(function (el) {
//             const group_id = $(el).attr('data-group-id');
//             const products = [];
//             $(`[data-group-id="${group_id}"]`).toArray().map(function (gr) {
//                 if ($(gr).closest('.product-single-info_row').find('.product-qty').length !== 0) {
//                     $(gr).closest('.product-single-info_row').find('.product-qty').toArray().map(function (qt) {
//                         products.push({
//                             id: $(qt).attr('data-id'),
//                             qty: $(qt).val()
//                         });
//                     });
//                 } else if ($(gr).find('.custom-control-input').length === 0 || $(gr).find('.custom-control-input').is(':checked')) {
//                     products.push({
//                         id: $($(gr).find('[data-id]')[0]).attr('data-id'),
//                         qty: 1
//                     });
//                 }
//             });
//             return {
//                 group_id,
//                 products
//             };
//         });
//
//         const filtered_variations = variations.filter((variation) => {
//             return variation.products.length > 0;
//         });
//         const product_data = {
//             product_id,
//             product_qty,
//             variations: filtered_variations
//         };
//
//         $.ajax({
//             type: "post",
//             url: "/add-to-cart",
//             cache: false,
//             datatype: "json",
//             data: product_data,
//             headers: {
//                 "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
//             },
//             success: function (data) {
//                 if (!data.error) {
//                     $(".cart-count").html(data.count);
//                     $('#cartSidebar').html(data.headerHtml);
//                     addDataKey.key = data.key;
//                     addDataKey.product_id = data.product_id;
//                     AjaxCall("/products/get-extra-content", {id: $("#vpid").val()}, function (res) {
//                         if (!res.error) {
//                             $("#extraModal .modal-body").html(res.html);
//                             productsInit();
//                             $("#extraModal").modal();
//                         }
//                     });
//
//                     $('#extraModal .extra-content-left .select-extra.item.active').click();
//                 } else {
//                     alert(data.message);
//                 }
//             }
//         });
//     } else {
//         alert('Select available variation');
//     }
// });


