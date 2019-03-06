<div class="form-group">
    <div class="row">
        <label for="" class="col-md-3">Option Name</label>
        <div class="col-md-9">
            {!! Form::text('option_name',null,['class' => 'form-control option-name']) !!}
        </div>
    </div>
</div>
<table class="table table-responsive table--store-settings">
    <thead>
    <tr class="bg-my-light-pink">
        <th>Attributes</th>
        <th></th>
        <th></th>
    </tr>
    </thead>

    <tbody class="v-options-list">
    @include("admin.inventory._partials.variation_option_item")
    </tbody>

    <tfoot>
    <tr class="add-new-ship-filed-container">
        <td colspan="4" class="text-right">
            <button type="button" class="btn btn-primary"><i
                        class="fa fa-plus-circle add-new-v-option"></i></button>
        </td>
    </tr>
    </tfoot>
</table>