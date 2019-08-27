<div class="col-md-3 special-offer-item" data-id="{{ $offer->id }}">
    <input type="hidden"
           name="offer_products[]"
           value="{{ $offer->id }}">
    <div class="col-md-12">
        <img src="{{ $offer->image }}" width="200px" class="img img-responsive">
    </div>
    <div class="col-md-12">
        <p>{!! $offer->name !!}</p>
        <p>{!! $offer->short_description !!}</p>
        <button type="button" class="delete-offer btn btn-danger">Delete</button>
    </div>
</div>
