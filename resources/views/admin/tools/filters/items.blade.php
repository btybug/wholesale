@foreach($items as $items)
    <li data-id="{{ $items->id }}"
        class="option-elm-attributes col-md-3">
        <div class="wrap-item">
            <a href="#">
                <span><img src="{!! url($items->image) !!}" alt=""></span>
                <span class="name">{!! $items->name !!}</span>
            </a>
            <input type="hidden" name="stocks[]" value="{{ $items->id }}">
        </div></li>
@endforeach

