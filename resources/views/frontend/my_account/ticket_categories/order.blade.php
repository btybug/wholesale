<div class="status-wall wall">
    <div class="row form-group">
        {{Form::label('order_id', 'Order Number',['class' => 'col-sm-3'])}}
        <div class="col-sm-9">
            {!! Form::select('order_id',$user->orders->pluck('code','id'),null,['class'=>'form-control']) !!}
        </div>
    </div>
</div>
