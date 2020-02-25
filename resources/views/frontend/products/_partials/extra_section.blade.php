@if($vSettings->type == 'filter')
    <div class="product-single-info_row options-group">
        <div class="d-flex flex-wrap align-items-center {{$vSettings->type}}" data-group-id="{{ $vSettings->variation_id }}">
            @include("frontend.products._partials.variation_types.filter_popup")
        </div>
        <div class="product-single-info_row-items">
        </div>
    </div>
@else
    @if(\view::exists("frontend.products._partials.variation_types.$vSettings->display_as"))
        <div class="product-single-info_row options-group">
            <div class="d-flex flex-wrap align-items-center {{$vSettings->type}}" data-group-id="{{ $vSettings->variation_id }}">
                @include("frontend.products._partials.variation_types.$vSettings->display_as")
            </div>
            <div class="product-single-info_row-items">

            </div>
        </div>
    @endif
@endif
