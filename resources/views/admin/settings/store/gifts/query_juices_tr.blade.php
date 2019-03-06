<tr>
    <td>Were</td>
    <td>
        {!! Form::select('column[]',$productsTableColumns,null,['class'=>'form-control']) !!}

    </td>
    <td>
        <select name="" class="form-control">
            <option value="=">Equals</option>
            <option value=">">Greater Than</option>
            <option value="<">less than</option>
            <option value="<=">Less Than or Equal To</option>
            <option value="!=">Not Equal To</option>
            <option value="!<">Not Less Than</option>
            <option value="!>">Not Greater Than</option>
        </select>
    </td>
    <td><input type="text" class="form-control"></td>
    <td>
        <button class="btn btn-info btn-sm add-more-query"><i class="fa fa-plus"></i></button>
    </td>
</tr>