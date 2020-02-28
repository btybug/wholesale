
<div class="del-save--btn">
    @if($parent)
        <div class="form-group m-r-5">
            <a class="btn btn-danger delete-button text-white" data-key="{{ $child_id }}"
               data-href="{!! route('post_admin_tools_filters_delete') !!}">Delete</a>
        </div>
    @endif
    <div class="form-group">
        {!! Form::submit('Save',['class' => 'btn btn-info btn-submit-form']) !!}
    </div>
</div>
@php
    $parents=\App\Models\Filters::fullBrodcrumpsLists($child_id)->toArray();
@endphp
{!! Form::model($child,['url'=>route('post_admin_tools_filters_add_child',(($parent)?$parent->id:$category->id)),'class' => 'updated-form']) !!}
{!! Form::hidden('id',null) !!}
@if($category)
    {!! Form::hidden('category_id',$category->id) !!}
@endif
{!! Form::hidden('child_id',($child)?$child->id:null) !!}
@if(count(get_languages()))
    <ul class="nav nav-tabs">
        @foreach(get_languages() as $language)
            <li class="nav-item"><a class="nav-link @if($loop->first) active @endif" data-toggle="tab"
                                    href="#{{ strtolower($language->code) }}">
                    <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                </a></li>
        @endforeach
    </ul>
@endif


<div class="tab-content">
    @if(count(get_languages()))
        @foreach(get_languages() as $language)
            <div id="{{ strtolower($language->code) }}" class="tab-pane fade  @if($loop->first) in active show @endif">
                <div class="form-group row mt-10">
                    <label class="col-xl-2 col-lg-4 col-md-12 col-sm-3 col-form-label">Filter Name</label>
                    <div class="col-xl-10 col-lg-8 col-md-12 col-sm-9">
                        {!! Form::text('translatable['.strtolower($language->code).'][name]',($child)?get_translated($child,strtolower($language->code),'name'):null,['class'=>'form-control','required'=>true]) !!}
                    </div>

                </div>
                <div class="form-group row mt-10">
                    <label class="col-xl-2 col-lg-4 col-md-12 col-sm-3 col-form-label">First child label</label>

                    <div class="col-xl-10 col-lg-8 col-md-12 col-sm-9">
                        {!! Form::text('translatable['.strtolower($language->code).'][first_child_label]',($child)?get_translated($child,strtolower($language->code),'first_child_label'):null,['class'=>'form-control']) !!}
                    </div>

                </div>
            </div>
        @endforeach
    @endif
</div>
<div class="form-group row mt-10">
    <label class="col-xl-2 col-lg-4 col-md-12 col-sm-3 col-form-label">Parent</label>

    <div class="col-xl-10 col-lg-8 col-md-12 col-sm-9">
        {!! Form::select('parent_id',[(($parent)?$parent->id:null)=>'Current Filter']+$parents,(($parent)?$parent->id:null),['class'=>'form-control','required'=>true]) !!}
    </div>

</div>

<div class="form-group">
    <div class="row">
        <label for="feature_image"
               class="col-xl-2 col-lg-4 col-md-12 col-sm-3 col-form-label">image</label>
        <div class="col-xl-10 col-lg-8 col-md-12 col-sm-9">
            {!! media_button('image',(($child)?$child:null)) !!}
        </div>
    </div>
</div>
@if(!$child ||  !$child->children()->exists())
    <div class="card panel panel-default mt-20 releted__products-panel">
        <div class="card-header panel-heading d-flex justify-content-between align-items-center">
                                        <span>
                                            Related Items
                                        </span>
            <button type="button" class="btn btn-primary select-products" data-id="{!! $child_id !!}"><i
                    class="fa fa-plus fa-sm mr-10"></i>Add Items
            </button>
        </div>
        <div class="card-body panel-body product-body">
            <ul class="get-all-attributes-tab row">
                @if(isset($child) && count($child->items))
                    @foreach($child->items as $items)
                        <li data-id="{{ $items->id }}"
                            class="option-elm-attributes col-md-3">
                            <div class="wrap-item">
                                <a href="#">
                                    <span><img src="{!! url($items->image) !!}" alt=""></span>
                                    <span class="name">{!! $items->name !!}</span>
                                </a>
                                <div class="buttons">
                                    <a href="javascript:void(0)"
                                       class="remove-all-attributes btn btn-sm btn-danger detach-item"
                                       data-key="{{ $items->id }}"
                                       data-href="{!! route('post_admin_tools_filters_detach_item',$child_id) !!}">
                                        <i class="fa fa-trash"></i></a>
                                </div>
                                <input type="hidden" name="items[]" value="{{ $items->id }}">
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
@endif
{!! Form::close() !!}

