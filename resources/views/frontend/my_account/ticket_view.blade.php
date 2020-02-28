@extends('layouts.frontend')
@section('content')
    <main class="main-content position-relative">
        <div class="my-account--selects">
            <div class="simple_select_wrapper">
                <select id="accounts--selects"
                        class="select-2 select-2--no-search main-select main-select-2arrows not-selected arrow-dark"
                        style="width: 100%">
                    <option value="{!! route('my_account') !!}">{!! __('account') !!}</option>
                    <option value="{!! route('messages') !!}">{!! __('notifications') !!}</option>
                    <option value="{!! route('my_account_favourites') !!}">{!! __('favorites') !!}</option>
                    <option value="{!! route('my_account_orders') !!}">{!! __('orders') !!}</option>
                    <option value="{!! route('my_account_address') !!}">{!! __('address') !!}</option>
                    <option value="{!! route('my_account_tickets') !!}">{!! __('tickets') !!}</option>
                    <option value="{!! route('my_account_referrals') !!}">{!! __('referrals') !!}</option>
                    <option value="{!! route('my_account_special_offers') !!}">{!! __('special_offer') !!}</option>
                    <option value="">{!! __('address') !!}</option>
                </select>
                {{--<select id="accounts"--}}
                {{--class="select-2 select-2--no-search main-select main-select-2arrows products-filter-wrap_select not-selected arrow-dark" style="width: 100%">--}}
                {{--<option value="{!! route('my_account') !!}">Account</option>--}}
                {{--<option>Brandos</option>--}}
                {{--<option>Eleaf</option>--}}
                {{--</select>--}}
            </div>
        </div>
        <div class="d-flex">
            {{--@include('frontend._partials.left_bar')--}}

            {{--acoount sidebar--}}
            <div class="profile-sidebar profile-sidebar--inner-pages d-flex flex-column align-items-center">
                @include('frontend.my_account._partials.left_bar')
                <div class="mt-auto">
                    {!! Form::open(['url'=>route('logout')]) !!}
                    <div class="text-center">
                        <button type="submit"
                                class="profile-sidebar_logout-btn d-inline-flex align-items-center justify-content-center font-14 text-uppercase text-white pointer">
                            {!! __('logout') !!}
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
            <div class="profile-inner-pg-right-cnt ticket__tab-wrapper">
                <div class="profile-inner-pg-right-cnt_inner h-100">
                    <div class="d-flex flex-wrap">
                        <div class="ticket__tab-wrapper-left-col">
                            <div class="ticket__tab-wrapper-left">
                                <div class="d-flex flex-wrap ticket__tab-top-wrap">
                                    <div class="ticket__tab-top-left">
                                        <div class="d-flex flex-wrap align-items-center ticket__tab-top-head">
                                            <a class="ticket__tab-top-head-back"
                                               href="{!! route('my_account_tickets') !!}">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    width="10px" height="13px" viewBox="0 0 10 13">
                                                    <path fill-rule="evenodd" fill="rgb(53, 53, 53)"
                                                          d="M-0.000,7.000 L10.000,13.000 C10.000,13.000 10.000,11.738 10.000,10.000 C9.031,9.578 4.000,7.000 4.000,7.000 C4.000,7.000 9.156,3.553 10.000,3.000 C10.000,1.262 10.000,-0.000 10.000,-0.000 L-0.000,7.000 Z"/>
                                                </svg>
                                            </a>
                                            <h1 class="font-sec-reg font-28 lh-1 text-tert-clr ticket__tab-top-head-title mb-0">
                                                {!! $ticket->subject !!}
                                            </h1>
                                            <span
                                                class="font-main-bold font-16 lh-1 bg-red-clr text-sec-clr ticket__tab-top-head-status"
                                                style="background-color: {{ $ticket->priority->color }}">
                                                {{ $ticket->priority->name }}
                                            </span>
                                        </div>
                                        <div class="d-flex flex-wrap ticket__tab-top-left-content-wrap">
                                            <div class="ticket__tab-top-left-user">
                                                <img src="{{ user_avatar($ticket->user_id) }}" alt="user"
                                                     class="ticket__tab-top-left-user-photo">
                                                <div class="text-center ticket__tab-top-left-user-info">
                                                    <p class="font-16 ticket__tab-top-left-user-by">{!! __('submitted_by') !!}</p>
                                                    <h3 class="font-main-bold font-20 lh-1 ticket__tab-top-left-user-title">
                                                    {{ $ticket->author->name .' '.$ticket->author->last_name }}
                                                    </h3>
                                                </div>

                                            </div>
                                            <div class="d-flex flex-column ticket__tab-top-left-content">
                                                <p class="font-main-light font-16 ticket__tab-top-left-content-txt">
                                                    {!! $ticket->summary !!}
                                                </p>
                                                <div class="mt-auto attachments">
                                                <span class="title">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        width="21px" height="41px" viewBox="0 0 21 41">
