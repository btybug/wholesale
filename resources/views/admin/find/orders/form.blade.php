
{!! Form::open(['class' => 'form-horizontal','url' => route('find_orders_results'),'id' => 'findForm']) !!}
<div class="row">

    <div class="col-sm-6">
        <div class="form-group row">
            <label for="code" class="col-sm-2 col-form-label">Code</label>
            <div class="col-sm-10">
                <input type="text" name="code" class="form-control" id="code" placeholder="Order code">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group row">
            <label for="shipping_method" class="col-sm-2 col-form-label">Shipping method</label>
            <div class="col-sm-10">
                {!! Form::select('shipping_method',[null=>'Select shipping method']+$couriers->toArray(),null,['class'=>'form-control','id'=>'shipping_method']) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group row">
            <label for="payment_method" class="col-sm-2 col-form-label">Payment method</label>
            <div class="col-sm-10">
                {!! Form::select('payment_method[]',$payments_gateways->toArray(),null,['class'=>'form-control','id'=>'payment_method','multiple' => true]) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group row">
            <label for="shipping_method" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                {!! Form::select('status[]',$statuses,null,['class'=>'form-control','id'=>'status','multiple' => true]) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group row">
            <label for="customer" class="col-sm-2 col-form-label">Customer</label>
            <div class="col-sm-10">
                {!! Form::select('customer[]',$users,null,['class'=>'form-control','id'=>'customer','multiple' => true]) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group row">
            <label for="currency" class="col-sm-2 col-form-label">Currency</label>
            <div class="col-sm-10">
                {!! Form::select('currency',[null=>'Select currency','usd'=>'USD','eur'=>'EUR','amd'=>'AMD'],null,['class'=>'form-control','id'=>'currency']) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group row">
            <label for="product-name" class="col-sm-2 col-form-label">Amount start</label>
            <div class="col-sm-10">
                {!! Form::number('amount[]',null,['class' => 'form-control','placeholder' => 'order amount start']) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Date</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="text" id="find-date__ranged" name="date" class="form-control" value="" placeholder="Date" aria-label="Recipient's date with two button addons" aria-describedby="button-addon4">
                    <div class="input-group-append" id="button-addon4">
                        <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip"
                                title="Date range">
                            <i class="fa fa-calendar"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group row">
            <label for="product-name" class="col-sm-2 col-form-label">Amount to</label>
            <div class="col-sm-10">
                {!! Form::number('amount[]',null,['class' => 'form-control','placeholder' => 'order amount to']) !!}
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
