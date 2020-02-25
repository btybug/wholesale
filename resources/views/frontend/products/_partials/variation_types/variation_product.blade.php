<div class="col-sm-10 pl-0">
    @foreach($model->type_attrs as $modelattr)
        @php
            $options = $model->type_attrs_pivot()->with('sticker')->where('attributes_id',$modelattr->id)->get();
        @endphp

        @if(\View::exists('frontend.products._partials.single.'.$modelattr->pivot->type))
            @include('frontend.products._partials.single.'.$modelattr->pivot->type)
        @endif
    @endforeach
</div>
<div class="col-sm-2 pl-sm-3 p-0 text-sm-center">

    <span class="d-inline-block font-35 font-sec-bold text-uppercase ml-auto price-place"></span>
</div>


