<div class="filter-wall cat-name row">
    {{--<h5 class="font-sec-bold font-16 text-uppercase col-4 p-lg-0 px-3 text-lg-left text-right">{{ $filter->name }}</h5>--}}
    <div class="col-12 p-sm-0">
        @foreach($filter->stickers as $sticker)
            <div class="single-wrap">
                <div class="custom-control custom-radio custom-control-inline align-items-center radio--packs">
                    {!! Form::radio("select_filter[$filter->id]",$sticker->id,null,['class' => 'custom-control-input','id' => 'customRadio'.$filter->id.$sticker->id]) !!}
                    <label class="product-single-info_radio-label custom-control-label text-gray-clr font-15"
                           for="customRadio{{ $filter->id.$sticker->id }}">{{ $sticker->name }}
                        {{--<span class="amount">(189)</span>--}}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>
