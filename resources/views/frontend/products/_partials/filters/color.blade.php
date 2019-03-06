<div class="filter-wall colors row">
    <h5 class="font-sec-bold font-16 text-uppercase col-4 p-lg-0 px-3 text-lg-left text-right">{{ $filter->name }}</h5>
    <div class="col-8 p-sm-0">
        <div class="d-flex flex-wrap">
            @foreach($filter->stickers as $sticker)
                <div class="col-xl-3 col-lg-4 col-md-3 col-4 single-wall">
                    <div class="custom-control custom-radio custom-control-inline" style="position: relative">
                        {!! Form::radio("select_filter[$filter->id]",$sticker->id,null,['class' => 'custom-control-input','id' => 'customColor'.$filter->id.$sticker->id]) !!}
                        <label class="custom-control-label pointer position-relative"
                               for="customColor{{ $filter->id.$sticker->id }}" style="background: {{ $sticker->color }}">

                            <span class="d-inline-block custom-control-label-txt text-capitalize position-absolute"> {{ $sticker->name }}</span>

                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
