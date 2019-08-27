@extends('layouts.admin')
@section('content')
    <div class="form-group row">
        <div class="col-md-8">
            <div class="row">
                <label for="text" class="col-4 col-form-label">Code</label>
                <div class="col-8">
                    <div class="d-flex">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-code"></i>
                                </div>
                            </div>
                            <div class="form-control">{{ $barcode->code }}</div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <label for="text" class="col-4 col-form-label">Related item</label>
                <div class="col-8">
                    {!! ($barcode->item) ? "<a href='".route("admin_items_edit",$barcode->item->id)."' >" .$barcode->item->name. "</a>" : "not connected" !!}
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')

@stop
