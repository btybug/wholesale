{{--<div class="js-cookie-consent cookie-consent">--}}

    {{--<span class="cookie-consent__message">--}}
        {{--{!! trans('cookieConsent::texts.message') !!}--}}
    {{--</span>--}}

    {{--<button class="js-cookie-consent-agree cookie-consent__agree">--}}
        {{--{{ trans('cookieConsent::texts.agree') }}--}}
    {{--</button>--}}

{{--</div>--}}


<div class="js-cookie-consent cookie-consent">

    <div class="container">
        <div class="row justify-content-center w-100 align-items-center py-2">
            <div class="col-sm-9 mb-sm-0 mb-2">
                <p class="cookie-consent__message font-12 text-sm-left text-center mb-0">
                    {!! trans('This site uses cookies to function properly and to provide services to you in line with your preferences. If you want to find out more or prevent some or all cookies from being activated <a href="#">&nbsp;click here</a>') !!}
                </p>
            </div>

            <div class="col-sm-3">
                <button class="js-cookie-consent-agree cookie-consent__agree pointer w-100">
                    {{ trans('I agree') }}
                </button>
            </div>
        </div>
    </div>

</div>
