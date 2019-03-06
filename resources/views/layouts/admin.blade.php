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
{!! Html::style("public/admin_theme/bower_components/bootstrap/dist/css/bootstrap.min.css") !!}
<!-- Font Awesome -->
{!! Html::style("public/admin_theme/bower_components/font-awesome/css/font-awesome.min.css") !!}
<!-- Ionicons -->
{!! Html::style("public/admin_theme/bower_components/Ionicons/css/ionicons.min.css") !!}
<!-- Theme style -->
{!! Html::style("public/admin_theme/dist/css/AdminLTE.min.css") !!}
<!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
{!! Html::style("public/admin_theme/dist/css/skins/_all-skins.min.css") !!}
<!-- Morris chart -->
{!! Html::style("public/admin_theme/bower_components/morris.js/morris.css") !!}



<!-- Date Picker -->
{!! Html::style("public/admin_theme/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css") !!}
<!-- Daterange picker -->
{!! Html::style("public/admin_theme/bower_components/bootstrap-daterangepicker/daterangepicker.css") !!}
<!-- bootstrap wysihtml5 - text editor -->
  {!! Html::style("public/admin_theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") !!}


  <link rel="stylesheet" href="{{asset('public/admin_assets/css/animate.css')}}">
  <link rel="stylesheet" href="{{asset('public/js/DataTables/datatables.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin_assets/css/jquery.datetimepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin_assets/css/custom.csscustom.css?v='.rand(111,999))}}">
  <link rel="stylesheet" href="{{asset('public/css/flag-icon.css')}}">



  <!--Media Button Stiles-->

  @if(is_enabled_media_modal())
    {!! Html::style('public/admin_theme/media/css/styles.css') !!}
    {!! Html::style('public/admin_theme/media/css/style.css') !!}
    {!! Html::style('public/admin_theme/media/css/lightbox.css') !!}
    {!! Html::style('public/admin_theme/fileinput/css/fileinput.min.css') !!}
    {!! Html::style("public/media_template/css/media-plus.css?v='.rand(111,999))") !!}
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.30.2/dist/skin-lion/ui.fancytree.min.css">
  @yield('css')

  @stack('style')
</head>
<body class="hold-transition skin-blue">
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
<!-- ./wrapper -->
{{--<!-- jQuery 3 -->--}}
{!! Html::script("public/admin_theme/bower_components/jquery/dist/jquery.min.js")!!}
{{--<!-- jQuery UI 1.11.4 -->--}}
{!! Html::script("public/admin_theme/bower_components/jquery-ui/jquery-ui.min.js")!!}
{!! Html::script("public/plugins/jquery-migrate/jquery-migrate.js")!!}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->


<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
{!! Html::script("public/admin_theme/bower_components/bootstrap/dist/js/bootstrap.min.js")!!}
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
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
      headers: {
        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
      },
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
          headers: {
              'X-CSRF-TOKEN': $("input[name='_token']").val()
          },
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


@yield('js')
@stack('javascript')
<script src="{{asset('public/admin_assets/js/custom.js')}}"></script>
</body>
</html>
