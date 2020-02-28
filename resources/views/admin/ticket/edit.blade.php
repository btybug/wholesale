@extends('layouts.admin')
@section('content-header')
@stop
@section('content')
    <section class="tickets-edit-page">
       <div class="card panel panel-default">
           <h2 class="card-header panel-heading mt-0">{{ ($model) ? $model->subject : "Add ticket" }}</h2>
          <div class="card-body panel-body">
              <div class="row">
                  <div class="col-xl-8 col-sm-9">
                      <div class="subject-wall">
                          <div class="row d-flex">
                              <div class="col-xl-3 col-lg-4">
                                  <div class="user-image-name">
                                      <div class="user-image">
                                          <img src="{{ user_avatar() }}"
                                               alt="user">
                                      </div>
                                      <div class="user-name">
                                          {!! $model->author->name !!}
                                      </div>
                                  </div>
                              </div>
                              <div class="col-xl-9 col-lg-8">
                                  <div class="user-content h-100">
                                      <h3>{!! $model->subject !!}</h3>
                                      <p class="info">
                                          {!! $model->summary !!}
                                      </p>
                                      <div class="attachments">
                                          <span class="title">Attachments</span>
                                          <ul>
                                              @if(count($model->attachments))
                                                  @foreach($model->attachments as $attachment)
                                                      @if($attachment->type == 'image')
                                                          <li class="item-attach">
                                                              <img src="{{ $attachment->file_path }}" alt="">
                                                          </li>
                                                      @elseif($attachment->type == 'document')
                                                          <li class="item-attach">
                                                              <iframe src="{{ $attachment->file_path }}" style="width: 100%;height: 100%;border: none;"></iframe>
                                                          </li>
                                                      @endif
                                                  @endforeach

                                                  {{--<li class="item-attach">--}}
                                                  {{--<audio controls>--}}
                                                  {{--<source src="https://www.computerhope.com/jargon/m/example.mp3" />--}}
                                                  {{--</audio>--}}
                                                  {{--</li>--}}
                                              @else
                                                  <li>No Attachments</li>
                                              @endif
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
                                          <div class="col-sm-1">
                                              <div class="user-img">
                                                  <img src="{{ user_avatar() }}" alt="">
                                              </div>
                                          </div>
                                          <div class="col-sm-11">
                                              <div class="add-comment">
                                                  {!! Form::open(['url' => 'admin_tickets_reply']) !!}
                                                  {!! Form::hidden('ticket_id',$model->id) !!}
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
                                                          <button type="button"
                                                                  class="btn btn-info add-comment-btn">
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
                                      @include('admin.ticket._partials.comments')
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-4 col-sm-3">
                      {!! Form::model($model,['url' => route('admin_tickets_edit_post',$model->id), 'id' => 'ticket_form','files' => true]) !!}
                      {!! Form::hidden('id',null) !!}
                      <div class="card panel panel-default">
                          <div class="card-header panel-heading">
                              <div class="text-right">
                                  {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
                              </div>
                          </div>

                         <div class="card-body panel-body">
                             <div class="status-wall wall">
                                 <div class="row form-group">
                                     {{Form::label('status', 'Status',['class' => 'col-xl-3'])}}
                                     <div class="col-xl-9">
                                         {!! Form::select('status_id',$statuses,null,
                                                     ['class' => 'form-control','id'=> 'status']) !!}
                                     </div>
                                 </div>
                             </div>
                             <div class="tag-wall wall">
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
                                         {!! Form::select('category_id',$categories,null,
                                                     ['class' => 'form-control','id'=> 'category']) !!}
                                     </div>
                                 </div>
                             </div>
                             <div class="status-wall wall">
                                 <div class="row">
                                     {{Form::label('priority_id', 'Priority',['class' => 'col-xl-3'])}}
                                     <div class="col-xl-9">
                                         {!! Form::select('priority_id',$priorities,null,
                                                     ['class' => 'form-control','id'=> 'priority']) !!}
                                     </div>
                                 </div>
                             </div>
                             <div class="form-group " id="category-related">


                             @if($model->category && $model->category->slug == 'order')
                                 <div class="status-wall wall">
                                     <div class="row form-group">
                                         {{Form::label('order_id', 'Order Number',['class' => 'col-xl-3'])}}
                                         <div class="col-xl-9">
                                             {!! Form::select('order_id',$model->author->orders->pluck('code','id'),null,['class'=>'form-control']) !!}
                                         </div>
                                     </div>
                                 </div>
                             @elseif($model->category && $model->category->slug == 'product')
                                     <div class="status-wall wall">
                                         <div class="row form-group">
                                             {{Form::label('product_id', 'Product',['class' => 'col-xl-3'])}}
                                             <div class="col-xl-9">
                                                 {!! Form::select('product_id',\App\Models\Stock::all()->pluck('name','id'),null,['class'=>'form-control']) !!}
                                             </div>
                                         </div>
                                     </div>
                             @endif
                             </div>

                             <div class="status-wall wall">
                                 <div class="row form-group">
                                     {{Form::label('staff', 'Responsible staff',['class' => 'col-xl-3'])}}
                                     <div class="col-xl-9">
                                         {!! Form::select('staff_id',$staff,null,
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
    <script src="/public/js/tiket.js"></script>

    <script>
        $(document).ready(function () {
            $('body').on('click', '.cancel-comment', function (event) {
                $(this).parents('form:first')[0].reset();
            });

            $('body').on('click', '.cancel-reply', function (event) {
                $(this).parents('.user-add-comment').remove();
            });

            $('body').on('click', '.add-comment-btn', function (event) {
                event.preventDefault();
                var form = $(this).parents('form:first');
                var data = form.serialize();
                $.ajax({
                    url: "{!! route('admin_tickets_reply') !!}",
                    type: 'POST',
                    data: data,
                    success: function (data) {
                        $('.error-box').html('');
                        if (data.success == false) {
                            $.map(data.errors, function (k, v) {
                                form.find('.' + v).text(k[0]);
                            });
                        } else {
                            form[0].reset();
                            $(".user-add-comment-secondry").remove();

                            $("#msgModal .message-place").text(data.message);
                            $("#msgModal").modal();

                            $(".comments-refresh").html(data.html);
                        }
                    },
                    error: function (data) {
                        // alert(data.err);
                    }
                });
            });


            $('body').on('click', '.reply', function (e) {
                e.preventDefault();
                $(".user-add-comment-secondry").remove();
                var parentID = $(this).data('id');
                var data = '<div class="user-add-comment user-add-comment-secondry w-100 mt-md-5 my-4">\n' +
                    '                                    <div class="row m-0">\n' +
                    '                                        <div class="col-sm-12">\n' +
                    '                                            <div class="add-comment">\n' +
                    '                                            {!! Form::open(["route" => "admin_tickets_reply"]) !!}\n' +
                    '                            {!! Form::hidden("ticket_id",$model->id) !!}\n' +
                    '                        <input type="hidden" name="parent_id" value="' + parentID + '" />\n' +
                    '\n' +
                    '                        <textarea name="reply" id="" rows="0"\n' +
                    '                                  placeholder="Your reply"></textarea>\n' +
                    '                        <span class="error-box invalid-feedback comment"></span>\n' +
                    '                        <div class="row mt-1">\n' +
                    '                            <div class="col-sm-12">\n' +
                    '                                <button type="button"\n' +
                    '                                        class="btn btn-info add-comment-btn pull-right">\n' +
                    '                                    Submit\n' +
                    '                                </button>\n' +
                    '<button type="button" class="btn btn-danger cancel-reply pull-right mr-10">Cancel </button>\n' +

                    '                            </div>\n' +
                    '                        </div>\n' +
                    '{!! Form::close() !!}\n' +
                    '                        </div>\n' +
                    '                    </div>\n' +
                    '                </div>\n' +
                    '            </div>';
                $(this).closest(".user-comment-img").append(data);
                $(this).closest(".user-comment-img").addClass("user-commmet-add")

            })
        });
    </script>
@stop
