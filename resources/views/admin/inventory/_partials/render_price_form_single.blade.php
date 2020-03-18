@php
    $vSettings = $variation->first();
@endphp
@if($vSettings->type == 'filter')
    @include("frontend.products._partials.variation_types.filter_popup")
@elseif($vSettings->type == 'single')
    @if(\View::exists("frontend.products._partials.single.$vSettings->display_as"))
        @include("frontend.products._partials.single.$vSettings->display_as")
    @endif
@elseif($vSettings->type == 'filter_discount')
    @include("frontend.products._partials.variation_types.discount_filter_popup")
@else
    @if(\View::exists("frontend.products._partials.variation_types.$vSettings->display_as"))
        @include("frontend.products._partials.variation_types.$vSettings->display_as")
    @endif
@endif


{{--<input type="hidden" value="" id="variation_uid">--}}
{{--@if(count($model->promotions))--}}
    {{--@foreach($model->promotions as $pkey => $promotion)--}}
        {{--@include('frontend.products._partials.render_promotion')--}}
    {{--@endforeach--}}
{{--@endif--}}

