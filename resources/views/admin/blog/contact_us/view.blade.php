@extends('layouts.admin')
@section('content-header')
@stop
@section('content')

    <section class="tickets-edit-page">
        <div class="card panel panel-default">
            <div class="card-header panel-heading">
                <h2 class="mt-0">View Message</h2>
            </div>
            <div class="card-body panel-body">
                <div class="row">
                    <div class="col-xl-8 col-sm-9">
                        <div class="subject-wall">
                            <div class="row d-flex">
                                <div class="col-xl-3 col-lg-4">
                                    <div class="user-image-name">
                                        <div class="user-image">
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRXrKQMyhxBra3SmOe6uPCmVHW_N3Xx2egM1P12VV3xC2fRrUXJ"
                                                 alt="user">
                                        </div>
                                        <div class="user-name">
                                            {!! $model->name !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-9 col-lg-8">
                                    <div class="user-content h-100">
                                        <h3>{!! $model->email !!}</h3>
                                        <div class="info">
                                            {!! \App\Models\Gmail::getDecodedBody($model->message) !!}
                                        </div>
                                        <div class="attachments">
                                            <span class="title">Attachments</span>
                                            <ul>
                                                {{--@if(count($model->attachments))--}}
                                                {{--@foreach($model->attachments as $attachment)--}}
                                                {{--@if($attachment->type == 'image')--}}
                                                {{--<li class="item-attach">--}}
                                                {{--<img src="{{ $attachment->file_path }}" alt="">--}}
                                                {{--</li>--}}
                                                {{--@elseif($attachment->type == 'document')--}}
                                                {{--<li class="item-attach">--}}
                                                {{--<iframe src="{{ $attachment->file_path }}" style="width: 100%;height: 100%;border: none;"></iframe>--}}
                                                {{--</li>--}}
                                                {{--@endif--}}
                                                {{--@endforeach--}}

                                                {{--<li class="item-attach">--}}
                                                {{--<audio controls>--}}
                                                {{--<source src="https://www.computerhope.com/jargon/m/example.mp3" />--}}
                                                {{--</audio>--}}
                                                {{--</li>--}}
                                                {{--@else--}}
                                                <li>No Attachments</li>
                                                {{--@endif--}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="subject-reply comment">
                                <div class="comments_wall">
                                    <h2>Reply</h2>
                                    <div class="divider"></div>
                                    <div class="user-add-comment mt-md-5 my-4">
                                        <div class="row">
                                            <div class="col-lg-1 col-2 pr-0">
                                                <div class="user-img">
                                                    <img src="/public/images/male.png" alt="">
                                                </div>
                                            </div>
                                            <div class="col-lg-11 col-10">
                                                <div class="add-comment">
                                                    {!! Form::open(['url' => route('admin_post_blog_contact_us_replay',$model->id)]) !!}
                                                    <textarea name="reply" id="" rows="0"
                                                              placeholder="Your reply"></textarea>
                                                    <span class="error-box invalid-feedback comment"></span>
                                                    <div class="row mt-1">
                                                        <div class="col-sm-6">
                                                            {{--<button type="button"--}}
                                                            {{--class="btn btn-outline-warning btn-block cancel-comment">--}}
                                                            {{--Cancel--}}
                                                            {{--</button>--}}
                                                        </div>
                                                        <div class="col-sm-6 text-right">
                                                            <button type="submit"
                                                                    class="btn btn-outline-warning add-comment-btn">
                                                                Submit
                                                            </button>
                                                        </div>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comments-refresh">
                                        {{--@include('admin.ticket._partials.comments')--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-3 blog-contact-us--view">
                        {!! Form::model($model,['url' => route('admin_tickets_edit_post',$model->id), 'id' => 'ticket_form','files' => true]) !!}
                        {!! Form::hidden('id',null) !!}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="text-right">
                                    {!! Form::submit('Save',['class' => 'btn btn-info']) !!}
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="status-wall wall mt-2">
                                    <div class="row form-group">
                                        {{Form::label('status', 'Status',['class' => 'col-xl-3'])}}
                                        <div class="col-xl-9">
                                            {!! Form::select('status_id',[],null,
                                                        ['class' => 'form-control','id'=> 'status']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="tag-wall status-wall wall">
                                    <div class="row form-group">
                                        <label class="col-xl-3 control-label" for="input-category"><span
                                                    data-toggle="tooltip" title=""
                                                    data-original-title="Choose all products under selected category.">Tags</span></label>
                                        <div class="col-xl-9">
                                            <input type="text" name="" value="" placeholder="Tags"
                                                   id="input-tags" class="form-control" autocomplete="off">
                                            <ul class="dropdown-menu"></ul>
                                            <div id="coupon-category" class="well well-sm view-coupon">
                                                <ul class="coupon-tags-list">
                                                    @if($model && $model->tags)
                                                        @php
                                                            $tags = json_decode($model->tags, true);
                                                        @endphp

                                                        @foreach($tags as $tag)
                                                            <li><span class="remove-search-tag"><i
                                                                            class="fa fa-minus-circle"></i></span>{{ $tag }}
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                            {!! Form::hidden('tags',null,['id' => 'tags-names','class' => 'search-hidden-input']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="status-wall wall">
                                    <div class="row form-group">
                                        {{Form::label('category_id', 'Category',['class' => 'col-xl-3'])}}
                                        <div class="col-xl-9">
                                            {!! Form::select('category_id',[],null,
                                                        ['class' => 'form-control','id'=> 'category']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="status-wall wall">
                                    <div class="row form-group">
                                        {{Form::label('priority_id', 'Priority',['class' => 'col-xl-3'])}}
                                        <div class="col-xl-9">
                                            {!! Form::select('priority_id',[],null,
                                                        ['class' => 'form-control','id'=> 'priority']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="status-wall wall">
                                    <div class="row form-group">
                                        {{Form::label('staff', 'Responsible staff',['class' => 'col-xl-3'])}}
                                        <div class="col-xl-9">
                                            {!! Form::select('staff_id',[],null,
                                                        ['class' => 'form-control','id'=> 'staff']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </section>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">

@stop
@section('js')
    <script>

    </script>
@stop
