{!! Form::open(['class' => 'form-horizontal','url' =>url('admin/find/customer'),'id' => 'findForm','method'=>'GET']) !!}
<div class="row">
    <div class="col-sm-6">
        <div class="form-group row">
            <label for="product-name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="product-id" placeholder="Jon">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group row">
            <label for="last-name" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
                <input type="text" name="last_name" class="form-control" id="last-name" placeholder="Don">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" name="email" class="form-control" id="email" placeholder="Gan Don">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group row">
            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
                <input type="text" name="phone" class="form-control" id="phone" placeholder="+37444311113">
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Find</button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