<path fill-rule="evenodd" fill="rgb(53, 53, 53)"
      d="M20.150,27.150 C19.681,27.150 19.300,26.768 19.300,26.296 L19.300,10.555 C19.300,5.677 15.353,1.708 10.500,1.708 C5.647,1.708 1.699,5.677 1.699,10.555 L1.699,17.203 C1.699,17.203 1.699,17.203 1.699,17.203 L1.699,33.434 C1.699,36.664 4.313,39.292 7.526,39.292 C10.739,39.292 13.353,36.664 13.353,33.434 L13.353,24.447 L13.353,17.203 L13.353,11.714 C13.353,10.167 12.100,8.908 10.561,8.908 C9.021,8.908 7.769,10.167 7.769,11.714 L7.769,24.447 C7.769,24.918 7.388,25.301 6.919,25.301 C6.450,25.301 6.069,24.918 6.069,24.447 L6.069,11.714 C6.069,9.225 8.084,7.199 10.561,7.199 C13.037,7.199 15.052,9.225 15.052,11.714 L15.052,17.202 C15.052,17.202 15.052,17.203 15.052,17.203 L15.052,33.434 C15.052,37.606 11.676,41.000 7.526,41.000 C3.376,41.000 0.000,37.606 0.000,33.434 L0.000,26.297 C0.000,26.296 -0.000,26.296 -0.000,26.296 L-0.000,10.555 C-0.000,4.735 4.710,-0.000 10.500,-0.000 C16.290,-0.000 21.000,4.735 21.000,10.555 L21.000,26.296 C21.000,26.768 20.619,27.150 20.150,27.150 Z"/>
</svg>
                                                </span>
                                                    <ul class="attachments-box">
                                                        @include("admin.ticket._partials.attachments")
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ticket__tab-top-right">
                                        <div class="card card account-card rounded-0 border-left-0">
                                            <div
                                                class="d-flex align-items-center justify-content-center card-title font-20">
                                                {{--                                            <span class="d-inline-block mb-3"> {{ $ticket->subject }}</span>--}}
                                                <span class="icon">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    width="19px" height="15px" viewBox="0 0 19 15">
<path fill-rule="evenodd" fill="rgb(255, 255, 255)"
      d="M6.045,11.866 L1.511,7.164 L-0.000,8.731 L6.045,15.000 L19.000,1.567 L17.488,-0.000 L6.045,11.866 Z"/>
