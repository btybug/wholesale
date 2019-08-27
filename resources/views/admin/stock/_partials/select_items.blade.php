<div class="modal-header">
    <div class="col-sm-12 d-flex align-items-center">
        <div class="col-sm-4">
            <h4 class="modal-title">Select Items</h4>
        </div>
        <div class="col-sm-6 d-flex align-items-center">
            <label for="searchStickers">
                Search
            </label>
            {!! Form::select('filters[]',$stickers,null,
              ['id' => "searchStickers",'class' => 'select-2 main-select main-select-2arrows select2-hidden-accessible','style' => 'width:100%',
              'multiple' => true,'data-section-id' => $uniqueId]) !!}
        </div>
        <div class="col-sm-2">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
    </div>
</div>
<div class="items-box d-flex flex-column">
    <div class="modal-body">
        <ul class="all-list modal-stickers--list">
            @include("admin.stock._partials.items_render")
        </ul>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary add-package-items" data-section-id="{{ $uniqueId }}">Add</button>
    </div>
</div>


