@extends('layouts.admin',['activePage'=>'discounts'])
@section('content')
    <div class="d-flex flex-wrap justify-content-between w-100 admin-general--tabs-wrapper">
        <ul class="nav nav-tabs new-main-admin--tabs mb-3 admin-general--tabs" data-tabs="tabs">
            <li class="nav-item">
                <a class="nav-link " href="{!! route("app_customer_discounts") !!}">
                    Admin discounts
                    <div class="ripple-container"></div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{!! route("app_customer_offers") !!}">
                    Offers
                    <div class="ripple-container"></div>
                </a>
            </li>
        </ul>
    </div>
    <div class="card">
        <div class="d-flex justify-content-end px-4 mt-2">
            <a class="pull-right btn btn-primary" href="{!! route('app_customer_offers_create') !!}">Create
                new</a>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="table-responsive">
                        <table class="table table-hover ">
                            <thead>
                            <th>
                                Name
                            </th>
                            <th>
                                Type
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Created Date
                            </th>
                            <th>
                                Actions
                            </th>
                            </thead>
                            <tbody>
                            @foreach($discounts as $discount)
                                <tr>
                                    <td>
                                        {!! $discount->name !!}
                                    </td>
                                    <td>
                                        {!! $discount->type !!}
                                    </td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox"  value="{!! $discount->id !!}" @if($discount->status) checked @endif  class="custom-control-input" id="switch{!! $discount->id !!}">
                                            <label class="custom-control-label" for="switch{!! $discount->id !!}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        {!! $discount->created_at !!}
                                    </td>

                                    <td>
                                        <a href="{!! route('app_customer_offers_edit',$discount->id) !!}"
                                           class="mr-3 table-edit-link">Edit</a>
                                        <a href="#" class="mr-3 table-edit-link">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(function() {
            $('body').on('change', '.custom-control-input', function(ev) {
                const checked = $(ev.target).is(':checked');
                const id = $(ev.target).val();

                AjaxCall("/admin/app/discounts/offers/on-off", {id, status: checked ? 1 : 0}, function (res) {
                    if (!res.error) {
                        
                    }
                });
            })
        })
    </script>
@stop