</svg>
                                            </span>
                                                {!! Form::open(['url' => route('my_account_tickets_mark_completed',$ticket->id)]) !!}
                                                {!! Form::submit('Mark as completed',['class' => 'ntfs-btn']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                            <div class="panel-body card-body">
                                                <div class="form-group row">
                                                    <div class="col-sm-6 pr-0">
                                                        <span>{!! __('category') !!}:</span>
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                    <span
                                                        class="font-main-bold text-tert-clr">{{ $ticket->category->name }}</span>
                                                    </div>
                                                </div>
                                                @if($ticket->category && $ticket->category->slug == 'order' && $ticket->order)
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 pr-0">
                                                            <span>{!! __('order_number') !!}:</span>
                                                        </div>
                                                        <div class="col-sm-6 ">
                                                        <span
                                                            class="font-main-bold text-tert-clr">{{ $ticket->order->order_number }}</span>
                                                        </div>
                                                    </div>
                                                @elseif($ticket->category && $ticket->category->slug == 'product')
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 pr-0">
                                                            <span>{!! __('product') !!}</span>
                                                        </div>
                                                        <div class="col-sm-6 ">
                                                        <span
                                                            class="font-main-bold text-tert-clr">{{ $ticket->product->name }}</span>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="form-group row">
                                                    <div class="col-sm-6 pr-0">
                                                        <span>{!! __('status') !!}:</span>
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                    <span
                                                        class="font-main-bold text-green-clr">{{ $ticket->status->name }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6 pr-0">
                                                        <span>{!! __('responsible') !!}:</span>
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                    <span
                                                        class="font-main-bold ">{{ ($ticket->staff) ? $ticket->staff->name : 'not assigned yet' }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6 pr-0">
                                                        <span>{!! __('created') !!}:</span>
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                    <span
                                                        class="font-main-bold ">{!! time_ago($ticket->created_at) !!}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6 pr-0">
                                                        <span>{!! __('last_update') !!}:</span>
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                    <span
                                                        class="font-main-bold">{!! time_ago($ticket->updated_at) !!}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="comments__wrapper">
                                    <div class="comment-block">
                                        <div class="comment-block-inner new__scroll comments-refresh">
                                            @include("admin.ticket._partials.comments")
                                        </div>
                                    </div>
                                    <div class="comment-send-block">
                                        {!! Form::open(['url' => route('admin_tickets_reply'),'id' => 'add-comment','files' =>true]) !!}
                                        {!! Form::hidden('ticket_id',$ticket->id) !!}
                                        <div class="comment-send-block-user-img">
                                            <img src="{{ user_avatar(auth()->id()) }}" alt="user">
                                        </div>
                                        <div class="area-wrap">
                                        <textarea name="reply" id="" rows="0"
                                                  placeholder="{!! __('placeholder_your_reply') !!}
                                                  class="add-comment_field form-control w-100"></textarea>
                                            <span class="icon">
                                                <input type="file" name="attachments[]" id="attach-file" multiple="true" class="inputfile">
                                                <label for="attach-file">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        width="16px" height="38px" viewBox="0 0 16 38">
<path fill-rule="evenodd" opacity="0.769" fill="rgb(53, 53, 53)"
      d="M15.353,25.164 C14.995,25.164 14.705,24.809 14.705,24.372 L14.705,9.783 C14.705,5.261 11.697,1.583 8.000,1.583 C4.303,1.583 1.295,5.261 1.295,9.783 L1.295,15.944 C1.295,15.944 1.295,15.944 1.295,15.945 L1.295,30.988 C1.295,33.981 3.286,36.417 5.734,36.417 C8.182,36.417 10.173,33.981 10.173,30.988 L10.173,22.658 L10.173,15.945 L10.173,10.857 C10.173,9.423 9.219,8.256 8.046,8.256 C6.873,8.256 5.919,9.423 5.919,10.857 L5.919,22.658 C5.919,23.095 5.629,23.450 5.272,23.450 C4.914,23.450 4.624,23.095 4.624,22.658 L4.624,10.857 C4.624,8.550 6.159,6.673 8.046,6.673 C9.933,6.673 11.468,8.550 11.468,10.857 L11.468,15.943 C11.468,15.944 11.468,15.944 11.468,15.945 L11.468,30.988 C11.468,34.855 8.896,38.000 5.734,38.000 C2.572,38.000 0.000,34.855 0.000,30.988 L0.000,24.373 C0.000,24.372 -0.000,24.372 -0.000,24.372 L-0.000,9.783 C-0.000,4.389 3.589,0.000 8.000,0.000 C12.411,0.000 16.000,4.389 16.000,9.783 L16.000,24.372 C16.000,24.809 15.710,25.164 15.353,25.164 Z"/>
</svg>
                                                </label>

                                        </span>
                                        </div>

                                        <span class="error-box invalid-feedback comment"></span>

                                        <button type="submit"
                                                class="btn font-18 text-uppercase ntfs-btn add-comment-btn rounded-0">
                                            {!! __('send') !!}
                                        </button>

                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ticket__tab-wrapper-right-col">
                            <div class="ticket__tab-wrapper-right">
                                <a href="#" class="d-block">
                                    <img src="/public/img/temp/ads-product-2.jpg" alt="ads" class="ads-img">
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{--@include('frontend.my_account._partials.verify_bar.blade_old.php')--}}

        </div>
    </main>
@stop

@section('css')
    <style>
        .attachments {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            margin-top: auto;
        }

        .attachments span.title {
            margin-right: 15px;
            font-weight: bold;
        }

        .attachments ul {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .attachments ul .item-attach {
            width: 90px;
            height: 70px;
            border: 1px solid #ccc;
            box-shadow: 0 0 2px #b3b1b1;
            overflow: hidden;
            margin-right: 5px;
            margin-bottom: 3px;
        }

        .attachments ul .item-attach > * {
            width: 100%;
        }

        .attachments ul .item-attach img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('.comments-refresh').animate({scrollTop: document.querySelector(".comments-refresh").scrollHeight},"fast");

            $('body').on('click', '.cancel-comment', function (event) {
                $(this).parents('form:first')[0].reset();
            });

            $('body').on('click', '.cancel-reply', function (event) {
                $(this).parents('.user-add-comment').remove();
            });

            $("body").on('submit',"#add-comment" ,function(e){
                e.preventDefault();
                form = this;
                $.ajax({
                    url: "{!! route('admin_tickets_reply') !!}",
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function (data) {
                        $('.error-box').html('');
                        if (data.success == false) {
                            $.map(data.errors, function (k, v) {
                                $('#add-comment').find('.' + v).text(k[0]);
                            });
                        } else {
                            $('#add-comment')[0].reset();
                            $(".user-add-comment-secondry").remove();
                            //
                            // $("#msgModal .message-place").text(data.message);
                            // $("#msgModal").modal();

                            $(".comments-refresh").html(data.html);
                            $(".attachments-box").html(data.attachments);
                            $('.comments-refresh').animate({scrollTop: document.querySelector(".comments-refresh").scrollHeight},"fast");

                        }
                    },
                    error: function (data) {
                        // alert(data.err);
                    }
                });
            });

            {{--$('body').on('click', '.add-comment-btn', function (event) {--}}
                {{--event.preventDefault();--}}
                {{--var form = $(this).parents('form:first');--}}
                {{--var data = new FormData(form[0]);--}}
                {{--jQuery.each($('#attach-file')[0].files, function(i, file) {--}}
                    {{--data.append('attachments[]', file);--}}
                {{--});--}}

                {{--console.log(data.);--}}
                {{--// var data = new FormData();--}}
                {{--// var form_data = form.serializeArray();--}}
                {{--// $.each(form_data, function (key, input) {--}}
                {{--//     data.append(input.name, input.value);--}}
                {{--// });--}}
                {{--//--}}
                {{--// $.each(form.find('input[type="file"]'), function(i, tag) {--}}
                {{--//     $.each($(tag)[0].files, function(i, file) {--}}
                {{--//         data.append(tag.name, file);--}}
                {{--//     });--}}
                {{--// });--}}


                {{--$.ajax({--}}
                    {{--url: "{!! route('admin_tickets_reply') !!}",--}}
                    {{--type: 'POST',--}}
                    {{--data: data,--}}
                    {{--success: function (data) {--}}
                        {{--$('.error-box').html('');--}}
                        {{--if (data.success == false) {--}}
                            {{--$.map(data.errors, function (k, v) {--}}
                                {{--form.find('.' + v).text(k[0]);--}}
                            {{--});--}}
                        {{--} else {--}}
                            {{--form[0].reset();--}}
                            {{--$(".user-add-comment-secondry").remove();--}}
                            {{--//--}}
                            {{--// $("#msgModal .message-place").text(data.message);--}}
                            {{--// $("#msgModal").modal();--}}

                            {{--$(".comments-refresh").html(data.html);--}}
                            {{--$(".attachments-box").html(data.attachments);--}}
                            {{--$('.comments-refresh').animate({scrollTop: document.querySelector(".comments-refresh").scrollHeight},"fast");--}}

                        {{--}--}}
                    {{--},--}}
                    {{--error: function (data) {--}}
                        {{--// alert(data.err);--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}


            $('body').on('click', '.reply', function (e) {
                e.preventDefault();
                $(".user-add-comment-secondry").remove();
                var parentID = $(this).data('id');
                var data = '<div class="user-add-comment user-add-comment-secondry w-100 mt-md-5 my-4">\n' +
                    '                                    <div class="row m-0">\n' +
                    '                                        <div class="col-sm-12">\n' +
                    '                                            <div class="add-comment">\n' +
                    '                                            {!! Form::open(["route" => "admin_tickets_reply"]) !!}\n' +
                    '                            {!! Form::hidden("ticket_id",$ticket->id) !!}\n' +
                    '                        <input type="hidden" name="parent_id" value="' + parentID + '" />\n' +
                    '\n' +
                    '                        <textarea name="reply" id="" rows="0"\n' +
                    '                                  placeholder="Your reply"></textarea>\n' +
                    '                        <span class="error-box invalid-feedback comment"></span>\n' +
                    '                        <div class="row mt-1">\n' +
                    '                            <div class="col-sm-6">\n' +
                    '<button type="button" class="btn btn-outline-warning btn-block cancel-reply">Cancel </button>\n' +
                    '                            </div>\n' +
                    '                            <div class="col-sm-6 text-right">\n' +
                    '                                <button type="button"\n' +
                    '                                        class="btn btn-outline-warning add-comment-btn">\n' +
                    '                                    Submit\n' +
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
@stop
