@extends('layouts.frontend')
@section('content')
    <div class="container">
        <ul class="nav nav-pills nav-fill ml-0" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="address-tab" data-toggle="tab" href="javascript:void(0)" role="tab"
                   aria-controls="address" aria-selected="true" aria-expanded="true">Address</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" id="payment-tab" data-toggle="tab" href="javascript:void(0)" role="tab"
                   aria-controls="payment" aria-selected="false">Payment</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active in show" id="address" role="tabpanel" aria-labelledby="pricing-tab">
                @include('frontend.shop._partials.checkout_render')
            </div>
            <div class="tab-pane fade payment_tab" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                @include('frontend.shop._partials.checkout_payment')
            </div>
        </div>
    </div>

    <div class="modal fade" id="newAddressModal" tabindex="-1" role="dialog"
         aria-labelledby="newAddressModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Address Book</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body address-form">

                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
    <style>
        .StripeElement {
            width: 389px;
            background-color: white;
            height: 40px;
            padding: 10px 12px;
            border-radius: 4px;
            border: 1px solid transparent;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        //addresses js
        $("body").on('click','.save-address-book',function () {
            var form = $(".address-book-form").serialize();
            AjaxCall(
                "/my-account/save-address-book",
                form,
                res => {
                if (!res.error) {
                let select = $(".select-address")
                var opt = document.createElement('option');
                opt.value = res.data.id;
                opt.innerHTML = res.data.name;
                select.append(opt);
                $("#newAddressModal").modal('hide');

                select.val(res.data.id).trigger('change');
            }
        },
            error => {
                if(error.status == 422) {
                    $('.errors').html('');
                    for (var err in error.responseJSON.errors) {
                        $('.errors').append(error.responseJSON.errors[err] + '<br>');
                    }
                }
            }
            );
        })

        $("body").on('click','.address-book-new',function () {
            AjaxCall(
                "/my-account/address-book-form",
                { default:true},
                res => {
                if (!res.error) {
                $(".address-form").html(res.html);
                $("#geo_country_book").select2();
                $("#newAddressModal").modal();
            }
        }
            );
        });

        $("body").on("change", ".select-address", function() {
            $(".container").css('opacity','0.6');
            $(".loader-img").toggleClass('d-none');
            AjaxCall(
                "/change-shipping-method",
                {addressId:$(this).val()},
                res => {
                if (!res.error) {
                $(".container").css('opacity','1');
                $(".loader-img").toggleClass('d-none');
                $("#address").html(res.html);
            }
        },
            error => {
                $(".container").css('opacity','1');
                $(".loader-img").toggleClass('d-none');
            }
            );
        });

        $("body").on("change", "#geo_country_book", function() {
            var value = $(this).val();
            AjaxCall(
                "/get-regions-by-geozone",
                { country: value},
                res => {
                let select = document.getElementById('geo_region_book');
            select.innerText = null;
            if (!res.error) {
                var opt = document.createElement('option');
                opt.value = res.data.id;
                opt.innerHTML = res.data.name;
                select.appendChild(opt);
            }
        }
            );
        });
    </script>

    <script>
        var stripe = Stripe("{!! stripe_key() !!}");
        var elements = stripe.elements();
        // Custom Styling
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '24px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        // Create an instance of the card Element
        var card = elements.create('card', {style: style});
        // Add an instance of the card Element into the `card-element` <div>
        card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        // Handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        });
        // Send Stripe Token to Server
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
// Add Stripe Token to hidden input
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
// Submit form
            form.submit();
        }
    </script>
    <script>
        $(document).ready(function () {
            $("body").on("click", ".go-to-payment", function (event) {
                AjaxCall(
                    "/get-payment-options",
                    {},
                    res => {
                    if (!res.error) {
                    $(".nav-link").each(function (index,value) {
                        $(value).removeClass('active').addClass('disabled');
                    });

                    $(".tab-pane").each(function (index,value) {
                        $(value).removeClass('active in show');
                    });

                    $("#payment").addClass('active in show');
                    $("#payment-tab").removeClass('disabled').addClass('active');
                }
            }
                );
            });

            $("body").on("click", ".back-step", function (event) {
                $(".nav-link").each(function (index,value) {
                    $(value).removeClass('active').addClass('disabled');
                });

                $(".tab-pane").each(function (index,value) {
                    $(value).removeClass('active in show');
                });

                $("#address").addClass('active in show');
                $("#address-tab").removeClass('disabled').addClass('active');
            });

            $("body").on("click", ".nav-link", function (event) {
                event.stopImmediatePropagation();
            });

            $('body').on('change', '.payment_methods input[type=radio][name=payment_method]', function () {
                var method = $(this).val();
                if ($(this).is(':checked')) {
                    $('.payment_box').slideUp();
                    $(this).closest('li').find('.payment_box').slideDown();

                    $(".payment-method-data").each(function (index,value) {
                        $(value).addClass('d-none')
                    })

                    $("#" + method + "-method").removeClass('d-none')
                }
            })
        });

    </script>
    <script>
        $(document).ready(function () {
            function getRegionsPackage() {
                let value = $("#country").val();
                AjaxCall(
                    "/get-regions-by-country",
                    {country: value},
                    res => {
                    let select = document.getElementById('regions');
                select.innerText = null;
                if (!res.error) {
                    $.each(res.data, function (index, value) {
                        var opt = document.createElement('option');
                        opt.value = res.data[value];
                        opt.innerHTML = res.data[value];
                        select.appendChild(opt);
                    })

                }
            }
            );
            }

            function getRegions() {
                let value = $("#geo_country").val();
                AjaxCall(
                    "/get-regions-by-geozone",
                    {country: value},
                    res => {
                    let select = document.getElementById('geo_region');
                select.innerText = null;
                if (!res.error) {
                    var opt = document.createElement('option');
                    opt.value = res.data.id;
                    opt.innerHTML = res.data.name;
                    select.appendChild(opt);
                }
            }
            );
            }

            $("body").on("change", "#country", function () {
                getRegionsPackage();
            });

            $("body").on("change", "#geo_country", function () {
                getRegions();
            });

            $("body").on("change", ".select-shipping-method", function () {
                var optionId = $(this).val();
                var deliveryId = $(this).data('delivery');
                var addressId = $(".select-address").val();
                $(".container").css('opacity','0.6');
                $(".loader-img").toggleClass('d-none');
                AjaxCall(
                    "/change-shipping-method",
                    {deliveryId:deliveryId,optionId: optionId,addressId: addressId},
                    res => {
                    if (!res.error) {
                    $(".container").css('opacity','1');
                    $(".loader-img").toggleClass('d-none');
                    $("#address").html(res.html);
                }
            },
                error => {
                    $(".container").css('opacity','1');
                    $(".loader-img").toggleClass('d-none');
                }
                );
            });


            $("body").on("click", ".submit-cash", function () {
                $(".container").css('opacity','0.6');
                $(".loader-img").toggleClass('d-none');
                AjaxCall(
                    "/cash-order",
                    {},
                    res => {
                    if (!res.error) {
                    $(".container").css('opacity','1');
                    $(".loader-img").toggleClass('d-none');
                    window.location = res.url;
                }
            },
                error => {
                    $(".container").css('opacity','1');
                    $(".loader-img").toggleClass('d-none');
                }
                );
            });
        })
    </script>
@stop