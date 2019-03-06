@extends('layouts.admin')
@section('content-header')

@stop
@section('content')

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item ">
                <a class="nav-link " id="general-tab" href="{!! route('admin_settings_general') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="general-tab" href="{!! route('admin_settings_accounts') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">Accounts</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link " id="general-tab" href="{!! route('admin_settings_regions') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">Regions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="general-tab" href="{!! route('admin_settings_footer') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">Footer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="general-tab" href="{!! route('admin_settings_tc') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">T&C</a>
            </li>
        </ul>
        <div class="tab-pane fade in" id="admin_settings_regions">


            {!! Form::open(['id'=>'sites']) !!}
            <div class="text-right mb-20 mt20">
                <button type="submit" class="btn btn-info">Save</button>
            </div>
            <div class="panel panel-default site-panel">
                <div class="panel-heading">Site 1</div>
                <div class="panel-body form-horizontal">
                    <div class="mb-20">
                        <table class="table table-responsive table--store-settings" data-table-id="20">
                            <thead>
                            <tr class="bg-info">
                                <th>Language</th>
                                <th>Currency</th>
                                <th>Countries</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody id="regions-list">
                            @if(isset($regions['languages']))
                                @foreach($regions['languages'] as $key=>$language)
                                    <tr>
                                        <td>
                                            {!! Form::select('languages[]',$languages,$language,['class'=>'form-control']) !!}
                                        </td>
                                        <td>
                                            {!! Form::select('currencies[]',$currencies,$regions['currencies'][$key],['class'=>'form-control']) !!}
                                        </td>
                                        <td>
                                            {!! Form::select('countries['.$key.'][]',$countries,isset($regions['countries'][$key])?$regions['countries'][$key]:null,['class'=>'form-control region','multiple']) !!}
                                        </td>
                                        <td colspan="2" class="text-right">
                                            <button type="button" class="btn btn-danger remove-row"><i
                                                        class="fa fa-minus-circle"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr class="add-new-ship-filed-container">
                                <td colspan="6" class="text-right">
                                    <button type="button" class="btn btn-primary add-new-region"><i
                                                class="fa fa-plus-circle"></i></button>
                                </td>
                            </tr>
                            </tfoot>


                        </table>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    <script type="template" id="new-region">
        <tr>
            <td>
                {!! Form::select('languages[]',$languages,null,['class'=>'form-control']) !!}
            </td>
            <td>
                {!! Form::select('currencies[]',$currencies,null,['class'=>'form-control']) !!}
            </td>
            <td>
                {!! Form::select('countries[{count}][]',$countries,null,['class'=>'form-control region','multiple']) !!}

            </td>
            <td colspan="2" class="text-right">
                <button type="button" class="btn btn-danger remove-row"><i class="fa fa-minus-circle"></i></button>
            </td>
        </tr>
    </script>
@stop
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $(function () {
            $('.add-new-region').on('click', function () {
                let html = $('#new-region').html();
                let count=$('body').find('.region').length;
                html=html.replace(/{count}/g,count);
                $('#regions-list').append(html);
                $(".region").select2();
            });
            $('body').on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
            });
            $(".region").select2();
        })
    </script>
@stop