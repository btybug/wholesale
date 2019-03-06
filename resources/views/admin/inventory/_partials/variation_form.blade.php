{!! Form::model($model,['id' => 'variation_form']) !!}
@if(isset($variationId))
{!! Form::hidden('vID',$variationId,['id' => 'vId']) !!}
@endif
<div class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if(count($data))
                    @foreach($data as $key => $items)
                        <div class="col-md-4">
                            {!! Form::hidden("options[$key][attributes_id]",$key,['class' => 'option-class']) !!}
                            <div class="form-group">
                                @php
                                    $selectedValue = null;
                                @endphp
                                @if(isset($model['options'][$loop->index ]) && $model['options'][$loop->index ]['attributes_id'] == $key)
                                    @php $selectedValue = $model['options'][$loop->index ]['options_id']; @endphp
                               @endif
                               <label>{{ \App\Models\Attributes::getById($key) }} {{ $loop->index }}</label>
                               <select name="options[{{ $key }}][options_id]" class="form-control option-class">
                                   @foreach($items as $option)
                                       <option {{ ($selectedValue == $option) ? 'selected' : '' }} value="{{ $option }}">{{ \App\Models\Attributes::getById($option) }}</option>
                                   @endforeach
                               </select>

                           </div>
                       </div>
                   @endforeach

               @endif
           </div>
            <div class="col-md-12 errors option-error"></div>
           <div class="col-md-12">
               <div class="form-group">
                   <div class="row">
                       <div class="col-md-6 col-xs-12">
                           <div class="row">
                               <label for="variation_id"
                                      class="control-label col-sm-4">Name</label>
                               <div class="col-sm-8">
                                   {!! Form::text('name',null,['id' => 'variation_name','class' => 'form-control']) !!}
                                   <div class="errors name-error"></div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="form-group">
                   <div class="row">
                       <div class="col-md-6 col-xs-12">
                           <div class="row">
                               <label for="variation_id"
                                      class="control-label col-sm-4">SKU number</label>
                               <div class="col-sm-8">
                                   {!! Form::text('variation_id',null,['id' => 'variation_id','class' => 'form-control']) !!}
                                   <div class="errors sku-error"></div>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-6 col-xs-12">
                           <div class="row">
                               <label for="variation_image"
                                      class="control-label col-sm-4">Image</label>
                               <div class="col-sm-8">
                                   {!! media_button('image',$model) !!}
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="form-group">
                   <div class="row">
                       <div class="col-md-6 col-xs-12">
                           <div class="row">
                               <label for="variation_quantity"
                                      class="control-label col-sm-4">Quantity</label>
                               <div class="col-sm-8">
                                   {!! Form::number('qty',null,['id' => 'variation_qty','class' => 'form-control','min' => '0']) !!}
                               </div>
                           </div>
                       </div>
                       <div class="col-md-6 col-xs-12">
                           <div class="row">
                               <label for="variation_quantity"
                                      class="control-label col-sm-4">Price</label>
                               <div class="col-sm-8">
                                   {!! Form::text('price',null,['id' => 'variation_price','class' => 'form-control']) !!}
                                   <div class="errors price-error"></div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
{!! Form::close() !!}