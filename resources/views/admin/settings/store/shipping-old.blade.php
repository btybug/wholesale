@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item ">
                <a class="nav-link" id="general-tab" href="{!! route('admin_settings_store') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">General</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" id="shipping-tab" href="{!! route('admin_settings_shipping') !!}" role="tab"
                   aria-controls="shipping" aria-selected="false">Shipping</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" id="payment_gateways" href="{!! route('admin_settings_payment_gateways') !!}" role="tab"
                   aria-controls="shipping" aria-selected="false">Payment gateways</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" id="payment_gateways" href="{!! route('admin_settings_couriers') !!}"
                   role="tab"
                   aria-controls="shipping" aria-selected="false">Courier </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" id="payment_gateways" href="{!! route('admin_settings_delivery') !!}"
                   role="tab"
                   aria-controls="shipping" aria-selected="false">Delivery Cost</a>
            </li>
        </ul>
        <div class="" id="myTabContent">
        {{--<table id="discount" class="table table-responsive table--store-settings">
                    <tbody class="all-options">
                    <tr>
                        <td>
                            <label for="ShippingZones">Shipping to</label>
                        </td>
                        <td>
                            <select id="ShippingZones" class="form-control">
                                <option selected>Shipping Zones</option>
                                @foreach($shipping_zones as $zone)
                                    <option value="{!! $zone->tax !!}" >{!! $zone->name !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="text-right">
                            <button type="button" class="btn btn-primary add-new-option"><i
                                        class="fa fa-plus-circle"></i></button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-responsive table--store-settings">
                <tr class="bg-my-light-blue">
                        <td>Shipping Zone - <span id="shipzone">Armenia</span></td>
                        <td colspan="5">Tax Rate - <span id="taxzone">ArmeniaVaT20</span></td>
                    </tr>
                    <tbody>
                    
                    <tr class="bg-my-light-pink">
                        <th>Order Amount</th>
                        <th>Courier</th>
                        <th>Cost</th>
                        <th colspan="3">Time</th>
                    </tr>
                    <tr>
                        <td class="table--store-settings_vert-top">
                            <input type="number" min="1" max="5" class="form-control"
                                   style="display: inline-block; width: auto">
                            <span>To</span>
                            <input type="number" min="1" max="50" class="form-control"
                                   style="display: inline-block; width: auto">
                        </td>
                        <td>
                            <select id="PosType" class="form-control">
                                <option selected>Normal Post</option>
                                <option>...</option>
                            </select>
                        </td>
                        <td>
                            <span class="form-control">
                                5
                            </span>
                        </td>
                        <td>
                            <span class="form-control">
                                3 days
                            </span>
                        </td>
                        <td colspan="2" class="text-right">
                            <button type="button" class="btn btn-danger remove-ship-filed"><i
                                        class="fa fa-minus-circle"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <select id="dhl" class="form-control">
                                <option selected>DHL</option>
                                <option>...</option>
                            </select>
                        </td>
                        <td>
                            <span class="form-control">
                                5
                            </span>
                        </td>
                        <td>
                            <span class="form-control">
                                1 day
                            </span>
                        </td>
                        <td colspan="2" class="text-right">
                            <button type="button" class="btn btn-danger remove-ship-filed"><i
                                        class="fa fa-minus-circle"></i></button>
                        </td>
                    </tr>
                    <tr class="add-new-ship-filed-container">
                        <td colspan="6" class="text-right">
                            <button type="button" class="btn btn-primary add-new-ship-filed"><i
                                        class="fa fa-plus-circle"></i></button>
                        </td>
                    </tr>
                    </tbody>

                    <tfoot>
                    
                 
                    <tr>
                        <td colspan="5" class="text-center table--store-settings_add-options add-new-order-filed">
                            <span><i class="fa fa-plus"></i></span> Add more option
                        </td>
                    </tr>


                    </tfoot>
                </table>--}}
            <table id="discount" class="table table-responsive table--store-settings">
                <tbody class="all-options">
                <tr  data-table-id="20">
                    <td>
                        <label for="ShippingZones">Shipping to</label>
                    </td>
                    <td>
                        <select id="ShippingZones" class="form-control">
                            <option selected>Shipping Zones</option>
                            @foreach($shipping_zones as $zone)
                                <option data-name="{!! $zone->name  !!}" value="{!! $zone->tax !!}">{!! $zone->name !!}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="text-right">
                        <button type="button" class="btn btn-primary add-new-option"><i class="fa fa-plus-circle"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="table table-responsive table--store-settings" data-table-id="20">
                <tr class="bg-my-light-blue">
                    <td>Shipping Zone - <span class="shipzone">Armenia</span></td>
                    <td colspan="5">Tax Rate - <span class="taxzone">ArmeniaVaT20</span></td>
                </tr>
                <tbody>

                <tr class="bg-my-light-pink">
                    <th>Order Amount</th>
                    <th>Courier</th>
                    <th>Cost</th>
                    <th colspan="3">Time</th>
                </tr>
                <tr>
                    <td class="table--store-settings_vert-top">
                        <input type="number" min="1" max="5" class="form-control" style="display: inline-block; width: auto">
                        <span>To</span>
                        <input type="number" min="1" max="50" class="form-control" style="display: inline-block; width: auto">
                    </td>
                    <td>
                        <select id="PosType" class="form-control">
                            <option selected>Normal Post</option>
                            <option>...</option>
                        </select>
                    </td>
                    <td>
                            <span class="form-control">
                                5
                            </span>
                    </td>
                    <td>
                            <span class="form-control">
                                3 days
                            </span>
                    </td>
                    <td colspan="2" class="text-right">
                        <button type="button" class="btn btn-danger remove-ship-filed"><i class="fa fa-minus-circle"></i></button>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <select id="dhl" class="form-control">
                            <option selected>DHL</option>
                            <option>...</option>
                        </select>
                    </td>
                    <td>
                            <span class="form-control">
                                5
                            </span>
                    </td>
                    <td>
                            <span class="form-control">
                                1 day
                            </span>
                    </td>
                    <td colspan="2" class="text-right">
                        <button type="button" class="btn btn-danger remove-ship-filed"><i class="fa fa-minus-circle"></i></button>
                    </td>
                </tr>
                <tr class="add-new-ship-filed-container">
                    <td colspan="6" class="text-right">
                        <button type="button" class="btn btn-primary add-new-ship-filed"><i class="fa fa-plus-circle"></i></button>
                    </td>
                </tr>
                </tbody>

                <tfoot>


                <tr>
                    <td colspan="5" class="text-center table--store-settings_add-options add-new-order-filed">
                        <span><i class="fa fa-plus"></i></span> Add more option
                    </td>
                </tr>


                </tfoot>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop

@section('js')
    <script>
        let datax = `@foreach($shipping_zones as $zone)
            <option value="{!! $zone->tax !!}">{!! $zone->name !!}</option>
                @endforeach`
        $("body").on("click", ".add-new-option", function () {
            const id = Date.now()
            let html = `<tr class="container-for-table-remove" data-table-id="${id}">
   <td>
      <label for="ShippingZones">Shipping to</label>
   </td>
   <td>
      <select id="ShippingZones" class="form-control">
         <option selected="">Shipping Zones</option>
         ${datax}
      </select>
   </td>
   <td class="text-right">
      <button type="button" data-table-id=${id} class="btn btn-primary delete-all-option"><i class="fa fa-trash"></i></button>
   </td>
</tr>`
            let html2 = `
<table class="table table-responsive table--store-settings container-for-table-remove" data-table-id="${id}">
                <tr class="bg-my-light-blue">
                <td>Shipping Zone - <span class="shipzone">Armenia</span></td>
                <td colspan="3">Tax Rate - <span class="taxzone">ArmeniaVaT20</span></td>
                <td colspan="2" class="text-right"><button type="button" data-table-id="${id}" class="btn btn-primary delete-all-option"><i class="fa fa-trash"></i></button></span></td>
                    </tr>
                    <tbody>

                    <tr class="bg-my-light-pink">
                        <th>Order Amount</th>
                        <th>Courier</th>
                        <th>Cost</th>
                        <th colspan="3">Time</th>
                    </tr>
                    <tr>
                        <td class="table--store-settings_vert-top">
                            <input type="number" min="1" max="5" class="form-control" style="display: inline-block; width: auto">
                            <span>To</span>
                            <input type="number" min="1" max="50" class="form-control" style="display: inline-block; width: auto">
                        </td>
                        <td>
                            <select id="PosType" class="form-control">
                                <option selected>Normal Post</option>
                                <option>...</option>
                            </select>
                        </td>
                        <td>
                            <span class="form-control">
                                5
                            </span>
                        </td>
                        <td>
                            <span class="form-control">
                                3 days
                            </span>
                        </td>
                        <td colspan="2" class="text-right">
                            <button type="button" class="btn btn-danger remove-ship-filed"><i class="fa fa-minus-circle"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <select id="dhl" class="form-control">
                                <option selected>DHL</option>
                                <option>...</option>
                            </select>
                        </td>
                        <td>
                            <span class="form-control">
                                5
                            </span>
                        </td>
                        <td>
                            <span class="form-control">
                                1 day
                            </span>
                        </td>
                        <td colspan="2" class="text-right">
                            <button type="button" class="btn btn-danger remove-ship-filed"><i class="fa fa-minus-circle"></i></button>
                        </td>
                    </tr>
                    <tr class="add-new-ship-filed-container">
                        <td colspan="6" class="text-right">
                            <button type="button" class="btn btn-primary add-new-ship-filed"><i class="fa fa-plus-circle"></i></button>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="5" class="text-center table--store-settings_add-options add-new-order-filed">
                            <span><i class="fa fa-plus"></i></span> Add more option
                        </td>
                    </tr>
                    </tfoot>
                </table>`
            $(".all-options").append(html)
            $("#myTabContent").append(html2)
        })

        $("body").on("click", ".remove-ship-filed", function(){
            $(this).closest("tr").remove()
        })
        $("body").on("click", ".add-new-ship-filed", function(){

            let html = `<tr>
   <td></td>
   <td>
      <select id="dhl" class="form-control">
         <option selected="">DHL</option>
         <option>...</option>
      </select>
   </td>
   <td>
      <span class="form-control">
      5
      </span>
   </td>
   <td>
      <span class="form-control">
      1 day
      </span>
   </td>
   <td colspan="2" class="text-right">
      <button type="button" class="btn btn-danger remove-ship-filed"><i class="fa fa-minus-circle"></i></button>
   </td>
</tr>`
            $(this).closest("tbody").find(".add-new-ship-filed-container").before(html)
        })

        $("body").on("click", ".delete-all-option", function (e) {
            console.log()
            let id =  $(this).attr("data-table-id")
            $("body").find(`[data-table-id="${id}"]`).closest(".container-for-table-remove").remove()
        })
        $("body").on("click", ".add-new-order-filed", function (e) {
            // console.log(e)
            let html = `  <tbody>

   <tr class="bg-my-light-pink">
      <th>Order Amount</th>
      <th>Courier</th>
      <th>Cost</th>
      <th colspan="3">Time</th>
   </tr>
   <tr>
      <td class="table--store-settings_vert-top">
         <input type="number" min="1" max="5" class="form-control" style="display: inline-block; width: auto">
         <span>To</span>
         <input type="number" min="1" max="50" class="form-control" style="display: inline-block; width: auto">
      </td>
      <td>
         <select id="PosType" class="form-control">
            <option selected="">Normal Post</option>
            <option>...</option>
         </select>
      </td>
      <td>
         <span class="form-control">
         5
         </span>
      </td>
      <td>
         <span class="form-control">
         3 days
         </span>
      </td>
      <td colspan="2" class="text-right">
         <button type="button" class="btn btn-danger remove-ship-filed"><i class="fa fa-minus-circle"></i></button>
      </td>
   </tr>
   <tr>
      <td></td>
      <td>
         <select id="dhl" class="form-control">
            <option selected="">DHL</option>
            <option>...</option>
         </select>
      </td>
      <td>
         <span class="form-control">
         5
         </span>
      </td>
      <td>
         <span class="form-control">
         1 day
         </span>
      </td>
      <td colspan="2" class="text-right">
         <button type="button" class="btn btn-danger remove-ship-filed"><i class="fa fa-minus-circle"></i></button>
      </td>
   </tr>
   <tr class="add-new-ship-filed-container">
      <td colspan="6" class="text-right">
         <button type="button" class="btn btn-primary add-new-ship-filed"><i class="fa fa-plus-circle"></i></button>
      </td>
   </tr>
</tbody>`
            $(this).closest("table").append(html)
        })

        $('body').on('change','#ShippingZones',function (e) {
            console.log(1111)
            e.preventDefault();
            let val = $(this).val();
            let text = $(this).closest("tr").find("#ShippingZones :selected").text();
            let id = $(this).closest("tr").attr("data-table-id")

            let html2 = `
<table class="table table-responsive table--store-settings container-for-table-remove" data-table-id="${id}">
                <tr class="bg-my-light-blue">
                <td>Shipping Zone - <span class="shipzone">${val}</span></td>
                <td colspan="3">Tax Rate - <span class="taxzone">${text}</span></td>
                <td colspan="2" class="text-right"><button type="button" data-table-id="${id}" class="btn btn-primary delete-all-option"><i class="fa fa-trash"></i></button></span></td>
                    </tr>
                    <tbody>

                    <tr class="bg-my-light-pink">
                        <th>Order Amount</th>
                        <th>Courier</th>
                        <th>Cost</th>
                        <th colspan="3">Time</th>
                    </tr>
                    <tr>
                        <td class="table--store-settings_vert-top">
                            <input type="number" min="1" max="5" class="form-control" style="display: inline-block; width: auto">
                            <span>To</span>
                            <input type="number" min="1" max="50" class="form-control" style="display: inline-block; width: auto">
                        </td>
                        <td>
                            <select id="PosType" class="form-control">
                                <option selected>Normal Post</option>
                                <option>...</option>
                            </select>
                        </td>
                        <td>
                            <span class="form-control">
                                5
                            </span>
                        </td>
                        <td>
                            <span class="form-control">
                                3 days
                            </span>
                        </td>
                        <td colspan="2" class="text-right">
                            <button type="button" class="btn btn-danger remove-ship-filed"><i class="fa fa-minus-circle"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <select id="dhl" class="form-control">
                                <option selected>DHL</option>
                                <option>...</option>
                            </select>
                        </td>
                        <td>
                            <span class="form-control">
                                5
                            </span>
                        </td>
                        <td>
                            <span class="form-control">
                                1 day
                            </span>
                        </td>
                        <td colspan="2" class="text-right">
                            <button type="button" class="btn btn-danger remove-ship-filed"><i class="fa fa-minus-circle"></i></button>
                        </td>
                    </tr>
                    <tr class="add-new-ship-filed-container">
                        <td colspan="6" class="text-right">
                            <button type="button" class="btn btn-primary add-new-ship-filed"><i class="fa fa-plus-circle"></i></button>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="5" class="text-center table--store-settings_add-options add-new-order-filed">
                            <span><i class="fa fa-plus"></i></span> Add more option
                        </td>
                    </tr>
                    </tfoot>
                </table>`


            // console.log($(`table[data-table-id="${id}"]`))
            // $(`table[data-table-id="${id}"]`).find('.shipzone').text(text);
            // console.log($(`table[data-table-id="${id}"]`).find('.shipzone').text())
            // $(`table[data-table-id="${id}"]`).find('.taxzone').text(val);
            $("#myTabContent").append(html2)

        });
    </script>
@stop


