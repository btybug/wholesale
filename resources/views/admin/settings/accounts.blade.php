@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    {!! Form::open() !!}
    @include("admin.settings._partials.menu",['active' => 'accounts'])


    <div class="tab-pane fade in show" id="admin_settings_accounts">
        <div class="text-right mb-20 mt20">
            <button type="submit" class="btn btn-info">Save</button>
        </div>
        <div class="card panel panel-default mb-3">
            <div class="card-header panel-heading">
                Sending Email
            </div>
            <div class="card-body panel-body">
                <div class="row">
                    <div class="col-xl-9">
                        <div class="table-responsive">
                            <table class="table froms-table">
                                @if($froms->count())
                                    @foreach($froms as $key=>$from)
                                        <tr>
                                            <td>
                                                <label for="sendingEmail">E-Mail Address</label>

                                            </td>
                                            <td style="min-width: 150px">
                                                {!! Form::hidden('old['.$from->id.'][type]','from') !!}
                                                {!! Form::text("old[".$from->id."][email]",$from->email,['class'=>'form-control','aria-describedby'=>'sendingEmail']) !!}

                                            </td>
                                            <td>
                                                <label for="sendingEmailDesc">Description</label>

                                            </td>
                                            <td style="min-width: 150px">
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
                   {!! Form::text('new[${fcount}][email]',null,['class'=>'form-control','aria-describedby'=>'sendingEmail']) !!}
                    </td><td><label for="sendingEmailDesc">Description</label></td> <td>
                    <textarea rows="5" class="form-control" name="new[${fcount}][description]" aria-describedby="sendingEmailDesc" placeholder="Enter Description"></textarea>
                    </td><td><button type="button" class="btn btn-primary pull-right add-more-from"><i class="fa fa-plus"></i></button> </td></tr>`;
                $('.froms-table').append(html);
                fcount++;
            });
            $('body').on('click','.delete',function () {
                $(this).closest('tr').remove();
            })
        })
    </script>
@stop
