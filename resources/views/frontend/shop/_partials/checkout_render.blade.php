@if(Auth::check())
    @if( ! Auth::user()->hasVerifiedEmail())
        <div class="col-md-12 justify-content-center">
            <div class="row">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('frontend.shop._partials.address')
    @endif
@else
    @include("frontend._partials.login_modal_form")
@endif
