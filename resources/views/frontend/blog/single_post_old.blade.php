@extends('layouts.frontend')
@section('content')
    <div id="gp-inner-container">
        <div class="container">
            <div id="gp-left-column">
                <div id="gp-content">
                    <article>
                        <div id="gp-post-navigation">
                            <div id="gp-breadcrumbs">
                            <span>
                                <span><a href="http://socialize.ghostpool.com/">Home</a> / <span>
                            <a href="#">Featured News</a> / <span class="breadcrumb_last">Dale Webster takes a break after 14642 consecutive days</span></span></span>
                            </span>
                            </div>
                            <div id="gp-post-links">
                                <a href="#" rel="prev"></a>
                                <a href="#" rel="next"></a>
                                <a href="#" class="gp-share-button"></a>
                            </div>
                            <div id="gp-share-icons-hide" style="display: none">
                                <h3>Share This Post</h3>
                                <div class="gp-share-icons d-inline-block">
                                    <div id="share"></div>
                                    <!-- <a href="#" title="Twitter" class="gp-share-twitter"></a>
                                    <a href="#" title="Facebook" class="gp-share-facebook"></a>
                                    <a href="#" title="Google+" class="gp-share-google-plus"></a>
                                    <a href="#" title="LinkedIn" class="gp-share-linkedin"></a>
                                    <a href="#" class="gp-share-tumblr"></a>
                                    <a href="" title="Email" class="gp-share-email"></a> -->
                                </div>
                                <div class="hide-icons d-inline-block float-right mt-2">
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>
                            <div class="gp-clear"></div>
                        </div>
                        <header class="gp-entry-header">
                            <div class="gp-entry-cats">
                                <a href="#">Sport</a>
                            </div>
                            <h1 class="gp-entry-title">{!! $post->title !!}</h1>
                            <div class="gp-entry-meta"> <span class="gp-post-meta gp-meta-avatar">
                                    <a href="http://socialize.ghostpool.com/author/socialize/">
                                        <img alt="" src="http://socialize.ghostpool.com/wp-content/uploads/avatars/2/31d53749448a096b43df20db6fdb94a8-bpthumb.jpg" srcset="http://socialize.ghostpool.com/wp-content/uploads/avatars/2/31d53749448a096b43df20db6fdb94a8-bpfull.jpg 2x" class="avatar avatar-50 photo" height="50" width="50">
                                    </a>
                                    </span>
                                <span class="gp-post-meta-rows">
                                        <span class="gp-post-meta-row-1">
                                            <span class="gp-post-meta gp-meta-author">
                                                By
                                                <a href="http://socialize.ghostpool.com/author/socialize/">{{$post->author->name}}</a>
                                            </span>
                                            on
                                            <time class="gp-post-meta gp-meta-date" itemprop="datePublished" datetime="2015-06-07T14:18:24+00:00">{!! BBgetDateFormat(@$post->created_at) !!}</time>
                                        </span>
                                        <span class="gp-post-meta-row-2">
                                            <span class="gp-post-meta gp-meta-views">4282 views</span> </span> </span>
                            </div>
                        </header>
                        <div class="gp-entry-content gp-image-above">
                            <div class="gp-entry-text" itemprop="text">
                                {!! $post->long_description !!}
                            </div>
                        </div>
                        <div class="gp-entry-tags">
                            <a href="http://socialize.ghostpool.com/tag/sport/" rel="tag">sport</a>
                            <a href="http://socialize.ghostpool.com/tag/surf/" rel="tag">surf</a>
                        </div>
                        <div id="gp-share-icons">
                            <h3>Share This Post</h3>
                            <div class="gp-share-icons-on-footer">
                                <!-- <a href="#" title="Twitter" class="gp-share-twitter"></a>
                                <a href="#" title="Facebook" class="gp-share-facebook"></a>
                                <a href="#" title="Google+" class="gp-share-google-plus"></a>
                                <a href="#" title="Pinterest" class="gp-share-pinterest" target="_blank"></a>
                                <a href="#" title="Tumblr" class="gp-share-tumblr"></a>
                                <a href="" title="Email" class="gp-share-email"></a> -->
                            </div>
                        </div>
                        <div class="gp-author-info">
                            <img alt="" src="http://socialize.ghostpool.com/wp-content/uploads/avatars/2/31d53749448a096b43df20db6fdb94a8-bpfull.jpg" srcset="http://socialize.ghostpool.com/wp-content/uploads/avatars/2/31d53749448a096b43df20db6fdb94a8-bpfull.jpg 2x" class="avatar avatar-110 photo" height="110" width="110">
                            <div class="gp-author-meta"><div class="gp-author-name">
                                    <a href="#">GhostPool</a>
                                </div>
                                <div class="gp-author-desc">
                                    Credibly embrace multidisciplinary paradigms and synergistic services. Phosfluorescently fabricate customer directed technologies after value-added infrastructures.
                                </div>
                                <div class="gp-author-social-icons">

                                </div>
                            </div>
                        </div>
                        <div class="comments">
                            <h2>Comments</h2>
                            <div class="divider"></div>

                            {!! commentRender($post->comments) !!}

                            <div class="user-add-comment mt-md-5 mt-4">
                                <div class="row">
                                    <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1">
                                        <div class="user-img">
                                            <img src="/public/images/male.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col-sm-11 col-md-8 col-lg-5 col-xl-7">
                                        <div class="add-comment">
                                            {!! Form::open(['route' => 'comment_create_post']) !!}
                                            {!! Form::hidden('post_id',$post->id) !!}
                                            @if(! Auth::check())
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input name="guest_name" type="text" placeholder="Username">
                                                        <span class="error-box invalid-feedback guest_name"></span>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input name="guest_email" type="email" placeholder="Email">
                                                        <span class="error-box invalid-feedback guest_email"></span>
                                                    </div>
                                                </div>
                                            @endif

                                            <textarea name="comment" id="" rows="0"
                                                      placeholder="Your comments"></textarea>
                                            <span class="error-box invalid-feedback comment"></span>
                                            <div class="row mt-1">
                                                <div class="col-sm-6">
                                                    <button type="button"
                                                            class="btn btn-outline-success btn-block cancel-comment">
                                                        Cancel
                                                    </button>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button type="button"
                                                            class="btn btn-outline-success btn-block add-comment-btn">
                                                        Add
                                                    </button>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

        </div>
    </div>

