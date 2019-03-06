@extends('layouts.frontend')
@section('content')
    <main class="main-content">
        <div class="d-flex h-100">
            <div class="main-left-tabs d-flex flex-column kaliony-menu">
                <div class="nav flex-column justify-content-center nav-pills" id="v-pills-tab" role="tablist"
                     aria-orientation="vertical">
                    <a class="nav-link active d-flex flex-column align-items-center text-center"
                       id="v-pills-product-tab"
                       data-toggle="pill"
                       href="#v-pills-product" role="tab" aria-controls="v-pills-hit" aria-selected="true">
                        <span class="name">Kaliony</span></a>
                    <a class="nav-link d-flex flex-column align-items-center text-center" id="v-pills-product-tab"
                       data-toggle="pill"
                       href="#v-pills-sales" role="tab" aria-controls="v-pills-sales" aria-selected="true">
                        <span class="name">Hot Sales</span></a>
                </div>

                <div class="user-status mt-auto">
                    <span class="status-color"></span>
                    <div class="user d-flex flex-column align-items-center">
                        <svg width="42px" height="41px">
                            <path fill-rule="evenodd" opacity="0.8" fill="rgb(240, 240, 240)"
                                  d="M39.150,33.633 C35.126,31.496 32.040,30.298 29.293,29.839 L29.577,29.447 C29.712,29.312 29.780,29.110 29.712,28.907 L29.081,26.377 C29.309,26.052 29.525,25.717 29.728,25.373 C32.240,24.516 33.510,23.069 33.724,20.938 C34.827,20.881 35.779,19.894 35.779,18.781 L35.779,13.717 C35.779,12.609 34.899,11.626 33.745,11.561 C33.597,7.661 31.880,0.013 20.949,0.013 C10.018,0.013 8.301,7.661 8.153,11.561 C7.059,11.626 6.119,12.546 6.119,13.717 L6.119,18.781 C6.119,19.928 7.130,20.941 8.343,20.941 L9.354,20.941 C9.726,20.941 10.083,20.834 10.394,20.651 C10.777,22.683 11.620,24.682 12.817,26.376 L12.186,28.907 C12.186,29.042 12.186,29.245 12.321,29.447 L12.605,29.839 C9.858,30.298 6.772,31.496 2.748,33.633 C1.468,34.240 0.726,35.523 0.726,36.941 L0.726,39.844 C0.726,40.249 0.996,40.519 1.400,40.519 L17.578,40.519 L17.848,40.519 L24.050,40.519 L24.319,40.519 L40.498,40.519 C40.902,40.519 41.172,40.249 41.172,39.844 L41.172,36.941 C41.172,35.591 40.363,34.308 39.150,33.633 ZM20.953,32.089 L22.567,35.793 L19.309,35.793 L20.953,32.089 ZM18.819,37.143 L23.077,37.143 L23.471,39.169 L18.414,39.169 L18.819,37.143 ZM28.027,27.692 L28.297,28.907 L27.608,29.854 C27.564,29.890 27.523,29.934 27.488,29.987 L24.684,33.876 L23.794,35.099 L21.977,31.004 C24.193,30.733 26.167,29.602 27.750,27.981 C27.843,27.886 27.936,27.790 28.027,27.692 ZM30.659,23.492 C31.039,22.566 31.326,21.603 31.507,20.632 C31.764,20.788 32.056,20.892 32.371,20.927 C32.254,21.881 31.831,22.782 30.659,23.492 ZM34.363,13.650 L34.363,18.713 C34.363,19.118 34.026,19.523 33.555,19.523 L32.543,19.523 C32.139,19.523 31.734,19.186 31.734,18.713 L31.734,18.240 L31.734,13.650 C31.734,13.245 32.072,12.840 32.543,12.840 L33.555,12.840 C33.959,12.840 34.363,13.177 34.363,13.650 ZM20.949,1.363 C25.104,1.363 32.097,2.721 32.397,11.568 C32.115,11.597 31.844,11.683 31.600,11.815 C30.779,6.674 26.304,2.713 20.949,2.713 C15.595,2.713 11.120,6.673 10.299,11.813 C10.058,11.682 9.788,11.596 9.501,11.568 C9.801,2.721 16.794,1.363 20.949,1.363 ZM10.096,18.713 C10.096,19.118 9.759,19.523 9.287,19.523 L8.276,19.523 C7.871,19.523 7.467,19.186 7.467,18.713 L7.467,13.650 C7.467,13.245 7.804,12.840 8.276,12.840 L9.287,12.840 C9.692,12.840 10.096,13.177 10.096,13.650 L10.096,18.713 ZM11.512,13.515 C11.512,8.316 15.758,4.063 20.949,4.063 C26.140,4.063 30.386,8.316 30.386,13.515 L30.386,18.240 C30.386,20.474 29.806,22.519 28.864,24.244 C27.255,24.712 24.941,24.991 21.623,24.991 C21.219,24.991 20.949,25.262 20.949,25.667 C20.949,26.072 21.219,26.342 21.623,26.342 C24.052,26.342 26.083,26.192 27.747,25.880 C27.705,25.921 27.664,25.963 27.623,26.004 C27.283,26.457 26.926,26.870 26.552,27.242 C24.964,28.723 23.071,29.620 21.247,29.709 C21.155,29.670 21.052,29.650 20.949,29.650 C20.845,29.650 20.752,29.670 20.668,29.710 C19.552,29.659 18.409,29.304 17.325,28.698 C16.228,28.066 15.196,27.156 14.275,26.004 C14.208,25.937 14.141,25.869 14.073,25.802 L14.034,25.788 C12.520,23.800 11.512,21.184 11.512,18.240 L11.512,13.515 L11.512,13.515 ZM19.921,31.004 L18.104,35.099 L17.214,33.876 L14.410,29.987 C14.389,29.966 14.365,29.945 14.340,29.924 L13.601,28.907 L13.871,27.692 C13.962,27.790 14.055,27.886 14.148,27.981 C15.731,29.602 17.705,30.733 19.921,31.004 ZM2.074,36.941 C2.074,36.063 2.546,35.253 3.355,34.848 C7.652,32.562 10.745,31.415 13.500,31.072 L17.523,36.611 L17.012,39.169 L2.074,39.169 L2.074,36.941 ZM39.824,39.169 L24.886,39.169 L24.375,36.611 L28.441,31.012 C31.187,31.427 34.336,32.573 38.543,34.781 C39.352,35.253 39.824,36.063 39.824,36.941 L39.824,39.169 L39.824,39.169 Z"/>
                        </svg>
                        <span class="status">Online</span>
                    </div>
                </div>

            </div>

            <div class="main-right-wrapp d-flex flex-wrap">
                <div class="tab-content h-100 w-100" id="v-pills-tabContent">
                    <div class="tab-pane h-100 fade show active" id="v-pills-product" role="tabpanel"
                         aria-labelledby="v-pills-product-tab">
                        <div class="sliders home-sliders">
                            <div class="carousel_1">
                                <div>
                                    <div class="info p-0 m-0 slider-logo w-100">
                                        <img src="/public/img/header-logo.png" class="header-logo-img" alt="">
                                        <img src="/public/img/header-logo-text.png" class="header-logo-text-img" alt="">
                                    </div>
                                    <img src="/public/img/temp/homepage-bg.jpg" alt="">
                                </div>
                                <div>
                                    <div class="info">
                                        <span class="title">
                                        THE BEST VAPE
                                    </span>
                                    </div>
                                    <img src="http://resourcemagonline.com/wp-content/uploads/2015/01/smoke-photo.jpg"
                                         alt="">
                                </div>
                                <div><img src="/public/img/temp/homepage-bg.jpg" alt=""></div>
                            </div>

                            <div class="carousel_2" data-carousel-controller-for=".carousel_1">
                                <div><img src="/public/img/temp/homepage-bg.jpg" alt=""></div>
                                <div><img src="http://resourcemagonline.com/wp-content/uploads/2015/01/smoke-photo.jpg"
                                          alt=""></div>
                                <div><img src="/public/img/temp/homepage-bg.jpg" alt=""></div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane h-100 fade" id="v-pills-sales" role="tabpanel"
                         aria-labelledby="v-pills-product-tab">
                        <div class="container p-4">
                            <h2 class="mb-5 text-center">Here are our Hot Sales Products</h2>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <img class="card-img-top" src="/public/img/temp/product-1.jpg"
                                             alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">Product title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and
                                                make up the bulk of the card's content.</p>
                                            <a href="#" class="btn bg-cl-red text-white">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <img class="card-img-top" src="/public/img/temp/product-1.jpg"
                                             alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">Product title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and
                                                make up the bulk of the card's content.</p>
                                            <a href="#" class="btn bg-cl-red text-white">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <img class="card-img-top" src="/public/img/temp/product-1.jpg"
                                             alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">Product title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and
                                                make up the bulk of the card's content.</p>
                                            <a href="#" class="btn bg-cl-red text-white">Checkout</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>


                </div>
            </div>

        </div>

    </main>
@stop

@section('css')
    <link href="/public/plugins/formstone/carousel/carousel.css" rel="stylesheet">
    <link href="/public/css/carousel.css" rel="stylesheet">

@stop

@section('js')

    <script src={{asset("public/js/bundle/carousel.js")}}></script>

@stop
