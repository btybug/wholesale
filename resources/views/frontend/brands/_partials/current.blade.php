<div class="d-flex flex-wrap justify-content-between align-items-center stickers__right-top">
    <div class="d-flex align-items-center left">
        <img src="{!! $current->image !!}" alt="brand">
        <h2 class="font-sec-reg lh-1 font-28 mb-0">{!! $current->name !!}</h2>
    </div>
    <div class="right">
        <span class="font-sec-reg lh-1 font-28">{{ $current->products->count() }} Products</span>
    </div>
</div>
<div class="brands-stickers-text--desc">
    {!! $current->description !!}
</div>
<div class="brands_main-content-products-wrapper" id="sticker_related_products_list">
    @include('frontend.brands._partials.products')
</div>


