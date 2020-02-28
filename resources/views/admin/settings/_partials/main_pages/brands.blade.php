<div class="tab-content">
    {!! Form::model($model) !!}
    {!! Form::hidden('p',$p) !!}
    <div class="tab-pane fade active in show" id="admin_settings_general">
        <div class="row">
            <div class="col-md-12">
                <div class="text-right">
                    <button class="btn btn-info mb-20 mt20" type="submit">Save</button>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card panel panel-default social-profile-page mb-3">
                    <div class="card-header panel-heading">Brands slider</div>
                    <div class="card-body panel-body">
                        <div class="form-group d-flex flex-wrap align-items-center social-media-group">
                            @if($model && isset($model->data) && @json_decode($model->data,true))
                                @php
                                    $data = json_decode($model->data,true);
                                @endphp
                                @foreach($data as $key => $banner)
                                    <div class="mb-2 d-flex flex-wrap banner-item w-100">
                                        <div class="col-xl-6 col-md-6 p-0">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    {!! media_button('brands[]',$banner) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-3 offset-md-3">
                                            @if(!$key)
                                                <button type="button"
                                                        class="btn btn-primary add-new-social-input">
                                                    <i class="fa fa-plus"></i></button>
                                            @else
                                                <button type="button"
                                                    class="plus-icon remove-new-banner-input btn btn-danger">
                                                    <i class="fa fa-minus"></i></button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="mb-2 d-flex flex-wrap banner-item w-100">
                                    <div class="col-xl-6 col-sm-6 p-0">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                {!! media_button('brands[]',$model) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 text-sm-right text-xl-left">
                                        <button type="button" class="btn btn-primary add-new-social-input">
                                            <i
                                                class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<script type="template" id="add-more-banners">
    <div class="mb-2 d-flex flex-wrap banner-item w-100">
        <div class="col-sm-6 p-0">
            <div class="input-group">
                <div class="input-group-prepend">
                    {!! media_button('brands[]',$model) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <button type="button" class="plus-icon remove-new-banner-input btn btn-danger">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
</script>

@section('css')
    <link rel="stylesheet" href="{{asset('public/admin_theme/plugins/timepicker/bootstrap-timepicker.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>

@stop


@section('js')
    {!! Html::script("public/admin_theme/plugins/timepicker/bootstrap-timepicker.js")!!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $(function () {


            $(".calendar").datepicker();
            $('.timepicker1').timepicker();
            $('#first_line_country').select2();
            $('.top-items-select').select2();
            $("body").on("click", ".add-new-social-input", function () {
                var uid = Math.random().toString(36).substr(2, 9);
                var html = $("#add-more-banners").html();
                html = html.replace(/{count}/g, uid);
                $(".social-media-group").append(html);
            });

            $("body").on("click", ".remove-new-banner-input", function () {
               $(this).closest('.banner-item').remove();
            });
        });
    </script>
@stop
