<div class="row">
    <div class="col-md-3">
        @if(count($model->children))
            @foreach($model->children as $item)
                <div class="form-group row bord-top bg-light attr-option" data-item-id="{!! $item->id !!}" data-parent-id="{!! $model->id !!}">
                    <div class="col-md-8">
                        {!! $item->name !!}
                    </div>
                    <div class="col-md-4 text-right">
                        {{--<a href="javascript:void(0)" class="btn btn-sm btn-danger" data-item-id="{!! $item->id !!}"><i class="fa fa-trash"></i></a>--}}
                    </div>
                </div>
            @endforeach
        @else
            No Options
        @endif
        <div class="form-group row bord-top">
            {!! Form::model($optionModel,['url' => route('admin_store_attributes_options',$model->id)]) !!}
            {!! Form::hidden('id',null) !!}
            {!! Form::hidden('parent_id',$model->id) !!}
            <div class="col-md-8">
                {!! Form::text('translatable['.strtolower(get_default_language()->code).'][name]',null,['class'=>'form-control']) !!}
            </div>
            <div class="col-md-4 text-right">
                {!! Form::submit('Add',['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="col-md-9 options-form">
        {{--@include('admin.inventory.attributes.options_form')--}}
    </div>
</div>


