@if(count($ticket->attachments))
    @foreach($ticket->attachments as $attachment)
        @if($attachment->type == 'image')
            <li class="item-attach">
                <img src="{{ $attachment->file_path }}" alt="">
            </li>
        @elseif($attachment->type == 'document')
            <li class="item-attach">
                <iframe src="{{ $attachment->file_path }}"
                        style="width: 100%;height: 100%;border: none;"></iframe>
            </li>
        @endif
    @endforeach
@else
    <li>{!! __('no_Attachments') !!}</li>
@endif
