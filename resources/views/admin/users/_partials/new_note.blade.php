{!! Form::model((isset($model)?$model:null),['class'=>'form-horizontal','id' => 'noteForm','url' => route('admin_notes_form_save')]) !!}
{!! Form::hidden('id') !!}
{!! Form::hidden('user_id',$user->id) !!}
<div class="form-group row">
    <label for="inputName" class="col-sm-2 control-label">Title</label>
    <div class="col-sm-10">
        {!! Form::text('title',null,['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="inputEmail" class="col-sm-2 control-label">Note here</label>
    <div class="col-sm-10">
        {!! Form::textarea('note',null,['class'=>'form-control']) !!}
    </div>
</div>
{!! Form::close() !!}
