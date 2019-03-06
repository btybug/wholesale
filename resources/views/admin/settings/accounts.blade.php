@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    {!! Form::open() !!}
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        @ok('admin_settings_general')
        <li class="nav-item ">
            <a class="nav-link " id="info-tab" href="{!! route('admin_settings_general') !!}" role="tab"
               aria-controls="general" aria-selected="true" aria-expanded="true">Info</a>
        </li>
        @endok
        @ok('admin_settings_accounts')
        <li class="nav-item active">
            <a class="nav-link " id="general-tab" href="{!! route('admin_settings_accounts') !!}" role="tab"
               aria-controls="accounts" aria-selected="true" aria-expanded="true">Accounts</a>
        </li>
        @endok
        @ok('admin_settings_footer')
        <li class="nav-item">
            <a class="nav-link " id="general-tab" href="{!! route('admin_settings_footer') !!}" role="tab"
               aria-controls="general" aria-selected="true" aria-expanded="true">Footer</a>
        </li>
        @endok
        @ok('admin_settings_tc')
        <li class="nav-item">
            <a class="nav-link " id="general-tab" href="{!! route('admin_settings_tc') !!}" role="tab"
               aria-controls="general" aria-selected="true" aria-expanded="true">T&C</a>
        </li>
        @endok
        @ok('admin_settings_connections')
        <li class="nav-item">
            <a class="nav-link " id="general-tab" href="{!! route('admin_settings_connections') !!}" role="tab"
               aria-controls="general" aria-selected="true" aria-expanded="true">Connections</a>
        </li>
        @endok
        @ok('admin_settings_about_us')
        <li class="nav-item active">
            <a class="nav-link " id="general-tab" href="{!! route('admin_settings_about_us') !!}" role="tab"
               aria-controls="general" aria-selected="true" aria-expanded="true">About us</a>
        </li>
        @endok
    </ul>
    <div class="tab-pane fade in" id="admin_settings_accounts">
        <div class="text-right mb-20 mt20">
            <button type="submit" class="btn btn-info">Save</button>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Sending Email
            </div>
            <div class="panel-body">
                <div class="col-md-9">
                    <table class="table froms-table">
                        @if($froms->count())
                            @foreach($froms as $key=>$from)
                                <tr>
                                    <td>
                                        <label for="sendingEmail">E-Mail Address</label>

                                    </td>
                                    <td>
                                        {!! Form::hidden('old['.$from->id.'][type]','from') !!}
                                        <input  type="text" name="old[{!!$from->id!!}][email]" class="form-control" value="{!! $from->email !!}"
                                                aria-describedby="sendingEmail" placeholder="Enter E-Mail Address">
                                    </td>
                                    <td>
                                        <label for="sendingEmailDesc">Description</label>

                                    </td>
                                    <td>
                        <textarea rows="5" class="form-control" name="old[{!!$from->id!!}][description]"
                                  aria-describedby="sendingEmailDesc"
                                  placeholder="Enter Description">{!!$from->description!!}</textarea>
                                    </td>
                                    <td>
                                        @if(count($froms)!=$key+1)
                                            <button type="button" class="btn pull-right remove-line btn-danger delete"><i class="fa fa-minus"></i></button>
                                        @else
                                            <button type="button" class="btn btn-primary pull-right add-more-from"><i
                                                        class="fa fa-plus"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                    <label for="sendingEmail">E-Mail Address</label>

                                </td>
                                <td>
                                    {!! Form::hidden('new[0][type]','from') !!}
                                    <input name="new[0][email]" type="text" class="form-control" id="sendingEmail"
                                           aria-describedby="sendingEmail" placeholder="Enter E-Mail Address">
                                </td>
                                <td>
                                    <label for="sendingEmailDesc">Description</label>

                                </td>
                                <td>
                        <textarea rows="5" class="form-control" name="new[0][description]"
                                  aria-describedby="sendingEmailDesc"
                                  placeholder="Enter Description"></textarea>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary pull-right add-more-from"><i
                                                class="fa fa-plus"></i></button>
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Reseiving Emails</div>
            <div class="panel-body">
                <div class="col-md-9">
                    <table class="table table-to">
                        @if($tos->count())
                            @foreach($tos as $k=>$to)
                                <tr>
                                    <td>
                                        <label for="sendingEmail">E-Mail Address</label>

                                    </td>
                                    <td>
                                        {!! Form::hidden('old['.$to->id.'][type]','to') !!}
                                        <input type="text" name="old[{!!$to->id!!}][email]" class="form-control" value="{!! $to->email !!}"
                                               aria-describedby="sendingEmail" placeholder="Enter E-Mail Address">
                                    </td>
                                    <td>
                                        <label for="sendingEmailDesc">Description</label>

                                    </td>
                                    <td>
                        <textarea rows="5" class="form-control" name="old[{!!$to->id!!}][description]"
                                  aria-describedby="sendingEmailDesc"
                                  placeholder="Enter Description">{!!$to->description!!}</textarea>
                                    </td>
                                    <td>
                                        @if(count($tos)!=$k+1)
                                            <button type="button" class="btn pull-right remove-line btn-danger delete"><i class="fa fa-minus"></i></button>
                                        @else
                                            <button type="button" class="btn btn-primary pull-right add-more-too"><i
                                                        class="fa fa-plus"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                    <label for="sendingEmail">E-Mail Address</label>

                                </td>
                                <td>
                                    {!! Form::hidden('new_to[0][type]','to') !!}
                                    <input name="new_to[0][email]" type="text" class="form-control" id="sendingEmail"
                                           aria-describedby="sendingEmail" placeholder="Enter E-Mail Address">
                                </td>
                                <td>
                                    <label for="sendingEmailDesc">Description</label>

                                </td>
                                <td>
                        <textarea rows="5" class="form-control" name="new_to[0][description]"
                                  aria-describedby="sendingEmailDesc"
                                  placeholder="Enter Description"></textarea>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary pull-right add-more-too"><i
                                                class="fa fa-plus"></i></button>
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@stop
@section('js')
    <script>
        var fcount=1;
        var tcount=1;
        $(function () {
            $('body').on('click', '.add-more-from', function () {
                $(this).removeClass('add-more-from').addClass('remove-line');
                $(this).removeClass('btn-primary').addClass('btn-danger delete');
                $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
                let html = `<tr><td><label for="sendingEmail">E-Mail Address</label>
                    </td><td><input type="hidden" name="new[${fcount}][type]" value="from">
                    <input name="new[${fcount}][email]" type="text" class="form-control" id="sendingEmail" aria-describedby="sendingEmail" placeholder="Enter E-Mail Address">
                    </td><td><label for="sendingEmailDesc">Description</label></td> <td>
                    <textarea rows="5" class="form-control" name="new[${fcount}][description]" aria-describedby="sendingEmailDesc" placeholder="Enter Description"></textarea>
                    </td><td><button type="button" class="btn btn-primary pull-right add-more-from"><i class="fa fa-plus"></i></button> </td></tr>`;
                $('.froms-table').append(html);
                fcount++;
            })
            $('body').on('click', '.add-more-too', function () {
                $(this).removeClass('add-more-from').addClass('remove-line');
                $(this).removeClass('btn-primary').addClass('btn-danger delete');
                $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
                let html = `<tr><td><label for="sendingEmail">E-Mail Address</label>
                    </td><td><input type="hidden" name="new_to[${tcount}][type]" value="to">
                    <input name="new_to[${tcount}][email]" type="text" class="form-control"  aria-describedby="sendingEmail" placeholder="Enter E-Mail Address">
                    </td><td><label for="sendingEmailDesc">Description</label></td> <td>
                    <textarea rows="5" class="form-control" name="new_to[${tcount}][description]" aria-describedby="sendingEmailDesc" placeholder="Enter Description"></textarea>
                    </td><td><button type="button" class="btn btn-primary pull-right  add-more-too"><i class="fa fa-plus"></i></button> </td></tr>`;
                $('.table-to').append(html)
                tcount++;
            })
            $('body').on('click','.delete',function () {
                $(this).closest('tr').remove();
            })
        })
    </script>
@stop