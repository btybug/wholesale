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
                    <div class="card-header panel-heading">Main slider</div>
                    <div class="card-body panel-body">
                        <div class="form-group d-flex flex-wrap align-items-center social-media-group">
                            @if($model && isset($model->data) && @json_decode($model->data,true))
                                @php
                                    $data = json_decode($model->data,true);
                                @endphp
                                @foreach($data as $key => $banner)
                                    <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                                        <div class="col-sm-6 p-0">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    {!! media_button('banners[]',$banner) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
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
                                <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                                    <div class="col-sm-6 p-0">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                {!! media_button('banners[]',$model) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" class="btn btn-primary add-new-social-input">
                                            <i
                                                class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="card panel panel-default social-profile-page mb-3">
                    <div class="card-header panel-heading">Bottom slider</div>
                    <div class="card-body panel-body">
                        <div class="form-group d-flex flex-wrap align-items-center bottom-group">
                            @if($bottom && isset($bottom->data) && @json_decode($bottom->data,true))
                                @php
                                    $data = json_decode($bottom->data,true);

                                @endphp
                                @foreach($data as $key => $bottom_banner)
                                    <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                                        <div class="col-sm-6 p-0">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    {!! media_button('bottom_banner[]',$bottom_banner) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            @if(!$key)
                                                <button type="button"
                                                        class="btn btn-primary add-new-bottom">
                                                    <i class="fa fa-plus"></i></button>
                                            @else
                                                <button type="button"
                                                    class="plus-icon remove-new-bottom-input btn btn-danger">
                                                    <i class="fa fa-minus"></i></button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                                    <div class="col-sm-6 p-0">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                {!! media_button('bottom_banner[]',$bottom) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" class="btn btn-primary add-new-bottom">
                                            <i
                                                class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="card panel panel-default social-profile-page mb-3">
                    <div class="card-header panel-heading">
                        <span class="pull-left mt-1">Main section</span>
                        <button type="button" class="btn btn-primary pull-right add-new-product">
                            <i class="fa fa-plus"></i></button>
                    </div>
                    <div class="card-body panel-body">

                        <div class="form-group d-flex flex-wrap align-items-center top-products-group">
                            @if(isset($top->data))
                                @php
                                $data=@json_decode($top->data,true);
                                @endphp
                            @foreach($data['name'] as $key=>$title)
                            <div class="row banner-item w-100 mb-2">
                                <div class="col-sm-8 pr-sm-0">
                                    <div class="d-flex flex-column flex-sm-row">
                                        @if(count(get_languages()))
                                            <ul class="nav nav-tabs">
                                                @foreach(get_languages() as $language)
                                                    <li class="nav-item "><a class="nav-link @if($loop->first) active @endif"
                                                                             data-toggle="tab"
                                                                             href="#{{ strtolower($language->code) }}">
                                                            <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                                        </a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        <div class="tab-content">
                                            @if(count(get_languages()))
                                                @foreach(get_languages() as $language)
                                                    <div id="{{ strtolower($language->code) }}"
                                                         class="tab-pane fade  @if($loop->first) in active show @endif">
                                                        <div class="form-group row">
                                                            <label class="col-lg-2 control-label col-form-label text-lg-right"><span
                                                                    data-toggle="tooltip"
                                                                    title=""
                                                                    data-original-title="Description">Name</span></label>
                                                            <div class="col-lg-10">
{{--                                                                <input type="text" class="form-control mr-2"  name="top[name][]" value="{!! $title !!}">--}}

                                                                {!! Form::text('top[name]['.$key.']['.strtolower($language->code).']',$title[strtolower($language->code)],['class'=>'form-control mr-2']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>

                                        {!! Form::select('top[products]['.$key.'][]',$items,$data['products'][$key],['class'=>'top-items-select','multiple'=>true]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    @if($key>0)
                                        <button type="button" class="btn btn-danger remove-product">
                                            <i class="fa fa-minus"></i></button>
                                        @else
{{--                                        <button type="button" class="btn btn-primary add-new-product">--}}
{{--                                            <i class="fa fa-plus"></i></button>--}}
                                        <button type="button" class="btn btn-danger remove-product">
                                            <i class="fa fa-minus"></i></button>
                                        @endif

                                </div>
                            </div>
                                @endforeach
                            @else
                                <div class="row banner-item w-100 mb-2">
                                    <div class="col-sm-8 pr-sm-0">
                                        <div class="d-flex flex-column flex-sm-row">
                                            @php
                                            $unique = uniqid();
                                            @endphp
                                            @if(count(get_languages()))
                                                <ul class="nav nav-tabs">
                                                    @foreach(get_languages() as $language)
                                                        <li class="nav-item "><a class="nav-link @if($loop->first) active @endif"
                                                                                 data-toggle="tab"
                                                                                 href="#{{ strtolower($language->code) }}">
                                                                <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                                            </a></li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                                <div class="tab-content">
                                                    @if(count(get_languages()))
                                                        @foreach(get_languages() as $language)
                                                            <div id="{{ strtolower($language->code) }}"
                                                                 class="tab-pane fade  @if($loop->first) in active show @endif">
                                                                <div class="form-group row">
                                                                    <label class="col-lg-2 control-label col-form-label text-lg-right"><span
                                                                            data-toggle="tooltip"
                                                                            title=""
                                                                            data-original-title="Description">Name</span></label>
                                                                    <div class="col-lg-10">
                                                                        {{--                                                                <input type="text" class="form-control mr-2"  name="top[name][]" value="{!! $title !!}">--}}

                                                                        {!! Form::text('top[name]['.$unique.']['.strtolower($language->code).']',null,['class'=>'form-control mr-2']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                            {!! Form::select('top[products]['.$unique.'][]',$items,null,['class'=>'top-items-select','multiple'=>true]) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
{{--                                        <button type="button" class="btn btn-primary add-new-product">--}}
{{--                                            <i class="fa fa-plus"></i></button>--}}
                                        <button type="button" class="btn btn-primary add-new-product">
                                            <i class="fa fa-plus"></i></button>
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
        <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
            <div class="col-sm-6 p-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        {!! media_button('banners[]',$model) !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <button type="button" class="plus-icon remove-new-banner-input btn btn-danger">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
    </script>
<script type="template" id="add-more-bottom">
        <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
            <div class="col-sm-6 p-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        {!! media_button('bottom_banner[]',$model) !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <button class="plus-icon remove-new-bottom-input btn btn-danger">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
    </script>
<script type="template" id="add-top-items">
    <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
        <div class="col-sm-8 p-0">
            @php
                $unique = uniqid();
            @endphp
            <div class="input-group-prepend">
                @if(count(get_languages()))
                    <ul class="nav nav-tabs">
                        @foreach(get_languages() as $language)
                            <li class="nav-item "><a class="nav-link @if($loop->first) active @endif"
                                                     data-toggle="tab"
                                                     href="#{{ strtolower($language->code) }}">
                                    <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                </a></li>
                        @endforeach
                    </ul>
                @endif
                <div class="tab-content">
                    @if(count(get_languages()))
                        @foreach(get_languages() as $language)
                            <div id="{{ strtolower($language->code) }}"
                                 class="tab-pane fade  @if($loop->first) in active show @endif">
                                <div class="form-group row">
                                    <label class="col-lg-2 control-label col-form-label text-lg-right"><span
                                            data-toggle="tooltip"
                                            title=""
                                            data-original-title="Description">Name</span></label>
                                    <div class="col-lg-10">
                                        {{--                                                                <input type="text" class="form-control mr-2"  name="top[name][]" value="{!! $title !!}">--}}

                                        {!! Form::text('top[name][{index}]['.strtolower($language->code).']',null,['class'=>'form-control mr-2']) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                {!! Form::select('top[products][{index}][]',$items,null,['class'=>'top-items-select','multiple'=>true]) !!}
            </div>
        </div>
        <div class="col-sm-3">
            <button type="button" class="btn btn-danger remove-product">
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

            $("body").on("click", ".add-new-bottom", function () {
                var uid = Math.random().toString(36).substr(2, 9);
                var html = $("#add-more-bottom").html();
                html = html.replace(/{count}/g, uid);
                $(".bottom-group").append(html);
            });

            $("body").on("click", ".add-new-social-input", function () {
                var uid = Math.random().toString(36).substr(2, 9);
                var html = $("#add-more-banners").html();
                html = html.replace(/{count}/g, uid);
                $(".social-media-group").append(html);
            });

            $("body").on("click", ".add-new-product", function () {
                var html = $("#add-top-items").html();
                html = html.replace(/{index}/g, $('.top-items-select').length);
                $(".top-products-group").append(html);
                $('.top-items-select').select2();
            });

            $("body").on("click", ".remove-new-bottom-input", function () {
                $(this).closest(".banner-item").remove();
            });
            $("body").on("click", ".remove-new-banner-input", function () {
                $(this).closest(".banner-item").remove();
            });
            $("body").on("click", ".remove-product", function () {
                $(this).closest(".banner-item").remove();
            });

            $("body").on("click", "#add-more-hours", function () {
                var uid = Math.random().toString(36).substr(2, 9);
                var html = '<tr><td><div class="form-group"><label for="weekday" class="mb-0">Weekday</label><select class="form-control"  name="opening_hours[weekday][]"><option value="Sunday" selected="selected">Sunday</option><option value="Monday">Monday</option><option value="Tuesday">Tuesday</option><option value="Wednesday">Wednesday</option><option value="Thursday">Thursday</option><option value="Friday">Friday</option><option value="Saturday">Saturday</option></select> </div> </td> <td> ' +
                    '<div class="form-group"> ' +
                    '<strong>From</strong> ' +
                    '<div class="input-group bootstrap-timepicker timepicker">' +
                    '<input class="form-control timepicker1" name="opening_hours[time_from][]" type="text" >' +
                    '<label class="input-group-addon input-group-append" for="timepicker1">' +
                    '<span class="input-group-text h-100"> <i class="fa fa-clock-o"></i></span>' +
                    '</div></div> </td> <td> <div class="form-group"> ' +
                    '<strong>To</strong> ' +
                    '<div class="input-group bootstrap-timepicker timepicker"> ' +
                    '<input class="form-control timepicker1" name="opening_hours[time_to][]" type="text"> ' +
                    '<label class="input-group-addon input-group-append" for="timepicker2">' +
                    '<span class="input-group-text h-100"> <i class="fa fa-clock-o"></i></span>' +
                    '</label> </div> </div> </td> <td><button type="button" class="btn btn-danger pull-right remove-hour"><i class="fa fa-minus"></i></button>' +
                    '</td></tr>';
                $("#working-hours").append(html);
                $('.timepicker1').timepicker();
            });

            $("body").on("click", ".remove-hour", function () {
                $(this).closest("tr").remove();
            });
            $("body").on("click", "#add-more-calendar", function () {
                var uid = Math.random().toString(36).substr(2, 9);
                var html = '<tr> ' +
                    '<td> ' +
                    '<label for="calendar">Calendar</label> ' +
                    '<div class="input-group"> ' +
                    '<input class="form-control calendar" name="calendar[holidays][]" type="text"> ' +
                    '<label class="input-group-addon input-group-append" for="calendar"><span class="input-group-text h-100"><i class="fa fa-calendar"></i></span></label> ' +
                    '</div> ' +
                    '</td> ' +
                    '<td> ' +
                    '<input class="form-control" name="calendar[reason][]" type="text"> ' +
                    '</td> ' +
                    '<td> ' +
                    '<button type="button" class="btn btn-danger pull-right remove-calendar"><i class="fa fa-minus"></i></button> ' +
                    '</td> ' +
                    '</tr>';
                $("#calendar").append(html);
                $(".calendar").datepicker();

            });

            $("body").on("click", ".remove-calendar", function () {
                $(this).closest("tr").remove();
            });

            $("body").on("click", ".social-profile-page .dropdown-item", function () {
                var parent = $(this).closest(".input-group-prepend").find(".dropdown-toggle").find("i");

                var classList = $(this).find("i").attr("class");

                parent.attr("class", "").addClass(classList);
                $(this).closest(".input-group-prepend").find('.social_type').val(classList);
                $(this).parent().children().removeClass('active')
                $(this).addClass('active')
            });
        });
    </script>
@stop
