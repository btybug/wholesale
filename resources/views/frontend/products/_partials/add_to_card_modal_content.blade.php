<div class="product-single-info-outer">
    <div class="product-single-info">
        <div class="d-flex align-items-center single-product-main-title">
            <h2 class="font-36 mb-0">{!! $model->name !!}</h2>
        </div>
        <input type="hidden" value="{{ $model->id }}" id="vpid">
        <div class="d-flex flex-wrap">
            <div class="col-md-4 product-card d-block">
                <div class="product-single-view-outer product-card_view product-card_view--single position-relative">
                    @if($model->image)
                        <div>
                            <img class="single-product_top-img card-img-top" src="{!! $model->image !!}"
                                 alt="{!! @getImage( $model->image)->seo_alt !!}">
                        </div>
                    @endif
                </div>
                <div class="d-flex product-card-thumbs product-card-thumbs--single">
                    @if($model->image)
                        <div class="product-card_thumb-img-holder pointer active_slider">
                            <img class="" src="{!! $model->image !!}"
                                 alt="{!! @getImage( $model->image)->seo_alt !!}">
                        </div>
                    @endif
                    @if($model->variations && count($model->variations))
                        @foreach($model->variations as $variation)
                            @if($variation->image)
                                <div class="product-card_thumb-img-holder pointer">
                                    <img class="" src="{{$variation->image}}"
                                         alt="{!! @getImage($variation->image)->seo_alt !!}">
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                @include("admin.inventory._partials.render_price_form")
            </div>
        </div>
    </div>
</div>