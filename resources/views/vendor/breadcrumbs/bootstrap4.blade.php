@if (count($breadcrumbs))
    <div class="page-back">
        <a href="{{ get_breadcrumb_previous_url($breadcrumbs) }}">
        <span class="back-icon"><svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="22px" height="9px">
<path fill-rule="evenodd" fill="rgb(53, 53, 53)"
      d="M21.998,3.382 L5.929,3.382 L5.929,0.000 L0.004,4.500 L5.929,9.000 L5.929,5.617 L21.998,5.617 L21.998,3.382 Z"/>
</svg></span>
        </a>
    </div>
    <div class="breadcrumbs-page font-13">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @foreach ($breadcrumbs as $breadcrumb)

                    @if ($breadcrumb->url && !$loop->last)
                        <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                    @else
                        <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                    @endif

                @endforeach
            </ol>
        </nav>
    </div>
@endif

{{--<div class="page-back">--}}
    {{--<a href="#">--}}
        {{--<span class="back-icon"><svg--}}
                    {{--xmlns="http://www.w3.org/2000/svg"--}}
                    {{--xmlns:xlink="http://www.w3.org/1999/xlink"--}}
                    {{--width="22px" height="9px">--}}
{{--<path fill-rule="evenodd" fill="rgb(53, 53, 53)"--}}
      {{--d="M21.998,3.382 L5.929,3.382 L5.929,0.000 L0.004,4.500 L5.929,9.000 L5.929,5.617 L21.998,5.617 L21.998,3.382 Z"/>--}}
{{--</svg></span>--}}
    {{--</a>--}}
{{--</div>--}}
{{--<div class="breadcrumbs-page font-13">--}}
    {{--<nav aria-label="breadcrumb">--}}
        {{--<ol class="breadcrumb">--}}
            {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
            {{--<li class="breadcrumb-item"><a href="#">Products</a></li>--}}
            {{--<li class="breadcrumb-item active" aria-current="page">Vapes</li>--}}
        {{--</ol>--}}
    {{--</nav>--}}

{{--</div>--}}

