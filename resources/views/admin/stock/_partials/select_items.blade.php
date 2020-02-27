<div class="modal-header">
    <div class="col-sm-12 d-flex align-items-center">
        <div class="col-sm-4">
            <h4 class="modal-title">Select Items</h4>
        </div>
        <div class="col-sm-6 d-flex align-items-center">
            <label for="searchStickers">
                Search
            </label>
            {!! Form::text('search',null,
              ['id' => "searchStickers",'class' => 'form-control','style' => 'width:100%']) !!}
        </div>
        <div class="col-sm-2">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
    </div>
</div>
<div class="items-box d-flex flex-column fix-modal--required">
    <div class="modal-body">
        <ul class="all-list modal-stickers--list">
            @include("admin.stock._partials.items_render")
        </ul>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary add-package-items" data-section-id="{{ $uniqueId }}">Add</button>
    </div>
</div>


