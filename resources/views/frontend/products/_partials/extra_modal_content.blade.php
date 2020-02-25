@php
    $variations = collect($variations)->groupBy('variation_id');
@endphp
<div class="d-flex">
    <div class="col-sm-2 pl-0">
        <div class="extra-content-left main-scrollbar">

            <ul class="list-unstyled">
                @if(count($variations))
                    @foreach($variations as $variation)
                        @php
                            $vSettings = $variation->first();
                           if($loop->first){
                               $firstRender = $vSettings;
                           }

                        @endphp
                        <li>
                            <div data-id="{{ $product->id }}" data-group="{{ $vSettings->variation_id }}" class="select-extra item @if($loop->first) active @endif">
                                <span>{{ $vSettings->title }}</span>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
    <div class="col-sm-10 p-0">
        <div class="extra-content-right d-flex flex-column">
            <div class="extra-main-content main-scrollbar">
                @include("frontend.products._partials.extra_section",['vSettings' => @$firstRender])
            </div>
            <div class="modal-footer">
                <button
                   class="product-card_btn d-inline-flex align-items-center justify-content-between text-center font-15 text-sec-clr text-uppercase" style=" cursor:pointer">
                    <span class="product-card_btn-text">add to cart</span>
                    <span class="d-inline-block ml-auto">
                        <svg viewBox="0 0 18 22" width="18px" height="22px">
                            <path fill-rule="evenodd" opacity="0.8" fill="rgb(255, 255, 255)"
                                  d="M14.305,3.679 L14.305,0.003 L3.694,0.003 L3.694,3.679 L-0.004,3.679 L-0.004,21.998 L18.003,21.998 L18.003,3.679 L14.305,3.679 ZM4.935,1.216 L13.064,1.216 L13.064,3.679 L4.935,3.679 L4.935,1.216 ZM16.761,20.785 L1.238,20.785 L1.238,4.891 L3.694,4.891 L3.694,7.329 L4.935,7.329 L4.935,4.891 L13.064,4.891 L13.064,7.329 L14.305,7.329 L14.305,4.891 L16.761,4.891 L16.761,20.785 Z"></path>
                        </svg>
                    </span>
                </button>
                <button
                   class="product-card_edit d-none align-items-center justify-content-between text-center font-15 text-sec-clr text-uppercase " disabled>
                    <span class="product-card_btn-text">Added</span>
                    <span class="d-inline-block ml-auto">
                        <i class="fas fa-check"></i>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
