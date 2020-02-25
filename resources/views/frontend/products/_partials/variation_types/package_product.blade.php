<div class="col-md-12">
   <h3>Select {{ $model->variations->first()->count_limit }} items</h3>
</div>
@foreach($model->variations as $variation)
    <div class="col-md-3">
        <img src="{{ (media_image_tmb($variation->image)) }}" class="img img-responsive" width="100"/>
        <input type="checkbox" id="pv{{ $variation->id }}" class="custom-control-input package_checkbox"
               name="package_v[{{ $model->id }}][]"  value="{{ $variation->id }}" >
        <label class="product-single-info_check-label custom-control-label font-15 text-gray-clr pointer package_checkbox_label" for="pv{{ $variation->id }}">{{ $variation->name }}</label>
    </div>
@endforeach
