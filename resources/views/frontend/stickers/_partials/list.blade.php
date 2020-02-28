@if(count($stickers))
    @foreach($stickers as $sticker)
        <li>
            <a href="javascript:void(0)" data-id="{{ $sticker->slug }}" class="brands_aside-item-link @if($current && $sticker->id == $current->id) active @endif">
                <div>
                    <span class="brands_aside-name">{{ $sticker->name }}</span>
                    <span class="brands_aside-amount">({{ $sticker->products()->count() }})</span>
                </div>
            </a>
        </li>
    @endforeach
@endif
