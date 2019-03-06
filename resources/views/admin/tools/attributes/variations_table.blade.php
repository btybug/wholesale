<table id="discount" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <td class="text-left">Customer Group</td>
        <td class="text-right">Quantity</td>
        <td class="text-right">Price</td>
        <td></td>
    </tr>
    </thead>
    <tbody>
    <tr id="discount-row0">
        <td class="text-left">
            {!! Form::select('product_discount[0][customer_group_id]',$options,null,['class' => 'form-control']) !!}
        </td>
        <td class="text-right"><input type="text"
                                      name="product_discount[0][quantity]"
                                      value="0" placeholder="Quantity"
                                      class="form-control"/></td>

        <td class="text-right"><input type="text" name="product_discount[0][price]"
                                      value="0" placeholder="Price"
                                      class="form-control"/></td>

        <td class="text-left">
            <button type="button" onclick="$('#discount-row0').remove();"
                    data-toggle="tooltip" title="Remove" class="btn btn-danger"><i
                        class="fa fa-minus-circle"></i></button>
        </td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="6"></td>
        <td class="text-left">
            <button type="button" onclick="addDiscount();" data-toggle="tooltip"
                    title="Add Discount" class="btn btn-primary"><i
                        class="fa fa-plus-circle"></i></button>
        </td>
    </tr>
    </tfoot>
</table>