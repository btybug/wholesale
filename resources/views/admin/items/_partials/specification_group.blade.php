@foreach($selecteds as $selected)
    @include("admin.items._partials.specifications",['selected' => $selected,'allAttrs' => $allAttrs])
@endforeach
