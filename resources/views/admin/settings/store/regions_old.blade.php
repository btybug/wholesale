@extends('layouts.admin')
@section('content-header')

@stop
@section('content')

    <div class="container-fluid">
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
        </ul>
        <div class="tab-pane fade in" id="admin_settings_regions">


            {!! Form::open(['id'=>'sites']) !!}
            <button type="submit" class="btn btn-success">Save</button>
            <div class="panel panel-default site-panel">
                <div class="panel-heading">Site 1</div>
                <div class="panel-body form-horizontal">
                    {{--top 3 inputs--}}
                    <div class="row mb-20">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="siteName" class="col-sm-3 text-right">Site Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="1[site_name]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="siteLink" class="col-sm-3 text-right">Site Link</label>
                                <div class="col-sm-9">
                                    <input type="text" name="1[site_link]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="icon" class="col-sm-3 text-right">Icon</label>
                                <div class="col-sm-9">
                                    <input type="text" name="1[site_icon]" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>

                    {{--languages--}}
                    <div class="mb-20 languages">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="languages" class="col-sm-3 text-right">Languages</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="1[languages][0]" class="form-control languages-1">
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-primary add-more-language">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--currency--}}
                    <div class="mb-20 currency">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="currency" class="col-sm-3 text-right">Currency</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="1[currency][0]" class="form-control currency-1">
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-primary add-more-currency">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-20">
                            <table class="table table-responsive table--store-settings" data-table-id="20">

                                <tbody>

                                <tr class="bg-my-light-pink">
                                    <th>Language</th>
                                    <th>Currency</th>
                                    <th>Countries</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="form-control" name="">
                                            <option value="1" selected="selected">RUS</option>
                                            <option value="2">AM</option>
                                            <option value="3">FR</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="">
                                            <option value="1" selected="selected">USD</option>
                                            <option value="2">GBP</option>
                                            <option value="3">AMD</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input class="form-control"  name="" type="text" >

                                    </td>
                                    <td colspan="2" class="text-right">
                                        <button type="button" class="btn btn-danger remove-ship-filed"><i class="fa fa-minus-circle"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="form-control" name="">
                                            <option value="1">RUS</option>
                                            <option value="2" selected="selected">AM</option>
                                            <option value="3">FR</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="">
                                            <option value="1" selected="selected">USD</option>
                                            <option value="2">GBP</option>
                                            <option value="3">AMD</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input class="form-control"  name="" type="text" >
                                    </td>
                                    <td colspan="2" class="text-right">
                                        <button type="button" class="btn btn-danger remove-ship-filed"><i class="fa fa-minus-circle"></i></button>
                                    </td>
                                </tr>
                                <tr class="add-new-ship-filed-container">
                                    <td colspan="6" class="text-right">
                                        <button type="button" data-id="2" data-options-count="6" data-exists="true" class="btn btn-primary add-new-ship-filed"><i class="fa fa-plus-circle"></i></button>
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
            {{--add new item btn--}}
            <div class="text-right">
                <button class="btn btn-primary" id="add-new-panel"><i class="fa fa-plus"></i>&nbsp;Add new item</button>
            </div>
        </div>

    </div>
    <script type="template" id="language">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <div class="col-sm-7 col-sm-offset-3">
                        <input type="text" name="{p}[languages][{l}]" class="form-control languages-{p}">
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-danger">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
</script>
    <script type="template" id="currency">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <div class="col-sm-7 col-sm-offset-3">
                        <input type="text" name="{p}[currency][{c}]" class="form-control currency-{p}">
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-danger">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
</script>
    <script type="template" id="site-form">
        <div class="panel panel-default site-panel">
            <div class="panel-heading">Site {p}</div>
            <div class="panel-body form-horizontal">
                {{--top 3 inputs--}}
                <div class="row mb-20">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="siteName"  class="col-sm-3 text-right">Site Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="{p}[site_name]" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="siteLink"  class="col-sm-3 text-right">Site Link</label>
                            <div class="col-sm-9">
                                <input type="text" name="{p}[site_link]" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="icon"  class="col-sm-3 text-right">Icon</label>
                            <div class="col-sm-9">
                                <input type="text" name="{p}[site_icon]" class="form-control">
                            </div>
                        </div>
                    </div>

                </div>

                {{--languages--}}
                <div class="mb-20 languages">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="languages" class="col-sm-3 text-right">Languages</label>
                                <div class="col-sm-7">
                                    <input type="text"  name="{p}[languages][0]" class="form-control languages-{p}">
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" data-p="{p}" class="btn btn-primary add-more-language">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                {{--currency--}}
                <div class="mb-20 currency">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="currency" class="col-sm-3 text-right">Currency</label>
                                <div class="col-sm-7">
                                    <input type="text" name="{p}[currency][0]" class="form-control currency-{p}">
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" data-p="{p}" class="btn btn-primary add-more-currency">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </script>
@stop
@section('js')
    <script>
        $(function () {
        var p=$('.site-panel').length;
        console.log(p)
            $('#add-new-panel').on('click', function () {
                let html = $('#site-form').html();
                p++;
                html= html.replace(/{p}/g,p);
                $('#sites').append(html);
            });
            $('body').on('click','.add-more-language',function () {
                let html = $('#language').html();
                let data_p=$(this).attr('data-p');
                let lang=$('.languages-'+data_p).length+1;
                html= html.replace(/{p}/g,data_p).replace(/{l}/g,lang);
                $(this).closest('.languages').append(html) ;
            });
            $('body').on('click','.add-more-currency',function () {
                let html = $('#currency').html();
                let data_p=$(this).attr('data-p');
                let currency=$('.currency-'+data_p).length+1;
                html= html.replace(/{p}/g,data_p).replace(/{c}/g,currency);
                $(this).closest('.currency').append(html) ;
            });
        })
    </script>
@stop