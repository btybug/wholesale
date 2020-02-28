<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{!! env('SITE_NAME','ADMIN') !!}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
{{--{!! Html::style("public/admin_theme/bower_components/bootstrap/dist/css/bootstrap.min.css") !!}--}}
<!-- Bootstrap 4.3.1 -->
{!! Html::style("public/admin_theme/bower_components/bootstrap-4/css/bootstrap.min.css") !!}
<!-- Font Awesome -->
{{--{!! Html::style("public/admin_theme/bower_components/font-awesome/css/font-awesome.min.css") !!}--}}
{!! Html::style("public/admin_theme/fontawesome-5/css/all.min.css") !!}
<!-- Ionicons -->
{!! Html::style("public/admin_theme/bower_components/Ionicons/css/ionicons.min.css") !!}
<!-- Theme style -->
{!! Html::style("public/admin_theme/dist/css/AdminLTE.min.css") !!}
<!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
{!! Html::style("public/admin_theme/dist/css/skins/_all-skins.min.css") !!}
<!-- Morris chart -->
{!! Html::style("public/admin_theme/bower_components/morris.js/morris.css") !!}
<style>
    .loader_text {
        color: #fff;
        font-size: 30px;
        text-align: center;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        position: absolute;
        width: 300px;
        top: 90%;
        left: 50%;
        margin: 0;
    }

    .loader_container {
        position: fixed;
        z-index: 999999999;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        display: none;
    }

    .lds-css {
        margin: 0;
        position: absolute;
        top: 40%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }

    @keyframes lds-spinner {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }
    @-webkit-keyframes lds-spinner {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }
    .lds-spinner {
        position: relative;
    }
    .lds-spinner div {
        left: 95px;
        top: 52px;
        position: absolute;
        -webkit-animation: lds-spinner linear 2s infinite;
        animation: lds-spinner linear 2s infinite;
        background: #fff;
        width: 10px;
        height: 24px;
        border-radius: 174%;
        -webkit-transform-origin: 5px 48px;
        transform-origin: 5px 48px;
    }
    .lds-spinner div:nth-child(1) {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
        -webkit-animation-delay: -1.833333333333333s;
        animation-delay: -1.833333333333333s;
    }
    .lds-spinner div:nth-child(2) {
        -webkit-transform: rotate(30deg);
        transform: rotate(30deg);
        -webkit-animation-delay: -1.666666666666667s;
        animation-delay: -1.666666666666667s;
    }
    .lds-spinner div:nth-child(3) {
        -webkit-transform: rotate(60deg);
        transform: rotate(60deg);
        -webkit-animation-delay: -1.5s;
        animation-delay: -1.5s;
    }
    .lds-spinner div:nth-child(4) {
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg);
        -webkit-animation-delay: -1.333333333333333s;
        animation-delay: -1.333333333333333s;
    }
    .lds-spinner div:nth-child(5) {
        -webkit-transform: rotate(120deg);
        transform: rotate(120deg);
        -webkit-animation-delay: -1.166666666666667s;
        animation-delay: -1.166666666666667s;
    }
    .lds-spinner div:nth-child(6) {
        -webkit-transform: rotate(150deg);
        transform: rotate(150deg);
        -webkit-animation-delay: -1s;
        animation-delay: -1s;
    }
    .lds-spinner div:nth-child(7) {
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
        -webkit-animation-delay: -0.833333333333333s;
        animation-delay: -0.833333333333333s;
    }
    .lds-spinner div:nth-child(8) {
        -webkit-transform: rotate(210deg);
        transform: rotate(210deg);
        -webkit-animation-delay: -0.666666666666667s;
        animation-delay: -0.666666666666667s;
    }
    .lds-spinner div:nth-child(9) {
        -webkit-transform: rotate(240deg);
        transform: rotate(240deg);
        -webkit-animation-delay: -0.5s;
        animation-delay: -0.5s;
    }
    .lds-spinner div:nth-child(10) {
        -webkit-transform: rotate(270deg);
        transform: rotate(270deg);
        -webkit-animation-delay: -0.333333333333333s;
        animation-delay: -0.333333333333333s;
    }
    .lds-spinner div:nth-child(11) {
        -webkit-transform: rotate(300deg);
        transform: rotate(300deg);
        -webkit-animation-delay: -0.166666666666667s;
        animation-delay: -0.166666666666667s;
    }
    .lds-spinner div:nth-child(12) {
        -webkit-transform: rotate(330deg);
        transform: rotate(330deg);
        -webkit-animation-delay: 0s;
        animation-delay: 0s;
    }
    .lds-spinner {
        width: 200px !important;
        height: 200px !important;
        -webkit-transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
        transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
    }
