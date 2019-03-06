<div class="form-group row select_with-tag-wrapper position-relative">

    <label for="deliverySelect{{ $filter->id }}"
           class="text-main-clr mb-0 col-4 col-form-label text-right text-uppercase">{{ $filter->name }}</label>
    <div class="simple_select_wrapper col-8 p-sm-0">
        @php
            $dataOptions = $filter->stickers->pluck('name','id')->toArray();
        @endphp
        {!! Form::select("select_filter[$filter->id]",['' => "Select"] + $dataOptions,null,['class' => 'select-2 select-2--no-search main-select main-select-2arrows not-selected arrow-dark','id' => 'deliverySelect'.$filter->id] ) !!}
    </div>
</div>