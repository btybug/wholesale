{!! Form::model($address_book,['class'=>'form-horizontal address-book-form','url' => route('admin_users_address_book_save')]) !!}
<div class="errors">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<div class="form-group">
    <div class="row">
        <label for="text" class="control-label col-sm-4">Name</label>
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::text('first_name',null,['class'=>'form-control']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::text('last_name',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <label for="text" class="control-label col-sm-4">Company name</label>
        <div class="col-sm-8">
            {!! Form::text('company',null,['class'=>'form-control']) !!}
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <label for="text" class="control-label col-sm-4">1st Line address</label>
        <div class="col-sm-8">
            {!! Form::text('first_line_address',null,['class'=>'form-control']) !!}
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <label for="text" class="control-label col-sm-4">2nd line address</label>
        <div class="col-sm-8">
            {!! Form::text('second_line_address',null,['class'=>'form-control']) !!}
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <label for="text" class="control-label col-sm-4">Country</label>
        <div class="col-sm-8">
            {!! Form::select('country',$countriesShipping,null,['class'=>'form-control','id' => 'geo_country_book']) !!}
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <label for="text" class="control-label col-sm-4">Regions</label>
        <div class="col-sm-8">
            {!! Form::select('region',getRegionByZone(@$address_book->country),null,['class'=>'form-control geo_region_book']) !!}
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <label for="text" class="control-label col-sm-4">City</label>
        <div class="col-sm-8">
            {!! Form::text('city',null,['class'=>'form-control']) !!}
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <label for="text" class="control-label col-sm-4">Post Code</label>
        <div class="col-sm-8">
            {!! Form::text('post_code',null,['class'=>'form-control']) !!}
        </div>
    </div>
</div>

<div class="form-check">
    <div class="row">
        <div class="col-sm-8 offset-sm-4">
            {!! Form::checkbox('make_default',true,$default,['id' => 'newAddressCheck']) !!}
            <label class="form-check-label text-muted" for="newAddressCheck">
                Mark this shipping address as default
            </label>
        </div>
    </div>
</div>
{!! Form::hidden('type','address_book') !!}
{!! Form::hidden('id') !!}
<div class="form-group row">
    <div class="col-sm-offset-4 col-sm-8">
        <button type="button" class="btn btn-primary save-address-book">Submit</button>
    </div>
</div>
{!! Form::close() !!}