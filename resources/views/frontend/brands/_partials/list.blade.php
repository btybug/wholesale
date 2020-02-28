@if(count($brands))
    @foreach($brands as $brand)
        <li>
            <a href="javascript:void(0)" data-id="{{ $brand->id }}" data-slug="{{ $brand->slug }}" class="brands_aside-item-link @if($current && $brand->id == $current->id) active @endif">
                <div>
                    <span class="brands_aside-name">{{ $brand->name }}</span>
                    <span class="brands_aside-amount">({{ $brand->products()->count() }})</span>
                </div>
            </a>
        </li>
    @endforeach
@endif
