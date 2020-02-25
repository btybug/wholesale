<div class="filter-wall colors">
    {{--<h5 class="font-sec-bold font-16 text-uppercase col-4 p-lg-0 px-3 text-lg-left text-right">{{ $filter->name }}</h5>--}}
    <div>
        <div class="d-flex flex-wrap">
            @foreach($filter->stickers as $sticker)
                <div class="col-md-6 col-6 pl-0 single-wall">
                    <div class="custom-control custom-radio custom-control-inline" style="position: relative">
                        {!! Form::radio("select_filter[$filter->id]",$sticker->id,null,['class' => 'custom-control-input','id' => 'customColor'.$filter->id.$sticker->id]) !!}
                        <label class="custom-control-label pointer position-relative"
                               for="customColor{{ $filter->id.$sticker->id }}">
<span class="color-label-custom" style="background: {{ $sticker->color }}"></span>
                            <span class="d-inline-block custom-control-label-txt text-capitalize position-absolute"> {{ $sticker->name }}</span>

                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
