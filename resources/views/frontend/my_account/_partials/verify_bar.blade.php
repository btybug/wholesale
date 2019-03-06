<div id="profileSidebar" class="profile-aside profile-page-profile-aside d-flex flex-column">
    <div class="profile-aside-dtls">
        <h2 class="profile-aside-username text-white text-center">Status</h2>


    </div>
    <ul class="user-aside-menu list-unstyled">
        @if(Auth::user()->status)
            <p style="color: white">Verified User</p>
        @else
            @if(Auth::user()->verification_type && Auth::user()->verification_image)
                <p style="color: white">Your Verification will be reviewed by our admin shortly</p>
            @else
                <p style="color: white">Action Required</p>
                <p style="color: white">Verify your ID so we can process your orders with no delay</p>
            @endif

            <li class="user-aside-menu-item">
                <a href="{!! route('my_account_verification') !!}" class="user-aside-menu-link text-white d-inline-flex align-items-center">
                <span class="user-aside-menu-icon-holder">
                   <svg width="37px" height="37px">
<path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M13.934,37.000 L9.703,32.768 L10.106,32.365 C10.862,31.609 11.080,31.060 11.080,29.915 C11.080,27.600 9.400,25.920 7.085,25.920 C5.940,25.920 5.391,26.138 4.635,26.894 L4.231,27.297 L-0.000,23.066 L23.066,-0.000 L27.297,4.231 L26.894,4.635 C26.138,5.391 25.920,5.940 25.920,7.085 C25.920,9.400 27.600,11.080 29.915,11.080 C31.060,11.080 31.609,10.862 32.365,10.106 L32.768,9.703 L37.000,13.934 L13.934,37.000 ZM32.753,11.301 C31.941,11.981 31.160,12.222 29.915,12.222 C26.986,12.222 24.778,10.014 24.778,7.085 C24.778,5.840 25.019,5.059 25.699,4.248 L23.066,1.614 L15.883,8.797 L17.762,10.677 L16.955,11.484 L15.076,9.604 L1.614,23.066 L4.247,25.699 C5.059,25.019 5.840,24.778 7.085,24.778 C10.014,24.778 12.222,26.986 12.222,29.915 C12.222,31.160 11.981,31.941 11.301,32.752 L13.934,35.386 L27.396,21.924 L25.516,20.045 L26.323,19.238 L28.203,21.117 L35.386,13.934 L32.753,11.301 ZM22.092,16.621 L22.899,15.814 L25.182,18.097 L24.375,18.904 L22.092,16.621 ZM18.096,12.626 L18.903,11.819 L21.186,14.102 L20.379,14.909 L18.096,12.626 Z"></path>
</svg></span>Verification</a>
            </li>
        @endif

    </ul>
</div>