<h5 class="font-sec-bold font-20 text-uppercase text-tert-clr mb-4">{!! __('comments') !!}</h5>
<div class="row">
    <div class="col-md-12">
        <div class="comments-wrapper">
            <div class="comment-list comment-list-wrapper">
                <div class="user-add-comment">
                    <div class="row">
                        <div class="col-sm-12">
                            @if(Auth::check())
                                <div class="add-comment">
                                    {!! Form::open(['route' => 'comment_create_post']) !!}
                                    {!! Form::hidden('section_id',$model->id) !!}
                                    {!! Form::hidden('section',$type) !!}
                                    <div class="main-comment-wrap-img">
                                        <div class="user-imges">
                                            <img src="{{ user_avatar() }}"
                                                 alt="user">
                                        </div>
                                        <textarea name="comment" id="" rows="0"
                                                  placeholder="Your comments"></textarea>
                                    </div>

                                    <span class="error-box invalid-feedback comment"></span>
                                    <div class="d-flex button-comment-wrap justify-content-end">

                                        <div class="button-comment">
                                            <button type="button"
                                                    class="btn btn-block add-comment-btn">
                                                <span class="post-title">{!! __('post_comment') !!}</span>
                                                <span class="icon">
<svg
    xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    width="22px" height="9px">
<path fill-rule="evenodd" opacity="0.8" fill="rgb(255, 255, 255)"
      d="M0.002,5.617 L16.071,5.617 L16.071,9.000 L21.996,4.500 L16.071,0.000 L16.071,3.383 L0.002,3.383 L0.002,5.617 Z"/>
</svg>
                                                        </span>
                                            </button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="comments-refresh">

                    @include('frontend.comments.list')
                </div>
                <div class="message-place">

                </div>
            </div>
        </div>
    </div>
</div>

<script type="template" id="reply-comment">
    <div class="user-add-comment user-add-comment-secondry w-100">
        <div class="text-right">
            <div class="add-comment">
                {!! Form::open(["route" => "comment_create_post"]) !!}
                {!! Form::hidden("section_id",$model->id) !!}
                {!! Form::hidden("section",$type) !!}
                <input type="hidden" name="parent_id" value="{parent}"/>

                <textarea name="comment" id="" rows="0"
                          placeholder="Your comments"></textarea>
                <span class="error-box invalid-feedback comment"></span>
                <div class="button-repl">
                    <button type="button"
                            class="btn btn-block add-comment-btn">
                        REPLY
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</script>

{{--<div class="comments-wrapper">--}}
{{--@if($post->comment_enabled)--}}
{{--<div class="comment-list">--}}
{{--<h2>Comments</h2>--}}
{{--<div class="divider"></div>--}}

{{--<div class="user-add-comment mt-md-5 my-4">--}}
{{--<div class="row">--}}
{{--<div class="col-sm-1">--}}
{{--<div class="user-img">--}}
{{--<img src="/public/images/male.png" alt="">--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-sm-11">--}}
{{--<div class="add-comment">--}}
{{--{!! Form::open(['route' => 'comment_create_post']) !!}--}}
{{--{!! Form::hidden('post_id',$post->id) !!}--}}
{{--@if(! Auth::check())--}}
{{--<div class="row">--}}
{{--<div class="col-sm-6">--}}
{{--<input name="guest_name" type="text"--}}
{{--placeholder="Username">--}}
{{--<span class="error-box invalid-feedback guest_name"></span>--}}
{{--</div>--}}
{{--<div class="col-sm-6">--}}
{{--<input name="guest_email" type="email"--}}
{{--placeholder="Email">--}}
{{--<span class="error-box invalid-feedback guest_email"></span>--}}
{{--</div>--}}
{{--</div>--}}
{{--@endif--}}

{{--<textarea name="comment" id="" rows="0"--}}
{{--placeholder="Your comments"></textarea>--}}
{{--<span class="error-box invalid-feedback comment"></span>--}}
{{--<div class="row mt-1">--}}
{{--<div class="col-sm-6">--}}
{{--<button type="button"--}}
{{--class="btn btn-outline-warning btn-block cancel-comment">--}}
{{--Cancel--}}
{{--</button>--}}
{{--</div>--}}
{{--<div class="col-sm-6">--}}
{{--<button type="button"--}}
{{--class="btn btn-outline-warning btn-block add-comment-btn">--}}
{{--Add--}}
{{--</button>--}}
{{--</div>--}}
{{--</div>--}}
{{--{!! Form::close() !!}--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="comments-refresh">--}}
{{--@include('frontend.blog.single_post_comments')--}}
{{--</div>--}}
{{--<!-- First Comment -->--}}
{{--</div>--}}
{{--@endif--}}
{{--</div>--}}
