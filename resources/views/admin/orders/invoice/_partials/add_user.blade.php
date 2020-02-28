<div class="row">
    {!! Form::hidden('user_id',($user) ?$user->id:null,['id' => 'order_user']) !!}
    @php
        $default_shipping=($user) ? $user->addresses()->where('type','default_shipping')->first() : null;
    @endphp
    <div class="col-md-12">
        <div class="card panel panel-default panels-address">
            <div class="card-header panel-heading">
                <div class="user-name">
                    {{ ($user) ? $user->name . ' ' . $user->last_name : 'No User' }}
                </div>
                <div class="edit" data-toggle="modal" data-target=".customer-details-modal">
                    Edit
                </div>
            </div>
            <div class="card-body panel-body">
                <div id="row">
                    <h3> Shipping address</h3>
                    <div class="">
                        {!! Form::model($default_shipping,['class'=>'form-horizontal']) !!}
                        <div class="form-group">
                            <div class="row">
                                <label for="text" class="control-label col-xl-4 col-form-label text-xl-right">Company name</label>
                                <div class="col-xl-8">
                                    {!! Form::text('company',null,['class'=>'form-control','readonly' => true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="text" class="control-label col-xl-4 col-form-label text-xl-right">1st Line address</label>
                                <div class="col-xl-8">
                                    {!! Form::text('first_line_address',null,['class'=>'form-control','readonly' => true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="text" class="control-label col-xl-4 col-form-label text-xl-right">2nd line address</label>
                                <div class="col-xl-8">
                                    {!! Form::text('second_line_address',null,['class'=>'form-control','readonly' => true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="text" class="control-label col-xl-4 col-form-label text-xl-right">Country</label>
                                <div class="col-xl-8">
                                    {!! Form::select('country',$countriesShipping,null,['class'=>'form-control','id' => 'geo_country','readonly' => true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="text" class="control-label col-sm-4 col-form-label text-xl-right">Regions</label>
                                <div class="col-xl-8">
                                    {!! Form::select('region',getRegionByZone(@$default_shipping->country),($default_shipping)?$default_shipping->region:null,['class'=>'form-control','id' => 'geo_region','readonly' => true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group hide">
                            <div class="row">
                                <label for="text" class="control-label col-xl-4 col-form-label text-xl-right">City</label>
                                <div class="col-xl-8">
                                    {!! Form::text('city',null,['class'=>'form-control','readonly' => true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="text" class="control-label col-xl-4 col-form-label text-xl-right">Post Code</label>
                                <div class="col-xl-8">
                                    {!! Form::text('post_code',null,['class'=>'form-control','readonly' => true]) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::hidden('type','default_shipping') !!}
                        {!! Form::hidden('id',null,['id' => 'shipping_id']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
