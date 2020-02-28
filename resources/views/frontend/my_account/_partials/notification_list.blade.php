@foreach($messages as $message)
    <tr id="{!! $message['object'].'_'.$message['id'] !!}" >
        <th scope="row">
            <input data-id="{!! $message['id'] !!}" data-object="{!! $message['object'] !!}" name="notifications" value="{{ $message['id'] }}" class="message-checkbox" type="checkbox">
        </th>
        <td>{!! $message['updated_at'] !!}</td>
        <td>{!! $message['subject'] !!}</td>
        <td>{!! (isset($message['category'])) ? $message['category']: null  !!} </td>
        <td><button class="ntfs-btn btn btn-info __modal rounded-0" data-toggle="modal" data-id="{!! $message['id'] !!}"
                    data-object="{!! $message['object'] !!}"><i class="fa fa-eye"></i></button></td>
    </tr>
@endforeach
