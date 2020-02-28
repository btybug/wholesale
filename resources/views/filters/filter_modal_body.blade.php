<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="wizardAll-tab" data-toggle="tab" href="#wizardAll" role="tab"
           aria-controls="wizardAll" aria-selected="true">All</a>
    </li>
    @foreach($filters as $key => $filter)
        <li class="nav-item">
            <a class="nav-link" id="wizardItem{{ $key }}-tab" data-toggle="tab" href="#wizardItem{{ $key }}" role="tab"
               aria-controls="wizardItem{{ $key }}" aria-selected="false">{{ $filter->name }}</a>
        </li>
    @endforeach
</ul>
<div class="tab-content main-scrollbar" id="myTabContent">
    <div class="tab-pane fade show active" id="wizardAll" role="tabpanel" aria-labelledby="wizardAll-tab">
        <div class="shopping-cart_wrapper p-0">
            <div class="content-wrap shoping-card">
                <ul class="row content">
                    @foreach($variations as $item)
                        <li class="col-lg-2 col-md-3 col-sm-6" data-id="{{ $item->id }}" data-name="{{ $item->item->short_name }}">
                            <div class="item-content">
                                <div class="item-photo">
                                    <img src="{{ media_image_tmb($item->image) }}" alt="photo">
                                </div>
                                <div class="item-title">
                                    <span>{!! $item->item->short_name !!}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @foreach($filters as $key => $filter)
        <div class="tab-pane fade" id="wizardItem{{ $key }}" role="tabpanel" aria-labelledby="wizardItem{{ $key }}-tab">
            <div class="shopping-cart_wrapper p-0">
                <div class="content-wrap shoping-card">
                    <ul class="row content">
                        @foreach($filter->items as $item)
                            @php
                            $item = \App\Models\StockVariation::where('variation_id',$group)->where('item_id',$item->id)->first();
                            @endphp
                            @if($item)
                            <li class="col-lg-2 col-md-3 col-sm-6" data-id="{{ $item->id }}" data-name="{{ $item->item->short_name }}">
                                <div class="item-content">
                                    <div class="item-photo">
                                        <img src="{{ media_image_tmb($item->image) }}" alt="photo">
                                    </div>
                                    <div class="item-title">
                                        <span>{!! $item->item->short_name !!}</span>
                                    </div>
                                </div>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
