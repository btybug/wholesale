$(document).ready(function () {

    function Hover_slider() {
        var _this = this;

        this.myEvents = function () {

            $("body").on('mouseover','.product-card_thumb-img-holder',function(){
                let img_path = $(this).find("img").attr("src")
                let alt_text = $(this).find("img").attr("alt")
                $(this).closest('.product-card_thumb-img-holder')
                $(this).parent().find('.product-card_thumb-img-holder').removeClass("active_slider")
                $(this).addClass("active_slider");
                console.log($(this))
                $(this).closest(".product-card").find('.card-img-top').attr("src",img_path)
                $(".main-image-alt-text").text(alt_text);
            })

        };
        this.products = function () {
            $("body").on('mouseover',".product-single-view-outer .product-card_thumb-img-holder",function () {
                console.log(1)
                $('.product-single-view-outer .product-card_thumb-img-holder').removeClass("active_slider")
                let img_path = $(this).find("img").attr("src")

                $(".product-single-view-outer .product-card_view--single img").addClass("active_slider").attr("src", img_path)
                $(".product-single-view-outer .product-card_view--single .product-single-lightbox-item").attr("href", img_path)
                $(this).addClass("active_slider")


            })
        }

    }

    var app = new Hover_slider();
    app.myEvents()
    app.products()

})
