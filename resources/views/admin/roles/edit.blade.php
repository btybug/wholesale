@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="row">
    {!! Form::model($role) !!}
    {!! Form::hidden('id') !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="m-0">Create Role</h2>
        </div>

    <!-- Button -->
        <div class="form-group row">
            <div class="col-sm-12 text-right pull-right">
                <button id="singlebutton" class="btn btn-info save-role">Save</button>
            </div>
        </div>
        <div class="panel-body">

            <div class="col-md-4">
                <div class="row">
                    <!-- Password input-->
                    <div class="form-group row">
                        <label class="col-md-2" for="passwordinput">Title</label>
                        <div class="col-md-10">
                            {!! Form::text('title',null,['class'=>'form-control input-md']) !!}
                        </div>
                    </div>
                    <!-- Password input-->
                    <div class="form-group row">
                        <label class="col-md-2" for="passwordinput">Type</label>
                        <div class="col-md-10">
                            {!! Form::select('type',['backend'=>'Admin Panel','frontend'=>'Front Site'],null,['class'=>'form-control input-md']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="passwordinput">Description</label>
                        <div class="col-md-10">
                            {!! Form::textarea('description',null,['class'=>'form-control input-md']) !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>

        </div>
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <h3 class="panel-heading m-0">Widgets</h3>
                    <div class="panel-body">
                        @include('admin.roles._partials.widgets')
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <h3 class="panel-heading m-0">Pages</h3>
                    <div class="panel-body">
                        @include('admin.roles._partials.tree')
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop

@section("css")
    <link rel="stylesheet" href="http://laraframe.codemen.org/backend/assets/css/admin_lte.css">
    <link rel="stylesheet" href="http://laraframe.codemen.org/common/vendors/iCheck/flat/_all.css">

    <style>
        .panel-create-role .panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .no-padding {
            padding: 0px;
        }

        .glyphicon-icon-rpad .glyphicon, .glyphicon-icon-rpad .glyphicon.m8, .fa-icon-rpad .fa, .fa-icon-rpad .fa.m8 {
            padding-right: 8px;
        }

        .glyphicon-icon-lpad .glyphicon, .glyphicon-icon-lpad .glyphicon.m8, .fa-icon-lpad .fa, .fa-icon-lpad .fa.m8 {
            padding-left: 8px;
        }

        .glyphicon-icon-rpad .glyphicon.m5, .fa-icon-rpad .fa.m5 {
            padding-right: 5px;
        }

        .glyphicon-icon-lpad .glyphicon.m5, .fa-icon-lpad .fa.m5 {
            padding-left: 5px;
        }

        .glyphicon-icon-rpad .glyphicon.m12, .fa-icon-rpad .fa.m12 {
            padding-right: 12px;
        }

        .glyphicon-icon-lpad .glyphicon.m12, .fa-icon-lpad .fa.m12 {
            padding-left: 12px;
        }

        .glyphicon-icon-rpad .glyphicon.m15, .fa-icon-rpad .fa.m15 {
            padding-right: 15px;
        }

        .glyphicon-icon-lpad .glyphicon.m15, .fa-icon-lpad .fa.m15 {
            padding-left: 15px;
        }

        ul.nav-menu-list-style .nav-header .menu-collapsible-icon {
            position: absolute;
            right: 3px;
            top: 16px;
            font-size: 9px;
        }

        ul.nav-menu-list-style {
            margin: 0;
        }

        .nav-menu-wrap {
            display: flex;
            align-items: center;
        }

        .nav-menu-wrap > label {
            margin-left: 5px;
        }

        .nav-menu-wrap + ul > li {
            display: flex;
            align-items: center;
        }

        .nav-menu-wrap + ul {
            margin-left: 25px;
        }

        ul.nav-menu-list-style .nav-header {
            border-top: 1px solid #FFFFFF;
            border-bottom: 1px solid #e8e8e8;
            display: block;
            margin: 0;
            line-height: 42px;
            padding: 0 8px;
            font-weight: 600;
        }

        ul.nav-menu-list-style > li {
            position: relative;
        }

        ul.nav-menu-list-style > li a {
            border-top: 1px solid #FFFFFF;
            border-bottom: 1px solid #e8e8e8;
            padding: 0 10px;
            line-height: 32px;
        }

        ul.nav-menu-list-style > li:first-child a {
        }

        ul.nav-menu-list-style {
            list-style: none;
            padding: 0px;
            margin: 0px;
        }

        ul.nav-menu-list-style li .badge, ul.nav-menu-list-style li .pull-right, ul.nav-menu-list-style li span.badge, ul.nav-menu-list-style li label.badge {
            float: right;
            margin-top: 7px;
        }

        ul.bullets {
            list-style: inside disc
        }

        ul.numerics {
            list-style: inside decimal
        }

        .ul.kas-icon-aero {
        }

        ul.kas-icon-aero li a:before {
            font-family: 'Glyphicons Halflings';
            font-size: 9px;
            content: "\e258";
            padding-right: 8px;
        }


    </style>
@stop


@section('js')
    <script>
        $('.tree-toggle').click(function () {
            $(this).parent().children('ul.tree').toggle(200);
        });
        $(function () {
            $('.tree-toggle').parent().children('ul.tree').toggle(200);
        })
    </script>
@stop