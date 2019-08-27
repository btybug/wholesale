
{!! Form::model($model,['class'=>'form-horizontal']) !!}
{!! Form::hidden('type',$p) !!}
{!! Form::hidden('p',$p) !!}
{!! Form::hidden('id',null) !!}
<div class="text-right mb-20 mt20">
    <button class="btn btn-info">Save</button>
</div>
<div class="form-group">
    <div class="card panel panel-default">
        <div class="card-header panel-heading clearfix">
            <p class="d-inline-block">Right column Ads</p>
            <div class="col-sm-2 pull-right">
                <button type="button" class="btn btn-primary add-new-social-input">
                    <i
                        class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group d-flex flex-wrap align-items-center social-media-group">
                @if($model && isset($model->data) && @json_decode($model->data,true))
                    @php
                        $data = json_decode($model->data,true);
                    @endphp
                    @foreach($data['images'] as $key => $banner)
            <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                <div class="col-sm-7 p-0">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            {!! media_button('single_product[images][]',$banner) !!}

                        </div>
                    </div>

                        <div class="form-group row mt-3">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                            <div class="col-sm-10">
                                <input type="text" name="single_product[urls][]" class="form-control" id="staticEmail" value="{!! $data['urls'][$key] !!}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                            <div class="col-sm-10">
                                <input type="text" name="single_product[tags][]" class="form-control" id="staticEmail" value="{!! $data['tags'][$key] !!}">
                            </div>
                        </div>


                </div>
                <div class="col-sm-3">
                    <button class="plus-icon remove-new-banner-input btn btn-danger">
                        <i class="fa fa-minus"></i></button>
                </div>
            </div>
                    @endforeach
                    @else
                    <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                        <div class="col-sm-7 p-0">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    {!! media_button('single_product[images][]') !!}

                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                                <div class="col-sm-10">
                                    <input type="text" name="single_product[urls][]" class="form-control" id="staticEmail">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                                <div class="col-sm-10">
                                    <input type="text" name="single_product[tags][]" class="form-control" id="staticEmail">
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
<script type="template" id="add-more-banners">
    <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
        <div class="col-sm-7 p-0">
            <div class="input-group">
                <div class="input-group-prepend">
                    {!! media_button('single_product[images][]',$model) !!}

                </div>
            </div>

            <div class="form-group row mt-3">
                <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                <div class="col-sm-10">
                    <input type="text" name="single_product[urls][]" class="form-control" id="staticEmail" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                <div class="col-sm-10">
                    <input type="text" name="single_product[tags][]" class="form-control" id="staticEmail" value="">
                </div>
            </div>


        </div>
        <div class="col-sm-3">
            <button class="plus-icon remove-new-banner-input btn btn-danger">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
</script>
@section('js')
    <script>
        $("body").on("click", ".add-new-social-input", function () {
            var uid = Math.random().toString(36).substr(2, 9);
            var html = $("#add-more-banners").html();
            html = html.replace(/{count}/g, uid);
            $(".social-media-group").append(html);
        });
        $("body").on("click", ".remove-new-banner-input", function () {
            $(this).closest(".banner-item").remove();
        });
    </script>
@stop

