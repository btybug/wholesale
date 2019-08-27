@foreach($user->notes as $note)
    <div class="special-note-wall border mb-2 p-3">
        <div class="row">
            <div class="col-md-9">
                <div class="special-note-left-info">
                    <h5 class="special-note-title">{{ $note->title }}</h5>
                    <p class="special-note-desc">{!! $note->note !!}</p>
                </div>
            </div>
            <div class="col-md-3">
                <a href="javascript:void(0)" data-href="{{ route("admin_notes_delete") }}"
                   class="delete-button btn btn-danger" data-key="{{ $note->id }}">Delete</a>

                <div class="special-note-right-info float-right">
                    <div>
                        <span class="d-block">{{ BBgetDateFormat($note->created_at) }}</span>
                        <span class="d-block">{{ BBgetTimeFormat($note->created_at) }}</span>
                        <span class="d-block">added by {{ $note->author->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