@stop
@section('css')
    {!! Html::style("public/admin_theme/bower_components/bootstrap/dist/css/bootstrap.min.css") !!}
    <link href={{asset("public/frontend/css/blog-single.css?v=".rand(111,999))}} rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css" />
    <style>
        .hide-icons {
            cursor: pointer;
        }

        .comments {
            font-family: 'SF-UI-Text-Medium_1';
            font-size: 16px;
        }

        .comments .user-comment-img .user-img img{
            width: 100%;
            max-height: 65px;
            object-fit: cover;
        }
        .comments .user-comment-img .user-comment{
            flex: 1;
            height:100%;
        }
        .comments .user-comment-img .user-comment .content-reply{
            font-family: 'SF-UI-Text-Light_1';
            margin-top: auto;
            padding-bottom: 10px;
        }
        .comments .user-comment-img .user-comment .content-reply .reply{
            color: #1c8379;
            text-decoration: none;
        }
        .comments .user-comment-img .user-title h6{
            color:#3a3b3b ;

        }
        .comments .user-comment-img .user-title span{
            color:#cbcbcb ;
        }
        .comments .user-add-comment{
            font-family: 'SF-UI-Text-Light_1';
        }
        .comments .user-add-comment img{
            width: 100%;
            max-height: 65px;
            object-fit: cover;
        }
        .comments .user-add-comment textarea{
            border: none;
            border-bottom: 1px solid #26a69a;
            resize: none;
            outline: none;
            padding: 0;
            overflow: hidden;
            width: 100%;
            margin-top:10px;
        }
        .comments .user-add-comment input{
            display: block;
            width: 100%;
            padding: .375rem 0;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            border: none;
            background-clip: padding-box;
            border-bottom: 1px solid #27a59a;
            outline: none;
        }
        .comments .user-add-comment button {
            color: #27a59a;
            border-color: #27a59a;
        }
        .comments .user-add-comment button:hover{
            background-color: #27a59a;
            border-color: #27a59a;
            color: #ffffff;
        }
    </style>
@stop

@section("js")
    {!! Html::script("public/admin_theme/bower_components/jquery/dist/jquery.min.js")!!}
    <!-- jQuery UI 1.11.4 -->
    {!! Html::script("public/admin_theme/bower_components/jquery-ui/jquery-ui.min.js")!!}
    {!! Html::script("public/admin_theme/bower_components/bootstrap/dist/js/bootstrap.min.js")!!}

    {!! Html::script('public/js/custom/comments.js') !!}
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
                    url: "{!! route('comment_create_post') !!}",
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
                var data = '<div class="user-add-comment user-add-comment-secondry mt-md-5 mt-4">\n' +
                    '                                    <div class="row">\n' +
                    '                                        <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1">\n' +
                    '                                        </div>\n' +
                    '                                        <div class="col-sm-11 col-md-8 col-lg-5 col-xl-7">\n' +
                    '                                            <div class="add-comment">\n' +
                    '                                            {!! Form::open(["route" => "comment_create_post"]) !!}\n' +
                    '                            {!! Form::hidden("post_id",$post->id) !!}\n' +
                    '                        <input type="hidden" name="parent_id" value="' + parentID + '" />\n' +
                    '                            @if(! Auth::check())\n' +
                    '                        <div class="row">\n' +
                    '                            <div class="col-sm-6">\n' +
                    '                                <input name="guest_name" type="text" placeholder="Username">\n' +
                    '                                <span class="error-box invalid-feedback guest_name"></span>\n' +
                    '                            </div>\n' +
                    '                            <div class="col-sm-6">\n' +
                    '                                <input name="guest_email" type="email" placeholder="Email">\n' +
                    '                                <span class="error-box invalid-feedback guest_email"></span>\n' +
                    '                            </div>\n' +
                    '                        </div>\n' +
                    '@endif\n' +
                    '\n' +
                    '                        <textarea name="comment" id="" rows="0"\n' +
                    '                                  placeholder="Your comments"></textarea>\n' +
                    '                        <span class="error-box invalid-feedback comment"></span>\n' +
                    '                        <div class="row mt-1">\n' +
                    '                            <div class="col-sm-6">\n' +
                    '                                <button type="button"\n' +
                    '                                        class="btn btn-outline-success btn-block cancel-reply">\n' +
                    '                                    Cancel\n' +
                    '                                </button>\n' +
                    '                            </div>\n' +
                    '                            <div class="col-sm-6">\n' +
                    '                                <button type="button"\n' +
                    '                                        class="btn btn-outline-success btn-block add-comment-btn">\n' +
                    '                                    Add\n' +
                    '                                </button>\n' +
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

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>
    <script>
        $("#share").jsSocials({
            shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
        });
        $(".gp-author-social-icons").jsSocials({
            shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
        });
        $(".gp-share-icons-on-footer").jsSocials({
            shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
        });
        $("body").on("click", ".gp-share-button, .hide-icons", function(){
            $("#gp-share-icons-hide").toggle()
        })
    </script>

@stop