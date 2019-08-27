@foreach($items as $item)
    <li class="col-md-3" >
        <div class="wrap-item position-relative" data-out="{{ out_of_stock($item) }}" data-id="{!! $item->id !!}" data-price="{!! convert_price($item->price,$currency,false,true) !!}">
            <a href="#" class="item-link">
                <span class="item-img">
                    <img src="{!! $item->image !!}"
                         alt="item">
                </span>
                <span class="name">
                    {!! $item->name !!}
                     <b>{{ out_of_stock_msg($item) }}</b>
                </span>
            </a>
        </div>
    </li>
@endforeach
