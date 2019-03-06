<div class="order-summary">
    {!! Form::hidden('order_product_subtotal',\Cart::session(\App\Models\Orders::ORDER_NEW_SESSION_ID)->getSubTotal(),['id' => 'order_product_subtotal']) !!}
    <table class="table">
        <thead>
        <tr>
            <th align="left" colspan="2">Order Summary</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td align="left"><span>Sub Total</span></td>
            <td align="right" id="subtotal">
                ${!! \Cart::session(\App\Models\Orders::ORDER_NEW_SESSION_ID)->getSubTotal() !!}
            </td>
        </tr>
        <tr>
            <td align="left"><span>Tax</span></td>
            <td align="right" id="subtotal">$0</td>
        </tr>
        <tr>
            @php
                $shipping = (isset($geoZone) && $geoZone) ? \Cart::session(\App\Models\Orders::ORDER_NEW_SESSION_ID)->getCondition($geoZone->name) : null;
            @endphp
            <td align="left"><span>Shipping {!! ($shipping) ? '('.$shipping->getAttributes()->courier->name.')' : '' !!}</span></td>
            <td align="right" id="subtotal">${!! ($shipping) ? $shipping->getValue() : 0 !!}</td>
        </tr>
        <tr>
            @php
                $c = \Cart::session(\App\Models\Orders::ORDER_NEW_SESSION_ID)->getConditionsByType('coupon');
            @endphp
            <td align="left"><span>Discount ({{ ($c && count($c)) ? $c->first()->getName() : 'Coupon' }})</span></td>
            <td align="right" id="discount">{{ ($c && count($c)) ? $c->first()->getValue() : 0 }}</td>
        </tr>
        <tr>
            <td class="last" align="left"><span>Total</span></td>
            <td class="last" align="right" id="total_price">
                ${!! \Cart::session(\App\Models\Orders::ORDER_NEW_SESSION_ID)->getTotal() !!}
            </td>
        </tr>
        </tbody>
    </table>
</div>