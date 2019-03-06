@extends('layouts.frontend')
@section('content')
   <main class="main-content">
       <div class="container">
           <div class="bg-white p-5 shadow-sm">
               <div class="row justify-content-center mb-5">
                   <div class="col-md-4">
                       <div class="form-group">
                           <label for="country">Select Country</label>
                           {!! Form::select('country',$countries,null,['class'=>'form-control','id'=>'country']) !!}
                       </div>
                   </div>

                   <div class="col-md-4">
                       <div class="form-group">
                           <label for="city">Select City</label>
                           <div class="city-choser">
                               <select id="city" disabled readonly="true" class="form-control">
                                   <option selected>Choose...</option>
                               </select>
                           </div>
                       </div>
                   </div>

               </div>
               <div class="row">
                   <div class="col-md-12 shipping-methods">
                       <h4 class="text-center mb-5">Shipping method based on order amount</h4>

                       {{--first condition--}}
                       <ul class="row justify-content-center mb-5 pl-0 bg-light py-4">
                           <li class="col-md-4">
                               <h5>If order is 1-50</h5>
                           </li>
                           <li class="col-md-4">
                               <table class="table table-bordered">
                                   <tr>
                                       <td>Local Mail</td>
                                       <td>1-3 days</td>
                                       <td>10USD</td>
                                   </tr>
                                   <tr>
                                       <td>DHL</td>
                                       <td>1 Day</td>
                                       <td>15USD</td>
                                   </tr>
                               </table>
                           </li>
                       </ul>

                       {{--second condition--}}
                       <ul class="row justify-content-center mb-5 pl-0 bg-light py-4">
                           <li class="col-md-4">
                               <h5>If order is more than 50</h5>
                           </li>
                           <li class="col-md-4">
                               <table class="table table-bordered">
                                   <tr>
                                       <td>DHL</td>
                                       <td>1 day</td>
                                       <td>free</td>
                                   </tr>
                               </table>
                           </li>
                       </ul>
                   </div>

               </div>
           </div>

       </div>
   </main>
@stop

@section("js")
<script>
postSendAjax = function(url, data, success, error) {
    $.ajax({
        type: "post",
        url: url,
        cache: false,
        datatype: "json",
        data: data,
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
        },
        success: function(data) {
            if (success) {
                success(data);
            }
            return data;
        },
        error: function(errorThrown) {
            if (error) {
                error(errorThrown);
            }
            return errorThrown;
        }
    });
};

$("body").on("change", "#country", function(){
    let value = $(this).val()
    postSendAjax("{!! route('delivery_get_countries') !!}", {value}, function(res){
        if (!res.error) {
            $(".city-choser").empty().append(res.html)
        }
    })
})

$("body").on("change", "#city", function(){
    let value = $(this).val()
    postSendAjax("/url", {value}, function(res){
        if (!res.error) {
            $(".shipping-methods").empty().append(res.html)
        }
    })
})


</script>

@stop