<div class="col-md-4">
    <p>{!! $address->first_line_address !!}</p>
    <p>{!! $address->second_line_address !!}</p>
    <p>{!! getCountryByZone($address->country)->name !!}, {!! $address->city !!}</p>
    <p>{!! getCountryByZone($address->country)->region->name !!}</p>
    <p>{!! $address->post_code !!}</p>
</div>