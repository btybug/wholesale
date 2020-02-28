<div class="row">
    <div class="col-md-3">
        <div class="user-img-name">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRIz-Vq2guLXBClPdqx9lLCN7lrSO_sSirya67ETwY4Zq4gXc9U"
                 alt="product">
            <div class="name">{{ ($user) ? $user->name . ' ' . $user->last_name :'No selected' }}</div>
        </div>
    </div>
    @php
        $billing_address = ($user) ? $user->addresses()->where('type','billing_address')->first() : null;
        $default_shipping = ($user) ? $user->addresses()->where('type','default_shipping')->first() : null;
    @endphp
    <div class="col-md-3">
        <div class="billing-address">
            <div class="address-head">
                Billing address
            </div>
        </div>
        <div class="col-md-12">
            @if($billing_address)
                Country:{!! @getCountryByZone($billing_address->country)->name !!}<br>
                Region:{!! getRegion($billing_address->region,'name')  !!}
                <br>
                First line:{!! $billing_address->first_line_address !!}<br>
                Second line:{!! $billing_address->second_line_address !!}
                Post code:{!! $billing_address->post_code !!}
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="shipping-address">
            <div class="address-head">
                Shipping address
            </div>
        </div>
        <div class="col-md-12">
            @if($default_shipping)
                Country:{!! @getCountryByZone($default_shipping->country)->name  !!}<br>
                Region:{!! getRegion($default_shipping->region,'name')  !!}<br>
                City:{!! $default_shipping->city !!}<br>
                First line:{!! $default_shipping->first_line_address !!}<br>
                Second line:{!! $default_shipping->second_line_address !!}
                Post code:{!! $default_shipping->post_code !!}
            @endif
        </div>
    </div>
    <div class="col-md-3">

    </div>
</div>