</style>


    <!-- Date Picker -->
{!! Html::style("public/admin_theme/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css") !!}
<!-- Daterange picker -->
{!! Html::style("public/admin_theme/bower_components/bootstrap-daterangepicker/daterangepicker.css") !!}
<!-- bootstrap wysihtml5 - text editor -->
  {!! Html::style("public/admin_theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") !!}
  {!! Html::style("public/plugins/bootstrap-select/bootstrap-select.min.css") !!}

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.css" integrity="sha256-iu+Hq7JHYN0rAeT3Y+c4lEKIskeGgG/MpAyrj6W9iTI=" crossorigin="anonymous" />
  <link rel="stylesheet" href="{{asset('public/admin_assets/css/animate.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin_assets/css/media-tree.css')}}">
  <link rel="stylesheet" href="{{asset('public/js/DataTables/datatables.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin_assets/css/jquery.datetimepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin_assets/css/custom.css?v='.rand(111,999))}}">
  <link rel="stylesheet" href="{{asset('public/css/flag-icon.css')}}">

  <!--Media Button Stiles-->

  @if(is_enabled_media_modal())
    {!! Html::style('public/admin_theme/media/css/styles.css') !!}
    {!! Html::style('public/admin_theme/media/css/style.css') !!}
    {!! Html::style('public/admin_theme/media/css/lightbox.css') !!}
    {!! Html::style('public/admin_theme/fileinput/css/fileinput.min.css') !!}
    {!! Html::style("public/media_template/css/media-plus.css?v='.rand(111,999))") !!}
{{--    {!! Html::style("public/css/jquery.nestable.min.css") !!}--}}
  @endif
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="stylesheet" href="{{asset('public/admin_assets/css/custom.css?v='.rand(111,999))}}">
  <link rel="stylesheet" href="{{asset('public/admin_assets/css/newstyle.css?v='.rand(111,999))}}">
  {{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.30.2/dist/skin-lion/ui.fancytree.min.css">--}}
  @yield('css')

  @stack('style')
</head>
<body class="hold-transition skin-blue">
<div class="loader_container">
    <div class="lds-css ng-scope">
        <div class="lds-spinner" style="width:100%;height:100%"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        <span class="loader_text">Please wait...</span>
    </div>

</div>
<div class="wrapper">

@include('admin._partials.header')
<!-- Left side column. contains the logo and sidebar -->
@include('admin._partials.left_menu')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      @yield('content-header')
    </section>

    <!-- Main content -->
    <section class="content main-content">


      @if(Session::has('alert'))
        <div class="alert alert-messages alert-{!! Session::get('alert.class','success') !!} alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon {!! getAlertIconByClass(Session::get('alert.class')) !!}"></i> Alert!</h4>
          {!! Session::get('alert.message') !!}
        </div>
        {!! Session::forget('alert') !!}
      @endif

      @yield('content')
    </section>

    <!-- /.content -->
  </div>
@if(is_enabled_media_modal())
  @include('media.modal')
@endif

@include('_partials.delete_modal')
<!-- /.content-wrapper -->

  {{--<footer class="main-footer">--}}
    {{--<div class="pull-right hidden-xs">--}}
      {{--<b>Version</b> beta--}}
    {{--</div>--}}
    {{--<strong>Copyright &copy; 2017-{{ date('Y') }} <a href="http://hook.am">HooK LLC</a>.</strong> All rights--}}
    {{--reserved.--}}
  {{--</footer>--}}

  <!-- Control Sidebar -->
{{--@include('admin._partials.right_sidebar')--}}
<!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<script type="template" id="alert-message-box">
  <div class="alert alert-messages alert-{className} alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon {icon}"></i> Alert!</h4>
    {message}
  </div>
</script>
@inject('settings','\App\Models\Settings')
<textarea name="" id="barcode-settings" class="hidden" cols="30" rows="10">{!! $settings->getEditableData('barcodes')->toJson() !!}</textarea>
<!-- ./wrapper -->
{{--<!-- jQuery 3 -->--}}
{!! Html::script("public/admin_theme/bower_components/jquery/dist/jquery.min.js")!!}
{{--<!-- jQuery UI 1.11.4 -->--}}
{!! Html::script("public/admin_theme/bower_components/jquery-ui/jquery-ui.min.js")!!}
<script> $.ajaxSetup({headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}});
</script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sortable/0.9.13/jquery-sortable-min.js"></script>--}}
{{--<script src="http://dev.bootydev.co.uk/resources/assets/js/nestedSortable/jquery.mjs.nestedSortable.js"></script>--}}
{!! Html::script("public/plugins/jquery-migrate/jquery-migrate.js")!!}
{!! Html::script("public/plugins/tree/jquery.mjs.nestedSortable.js")!!}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
{!! Html::script("public/plugins/bootstrap-select/bootstrap-select.min.js")!!}

<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
{{--{!! Html::script("public/admin_theme/bower_components/bootstrap/dist/js/bootstrap.min.js")!!}--}}
<!-- Bootstrap 4.3.1 -->
{!! Html::script("public/admin_theme/bower_components/bootstrap-4/js/bootstrap.bundle.min.js")!!}
<!-- Morris.js charts -->
{!! Html::script("public/admin_theme/bower_components/raphael/raphael.min.js")!!}
{!! Html::script("public/admin_theme/bower_components/morris.js/morris.min.js")!!}
<!-- Sparkline -->
{!! Html::script("public/admin_theme/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js")!!}

<!-- jQuery Knob Chart -->
{!! Html::script("public/admin_theme/bower_components/jquery-knob/dist/jquery.knob.min.js")!!}
<!-- daterangepicker -->
{!! Html::script("public/admin_theme/bower_components/moment/min/moment.min.js")!!}
{!! Html::script("public/admin_theme/bower_components/bootstrap-daterangepicker/daterangepicker.js")!!}
<!-- datepicker -->
{!! Html::script("public/admin_theme/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")!!}
<!-- Bootstrap WYSIHTML5 -->
{!! Html::script("public/admin_theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")!!}
<!-- Slimscroll -->
{!! Html::script("public/admin_theme/bower_components/jquery-slimscroll/jquery.slimscroll.min.js")!!}
<!-- FastClick -->
{!! Html::script("public/admin_theme/bower_components/fastclick/lib/fastclick.js")!!}
<!-- AdminLTE App -->
{!! Html::script("public/admin_theme/dist/js/adminlte.min.js")!!}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE for demo purposes -->
{!! Html::script("public/admin_theme/dist/js/demo.js")!!}


<script src="{{asset('public/js/DataTables/datatables.min.js')}}"></script>

{{--{!! Html::script("public/admin_assets/js/helpers.js")!!}--}}

{!! Html::script("public/admin_assets/js/jquery.datetimepicker.full.min.js")!!}






<!--Media Button JS-->
@if(is_enabled_media_modal())
  <style>
    .close {
      opacity: 1;
    }
  </style>
  <script src="{!! url('public/admin_theme/fileinput/js/fileinput.min.js') !!}"></script>
  <script src="{!! url('public/admin_theme/media/js/lightbox.js') !!}"></script>
  <script src="{!! url('public/admin_theme/media/js/jstree.min.js') !!}"></script>
  <script src="{!! url('public/admin_theme/media/js/custom.js?v='.rand(111,999)) !!}"></script>

@endif
<script>
  window.AjaxCall = function postSendAjax(url, data, success, error) {
    $.ajax({
      type: "post",
      url: url,
      cache: false,
      datatype: "json",
      data: data,
      success: function (data) {
        if (success) {
          success(data);
        }
        return data;
      },
      error: function (errorThrown) {
        if (error) {
          error(errorThrown);
        }
        return errorThrown;
      }
    });
  };

  let openDeleteModal = function ($_this) {
      $('#item_modal_delete_button').attr('data-slug', $_this.data('key')).attr('data-url', $_this.data('href')).attr('callback',$_this.data('callback'));
      if($_this.data('type')){
          $('#delete_item_label').html('Delete ' + $_this.data('type'));
      }
      $('#delete_item').modal('show');
  };

  $('body').on('click', '.delete-button', function () {
      openDeleteModal($(this));
  });

  function xx() {
      alert(555);
  }

  $('body').on('click', '#item_modal_delete_button', function () {
      let item = $(this);
      $.ajax({
          url: item.data('url'),
          type: 'POST',
          dataType: 'JSON',
          data: {
              slug: item.data('slug')
          }
      }).done(function (data) {
          if (! data.error) {
              if (typeof data.url != 'undefined') {
                  window.location.href = data.url;
              }
              if(data.callback){
                  eval(item.attr('callback'))
                  $('#delete_item').modal('hide');
              }else{
                  location.reload();
              }

          }
      }).fail(function (data) {
          alert('Could not delete item. Please try again.');
      });
  });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.0/JsBarcode.all.min.js" integrity="sha256-BjqnfACYltVzhRtGNR2C4jB9NAN0WxxzECeje7/XpwE=" crossorigin="anonymous"></script>
<script src="{{url('public/js/saveSvgAsPng.js')}}"></script>
<script src="{{url('public/js/selectProductModal.js')}}"></script>
<script src="{{url('public/js/permitions.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.js" integrity="sha256-DQMtbH0EZgaw6tLtBLk8KW50A7ouiB4oc8+hwuienog=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.js" integrity="sha256-m4GLhtBF1Ue31vdmii9AEzvSYnBTJFzYkVToaD047Z4=" crossorigin="anonymous"></script>

@yield('js')
@stack('javascript')
<script src="{{asset('public/admin_assets/js/custom.js')}}"></script>
</body>
</html>
