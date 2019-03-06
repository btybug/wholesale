<div class="form-group row select_with-tag-wrapper position-relative">

    <label for="fieldTitle{{ $filter->id }}"
           class="text-main-clr mb-0 col-4 col-form-label text-right text-uppercase">{{ $filter->name }}</label>
    <div class="field-title_select col-8 p-sm-0 position-relative">
        @php
            $dataOptions = $filter->stickers->pluck('name','id')->toArray();
        @endphp
        {!! Form::select("select_filter[$filter->id][]",$dataOptions,null,
        ['class' => 'select-2 main-select main-select-2arrows products-filter-wrap_select not-selected select_with-tag','multiple' => true,'id' => 'fieldTitle'.$filter->id] ) !!}
        <span class="arrow-select"><b></b></span>
    </div>
</div>