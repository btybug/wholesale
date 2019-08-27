{{--{!! replyRender($data) !!}--}}

@foreach($data as $item)
    @if($item->getTable() == 'history')
        <div class="comment-infos text-center">
            <div class="d-inline-flex align-items-center comment-infos-inner">
                                                            <span class="icon">
                                                                <img src="/public/img/comment-repeat-icon.png" alt="icon">
                                                            </span>
                <p class="font-main-bold font-16 mb-0 lh-1">{{ BBgetDateFormat($item->created_at) }}, {!! $item->body !!}</p>
            </div>
        </div>
    @else
        @if($item->author_id == Auth::id())
            <div class="d-flex justify-content-end comment-second">
                <div class="comment-second-info">
                    <div
                        class="d-flex font-16 comment-info-head comment-first-info-head">
                        <span>{{ $item->author->name ." ". $item->author->last_name }}, {{ BBgetTimeFormat($item->created_at) }}</span>
                    </div>

                    <div class="comment-info-text-wrap">
                        <p class="mb-0 lh-1 font-16">{!! $item->reply !!}</p>
                    </div>
                </div>
            </div>
        @else
            <div class="d-flex comment-first">
                <div class="user-photo">
                    <img src="{{ user_avatar($item->author->id) }}" alt="user"
                    class="ticket__tab-top-left-user-photo">
                    {{--<svg width="39px" height="39px" viewBox="0 0 39 39">--}}
                        {{--<path fill-rule="evenodd" fill="rgb(255, 255, 255)"--}}
                              {{--d="M33.289,25.211 C31.165,23.087 28.637,21.515 25.879,20.563 C28.833,18.529 30.773,15.124 30.773,11.273 C30.773,5.057 25.716,-0.000 19.500,-0.000 C13.284,-0.000 8.227,5.057 8.227,11.273 C8.227,15.124 10.167,18.529 13.121,20.563 C10.363,21.515 7.835,23.087 5.711,25.211 C2.028,28.895 -0.000,33.791 -0.000,39.000 L3.047,39.000 C3.047,29.928 10.428,22.547 19.500,22.547 C28.572,22.547 35.953,29.928 35.953,39.000 L39.000,39.000 C39.000,33.791 36.972,28.895 33.289,25.211 ZM19.500,19.500 C14.964,19.500 11.273,15.810 11.273,11.273 C11.273,6.737 14.964,3.047 19.500,3.047 C24.036,3.047 27.727,6.737 27.727,11.273 C27.727,15.810 24.036,19.500 19.500,19.500 Z"/>--}}
                    {{--</svg>--}}
                </div>
                <div class="comment-first-info">
                    <div
                        class="d-flex justify-content-between font-16 comment-info-head comment-first-info-head">
                        <span>{{ $item->author->name ." ". $item->author->last_name }}, {{ BBgetTimeFormat($item->created_at) }}</span>
                        <span class="comment-first-info-date">{{ BBgetDateFormat($item->created_at) }}</span>
                    </div>

                    <div class="bg-blue-clr comment-info-text-wrap">
                        <p class="mb-0 lh-1 font-16">
                            {!! $item->reply !!}
                        </p>
                    </div>
                </div>
            </div>
        @endif
    @endif
@endforeach
