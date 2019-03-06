<div class="main-right-wrapp kaliony-page d-flex flex-wrap" data-id="{{ $vape->id }}">
    <div class="col-xl-12 col-lg-12 p-0">
        <div class="main-content product-tab-main-content h-100">
            <div class="row no-gutters h-100">
                @if($vape->image)
                    <div>
                        <img src="{!! $vape->image !!}" alt="{!! @getImage( $vape->image)->seo_alt !!}">
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 p-0">
        <div class="product-content-left-col-inner">
            <div class="d-flex w-100 product-tab-main-content-desc">
                <div class="product-tab-main-content-title">
                    <img class="img-fluid logo" src="/public/img/kaliony-logo.svg"
                         alt="kaliony">

                    <div class="product-tab-main-content-sub text-uppercase">
                        <em class="txt-cl-red emph">{!! $vape->name !!}</em>
                    </div>
                </div>
                <div class="share-btns d-inline-block ml-auto">
                    @if(Auth::check())
                        <a href="javascript:void(0)"
                           class="d-block share-btns-item add-to-favorite add-to-favorite @if(Auth::user()->favorites()->exists($vape->id)) active @endif"
                           data-id="{!! $vape->id !!}">
                            <svg width="30px" height="28px" viewBox="0 0 30 28">
                                <path fill-rule="evenodd" stroke="rgb(34, 36, 35)"
                                      d="M29.355,11.060 C28.755,13.649 27.363,16.008 25.333,17.877 L14.912,27.331 L4.670,17.879 C2.637,16.007 1.246,13.648 0.645,11.060 C0.213,9.200 0.390,8.149 0.391,8.142 L0.400,8.080 C0.796,3.538 3.897,0.241 7.774,0.241 C10.634,0.241 13.152,2.028 14.347,4.904 L14.909,6.259 L15.471,4.904 C16.647,2.072 19.298,0.242 22.227,0.242 C26.102,0.242 29.204,3.539 29.609,8.139 C29.610,8.149 29.787,9.200 29.355,11.060 Z"></path>
                            </svg>
                        </a>
                    @endif
                    <div class="d-block share-btns-item share-social-btn pointer">
                        <svg width="32px" height="35px">
                            <path fill-rule="evenodd" fill="rgb(34, 36, 35)"
                                  d="M22.068,24.875 C21.763,25.186 21.500,25.528 21.274,25.889 L11.220,19.666 C11.486,18.988 11.637,18.249 11.637,17.475 C11.637,16.701 11.486,15.963 11.221,15.284 L21.277,9.109 C22.309,10.763 24.120,11.865 26.182,11.865 C29.390,11.865 32.000,9.204 32.000,5.933 C32.000,2.661 29.390,-0.000 26.182,-0.000 C22.974,-0.000 20.364,2.661 20.364,5.933 C20.364,6.678 20.505,7.388 20.752,8.046 L10.682,14.229 C9.642,12.613 7.851,11.543 5.818,11.543 C2.610,11.543 -0.000,14.204 -0.000,17.475 C-0.000,20.747 2.610,23.408 5.818,23.408 C7.851,23.408 9.642,22.337 10.682,20.721 L20.749,26.952 C20.499,27.620 20.363,28.334 20.363,29.070 C20.363,30.655 20.968,32.145 22.067,33.265 C23.201,34.421 24.691,35.000 26.181,35.000 C27.671,35.000 29.161,34.421 30.295,33.265 C31.394,32.145 31.999,30.655 31.999,29.070 C31.999,27.486 31.394,25.995 30.295,24.875 C28.027,22.561 24.336,22.561 22.068,24.875 ZM26.182,1.186 C28.748,1.186 30.836,3.316 30.836,5.933 C30.836,8.550 28.748,10.679 26.182,10.679 C23.615,10.679 21.527,8.550 21.527,5.933 C21.527,3.316 23.615,1.186 26.182,1.186 ZM5.819,22.221 C3.252,22.221 1.164,20.092 1.164,17.475 C1.164,14.858 3.252,12.729 5.819,12.729 C8.385,12.729 10.473,14.858 10.473,17.475 C10.473,20.092 8.385,22.221 5.819,22.221 ZM29.472,32.426 C27.658,34.277 24.705,34.277 22.890,32.426 C22.011,31.530 21.527,30.337 21.527,29.070 C21.527,27.803 22.011,26.610 22.890,25.714 C23.798,24.789 24.990,24.326 26.182,24.326 C27.374,24.326 28.565,24.789 29.473,25.714 C30.352,26.610 30.836,27.803 30.836,29.070 C30.836,30.337 30.352,31.530 29.472,32.426 Z"/>
                        </svg>
                        <div id="share" class="share-social product-share-social"></div>
                    </div>
                </div>
            </div>
            <p class="product-tab-main-content-info">
                <strong class="font-main-med fnz-18">
                    {!! $vape->long_description !!}
                </strong>
            </p>
            <div>
                <input type="hidden" value="{{ $vape->id }}" id="vpid">
                @include("admin.inventory._partials.render_price_form",['model' => $vape])
                <div>
                    <div class="form-group d-md-flex align-items-center">
                        <label for="productQty"
                               class="fnz-20 mb-md-0 mb-4 mr-3">Qty.</label>
                        {!! Form::number('',1,['class' => 'product-qty-select mr-3','min' => '1','style'=> 'width: 85px;']) !!}

                        <button class="btn btn-add-to-cart rounded-0 fnz-20">
                                                    <span class="icon">
                                                        <svg width="24px" height="31px">
                                                    <path fill-rule="evenodd" fill="rgb(255, 255, 255)"
                                                          d="M23.860,30.854 C23.767,30.947 23.640,31.000 23.507,31.000 L0.493,31.000 C0.359,31.000 0.232,30.947 0.140,30.854 C0.049,30.761 -0.000,30.636 0.006,30.508 L1.102,8.314 C1.114,8.064 1.328,7.867 1.589,7.867 L6.247,7.867 L6.247,5.547 C6.247,2.488 8.828,-0.000 12.000,-0.000 C15.171,-0.000 17.752,2.488 17.752,5.547 L17.752,7.867 L22.411,7.867 C22.671,7.867 22.886,8.064 22.898,8.314 L23.994,30.508 C24.000,30.636 23.952,30.761 23.860,30.854 ZM16.778,5.547 C16.778,3.007 14.635,0.939 12.000,0.939 C9.364,0.939 7.221,3.007 7.221,5.547 L7.221,7.867 L16.778,7.867 L16.778,5.547 ZM21.947,8.807 L17.752,8.807 L17.752,10.216 C17.752,10.475 17.535,10.685 17.265,10.685 C16.996,10.685 16.778,10.475 16.778,10.216 L16.778,8.807 L7.221,8.807 L7.221,10.216 C7.221,10.475 7.003,10.685 6.734,10.685 C6.465,10.685 6.247,10.475 6.247,10.216 L6.247,8.807 L2.052,8.807 L1.003,30.061 L22.996,30.061 L21.947,8.807 Z"/>
                                                </svg>
                                                    </span>
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>