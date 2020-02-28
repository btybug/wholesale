<div
    class="d-flex justify-content-between align-items-center brands_main-content-products-top">
    <div class="left-wrapper">
        <select class="form-control list-tabs product-category" data-id="{!! $current->id !!}">
            @foreach($stockCategories as $key=>$category)
                <option value="{!! $key !!}" @if($key==$f) selected @endif>
                    {!! $category !!}
                </option>
            @endforeach
        </select>

    </div>
    <div class="right-wrapper">
        <div
            class="right-head d-flex flex-wrap justify-content-lg-end justify-content-between">
            <div class="product-grid-list align-self-center">
                    <span class="d-inline-block products-filter-wrap_display-icons">
            <span id="dispGrid" class="d-inline-block pointer display-icon grid active">
<svg
    xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    width="15px" height="15px"
    viewBox="0 0 15 15">
<path fill-rule="evenodd" fill="rgb(188, 188, 188)"
      d="M13.769,8.730 C13.090,8.730 12.539,8.179 12.539,7.500 C12.539,6.821 13.090,6.270 13.769,6.270 C14.448,6.270 14.998,6.821 14.998,7.500 C14.998,8.179 14.448,8.730 13.769,8.730 ZM13.769,2.462 C13.090,2.462 12.539,1.911 12.539,1.232 C12.539,0.553 13.090,0.003 13.769,0.003 C14.448,0.003 14.998,0.553 14.998,1.232 C14.998,1.911 14.448,2.462 13.769,2.462 ZM7.501,14.997 C6.822,14.997 6.271,14.447 6.271,13.768 C6.271,13.089 6.822,12.538 7.501,12.538 C8.180,12.538 8.730,13.089 8.730,13.768 C8.730,14.447 8.180,14.997 7.501,14.997 ZM7.501,8.730 C6.822,8.730 6.271,8.179 6.271,7.500 C6.271,6.821 6.822,6.270 7.501,6.270 C8.180,6.270 8.730,6.821 8.730,7.500 C8.730,8.179 8.180,8.730 7.501,8.730 ZM7.501,2.462 C6.822,2.462 6.271,1.911 6.271,1.232 C6.271,0.553 6.822,0.003 7.501,0.003 C8.180,0.003 8.730,0.553 8.730,1.232 C8.730,1.911 8.180,2.462 7.501,2.462 ZM1.233,14.997 C0.554,14.997 0.004,14.447 0.004,13.768 C0.004,13.089 0.554,12.538 1.233,12.538 C1.912,12.538 2.462,13.089 2.462,13.768 C2.462,14.447 1.912,14.997 1.233,14.997 ZM1.233,8.730 C0.554,8.730 0.004,8.179 0.004,7.500 C0.004,6.821 0.554,6.270 1.233,6.270 C1.912,6.270 2.462,6.821 2.462,7.500 C2.462,8.179 1.912,8.730 1.233,8.730 ZM1.233,2.462 C0.554,2.462 0.004,1.911 0.004,1.232 C0.004,0.553 0.554,0.003 1.233,0.003 C1.912,0.003 2.462,0.553 2.462,1.232 C2.462,1.911 1.912,2.462 1.233,2.462 ZM13.769,12.538 C14.448,12.538 14.998,13.089 14.998,13.768 C14.998,14.447 14.448,14.997 13.769,14.997 C13.090,14.997 12.539,14.447 12.539,13.768 C12.539,13.089 13.090,12.538 13.769,12.538 Z"/>
</svg>
            </span>
            <span id="displVertBtn" class="d-inline-block pointer list display-icon">
<svg
    width="15px" height="15px"
    viewBox="0 0 15 15">
<path fill-rule="evenodd" opacity="0.502" fill="rgb(121, 121, 121)"
      d="M0.011,15.000 L0.011,13.586 L15.004,13.586 L15.004,15.000 L0.011,15.000 ZM0.011,6.791 L15.004,6.791 L15.004,8.205 L0.011,8.205 L0.011,6.791 ZM0.011,-0.004 L15.004,-0.004 L15.004,1.410 L0.011,1.410 L0.011,-0.004 Z"/>
</svg>
            </span>
        </span>
            </div>
            <div
                class="sort-by_select sort-by-products d-flex align-items-center position-relative border-0 new-sort-by_select">
                <label for="sortBy" class="text-main-clr mb-0 text-uppercase">{!! __('sort_by') !!}: </label>
                <div class="select-wall">
                    {!! Form::select('sort_by',[
                                     'newest' => __('newest'),
                                     'oldest' => __('oldest'),
                                     'price_desc' => __('price_high'),
                                     'price_asc' => __('price_low'),
                                 ],(\Request::has('sort_by')) ? \Request::get('sort_by') : null,[
                                     'id' => 'sortBy',
                                     'class' => 'select-filter select-2 select-2--no-search main-select products-filter-wrap_select not-selected arrow-dark',
                                     'style' => 'width: 100%',
                                 ]) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="brands_main-content-products">
    <ul class="row brands_products__list-wrapper products__all-list-product">
        @if($products->count())
            @foreach($products as $product)
                @include("frontend.products._partials.products_item")
            @endforeach
        @endif
    </ul>
</div>
