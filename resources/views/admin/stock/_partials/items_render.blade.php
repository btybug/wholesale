@if(count($items))
    @foreach($items as $item)
        <li data-id="{{ $item->id }}" data-name="{{ $item->name }}" class="col-lg-2 col-md-3 col-sm-6 option-elm-modal searchable">
            <div class="single-item">
                <div class="img-item">
                    <img src="{{ (media_image_tmb($item->image)) }}" class="img-fluid" alt="img">
                </div>
                <div class="name-item">
                    <span>{{ $item->name }}</span>
                </div>
            </div>
        </li>
    @endforeach
@endif


