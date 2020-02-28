<!-- Modal -->
<div class="modal fade" id="wizardViewModal" tabindex="-1" role="dialog" aria-labelledby="wizardViewLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg wizardViewModal--new" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wizardViewLabel">Choose Your e-Liquid</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              
            </div>
            <div class="modal-footer bord-top d-flex justify-content-between popup-modal-footer py-0">

                <div class="align-items-start selected-items_popup ">
                    <ul class="d-flex flex-wrap footer-list w-100 main-scrollbar">
                        <li class="footer-list-item">
                            <span class="title">Item name 1</span>
                            <span class="close-icon"><i class="fa fa-times"></i></span>
                        </li>
                        <li class="footer-list-item">
                            <span class="title">Item name 2</span>
                            <span class="close-icon"><i class="fa fa-times"></i></span>
                        </li>
                        <li class="footer-list-item">
                            <span class="title">Item name 3</span>
                            <span class="close-icon"><i class="fa fa-times"></i></span>
                        </li>
                        <li class="footer-list-item">
                            <span class="title">Item name 1</span>
                            <span class="close-icon"><i class="fa fa-times"></i></span>
                        </li>
                        <li class="footer-list-item">
                            <span class="title">Item name 2</span>
                            <span class="close-icon"><i class="fa fa-times"></i></span>
                        </li>
                        <li class="footer-list-item">
                            <span class="title">Item name 3</span>
                            <span class="close-icon"><i class="fa fa-times"></i></span>
                        </li>
                    </ul>
                </div>
                <div class="d-flex align-items-center footer--right">
                    <span class="font-weight-bold text-danger message_place_js font-16" >Lorem ipsum dolor sit amet.</span>
                    <button type="button" class="btn btn-primary b_save ml-2" data-section-id="">
                        Add selected
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
{{--<div class="modal fade" id="wizardViewModal" tabindex="-1" role="dialog" aria-labelledby="wizardViewLabel"--}}
{{--     aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-lg" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="wizardViewLabel">Modal title</h5>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <div class="shopping-cart_wrapper">--}}
{{--                    <div class="shopping-cart-head">--}}
{{--                        <ul class="nav nav-pills">--}}

{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <div class="contents-wrapper">--}}
{{--                        <div class="content-wrap shoping-card">--}}
{{--                            <ul class="d-flex flex-wrap content">--}}

{{--                            </ul>--}}
{{--                        </div>--}}

{{--                        <div class="d-flex justify-content-between align-items-center border-top pt-2 footer-buttons">--}}
{{--                            <div class="back-item">--}}
{{--                                <button class="btn btn-secondary back-btn d-none">Back</button>--}}
{{--                            </div>--}}
{{--                            <div class="row selected-items_filter w-100 main-scrollbar mx-1">--}}

{{--                            </div>--}}
{{--                            <div class="next-item">--}}
{{--                                <button class="btn btn-secondary next-btn">Next</button>--}}
{{--                                <button class="btn btn-primary add-items-btn d-none"><i--}}
{{--                                            class="fa fa-plus"></i><span--}}
{{--                                            class="ml-1">Add selected items</span></button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{!! Form::hidden('first_category_id',(isset($category))?$category->id:null,['category_id']) !!}

