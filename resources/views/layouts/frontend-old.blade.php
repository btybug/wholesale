<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <title>Document</title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href={{asset("public/frontend/css/bootstrap.min.css")}} rel="stylesheet" />
    <link href={{asset("public/frontend/css/font-awesome.min.css")}} rel="stylesheet" />
    <link href={{asset("public/css/fonts.css?v=".rand(111,999))}} rel="stylesheet" />
    <link href={{asset("public/css/main.css?v=".rand(111,999))}} rel="stylesheet" />
    {{--<link href="{{'/public'.mix('comments.css', 'vendor/comments')->toHtml() }}" rel="stylesheet">--}}
    {{----}}
    <link rel="stylesheet" href="{{asset('public/css/flag-icon.css')}}">

    <script src={{asset("public/js/jQuery3.3.1.js")}}></script>
    <!--[if lt IE 9]>
    <script src={{asset("public/plugins/crossbrowserjs/html5shiv.js")}}></script>
    <script src={{asset("public/plugins/crossbrowserjs/respond.min.js")}}></script>
    <![endif]-->
    <!--[if !IE]><!-->
    <script src={{asset("public/plugins/crossbrowserjs/ofi.min.js")}}></script>
    <script src={{asset("public/plugins/crossbrowserjs/customFit.js")}}></script>
    <!--<![endif]-->
    <script src={{asset("public/js/bootstrap.bundle.min.js")}}></script>
    @if(!Auth::check())
        <script src={{asset("public/js/adult.js")}}></script>
        @endif
    @yield('css')


    {{--<script src="{{ '/public'.mix('comments.js', 'vendor/comments')->toHtml() }}"></script>--}}

</head>
<body>
@include('frontend._partials.header')
@include('cookieConsent::index')
@yield('content')
<div class="modal fade modal-request" id="msgModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
                <button type="button" class="close d-flex justify-content-center align-items-center" data-dismiss="modal">&times;</button>
                <span class="message-place">Do you want request ?</span>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="close btn btn-success btn-block" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<img src="/public/images/loader.gif"  class="loader-img d-none" style="width:100px;position: absolute;top:50%;left:50%"/>

<script src={{asset("public/js/main.js")}}></script>
<script>
    window.AjaxCall = function postSendAjax(url, data, success, error) {
        $.ajax({
            type: "post",
            url: url,
            cache: false,
            datatype: "json",
            data: data,
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },
            success: function(data) {
                if (success) {
                    success(data);
                }
                return data;
            },
            error: function(errorThrown) {
                if (error) {
                    error(errorThrown);
                }
                return errorThrown;
            }
        });
    };

    $(document).ready(function () {
        $("body").on('click','.qtycount',function () {
            var uid = $(this).data('uid');
            var condition = $(this).data('condition');
            if(uid && uid != ''){
                $.ajax({
                    type: "post",
                    url: "/update-cart",
                    cache: false,
                    datatype: "json",
                    data: {  uid : uid, condition: condition },
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function(data) {
                        if(! data.error){
                            $('.cart-area').html(data.html)
                            $('#cartSidebar').html(data.headerHtml)
                        }else{
                            alert('error')
                        }
                    }
                });
            }else{
                alert('Select available variation');
            }
        });

        $("body").on('change', '.qty-input' ,function () {
            var uid = $(this).data('uid');
            var condition = 'inner';
            var value = $(this).val();
            if(uid && uid != ''){
                $.ajax({
                    type: "post",
                    url: "/update-cart",
                    cache: false,
                    datatype: "json",
                    data: {  uid : uid, condition: condition,value :value },
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function(data) {
                        if(! data.error){
                            $('.cart-area').html(data.html)
                            $('#cartSidebar').html(data.headerHtml)
                        }else{
                            alert('error')
                        }
                    }
                });
            }else{
                alert('Select available variation');
            }
        });


        $("body").on('click','.remove-from-cart',function () {
            var uid = $(this).data('uid');
            console.log(uid,454545);
            if(uid && uid != ''){
                $.ajax({
                    type: "post",
                    url: "/remove-from-cart",
                    cache: false,
                    datatype: "json",
                    data: {  uid : uid },
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function(data) {
                        if(! data.error){
                            $('.cart-area').html(data.html)
                            $('#cartSidebar').html(data.headerHtml)
                            $(".cart-count").html(data.count)
                        }else{
                            alert('error')
                        }
                    }
                });
            }else{
                alert('Select available variation');
            }
        })
    });
</script>
@yield('js')
</body>
</html>