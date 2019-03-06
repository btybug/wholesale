<div class="tabs-outer">
    <div class="text-center tabs-top">
        <div class="img-outer">
            <img src="/public/images/{!!Auth::user()->gender!!}.png" alt="">
        </div>
        <h4 class="mb-3">{!!Auth::user()->name!!}</h4>
        <h5 class="font-weight-normal">Position</h5>
    </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link @if($activeItem == 'my_account') active @endif" href="{!! route('my_account') !!}" >My account</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($activeItem == 'my_account_password') active @endif" href="{!! route('my_account_password') !!}" >Password</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($activeItem == 'my_account_logs') active @endif" href="{!! route('my_account_logs') !!}">Logs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($activeItem == 'my_account_favourites') active @endif"  href="{!! route('my_account_favourites') !!}">Favourites</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($activeItem == 'my_account_orders') active @endif" href="{!! route('my_account_orders') !!}" >My orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($activeItem == 'my_account_address') active @endif" href="{!! route('my_account_address') !!}" >Address book
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($activeItem == 'my_account_verification') active @endif" href="{!! route('my_account_verification') !!}" >Verification
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($activeItem == 'my_account_payment') active @endif" href="{!! route('my_account_payment') !!}" >Payments
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($activeItem == 'my_account_tickets') active @endif" href="{!! route('my_account_tickets') !!}" >My tickets
            </a>
        </li>
    </ul>
</div>