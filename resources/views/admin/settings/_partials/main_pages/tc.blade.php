<div class="tab-content">
    {!! Form::model($model,['class'=>'form-horizontal']) !!}
    {!! Form::hidden('type',$p) !!}
    {!! Form::hidden('p',$p) !!}
    {!! Form::hidden('id',null) !!}
    <div class="text-right mb-20 mt20">
        <button class="btn btn-info">Save</button>
    </div>
    <div class="clearfix"></div>
    <div class="tab-content tab-content-store-settings">
        <div class="tab-pane fade active in show" id="tab1"
             aria-labelledby="tab1-tab">
            <div class="row ">
                <div class="col-md-12">
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
                                        <label class="col-sm-2 control-label col-form-label text-right"><span
                                                data-toggle="tooltip"
                                                title=""
                                                data-original-title="Description">Description</span></label>
                                        <div class="col-sm-10">
                                            {!! Form::textarea('translatable['.strtolower($language->code).'][description]',get_translated($model,strtolower($language->code),'description'),['class'=>'form-control tinyMcArea','cols'=>30,'rows'=>10]) !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    {!! Form::submit('Save',['class' => 'btn btn-info']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@section('js')
    <script src="/public/js/tinymce/tinymce.min.js"></script>

    <script type="text/javascript">
        $(function () {
            function initTinyMce(e) {
                tinymce.init({
                    selector: e,
                    height: 500,
                    theme: 'modern',
                    plugins: 'print preview fullpage  searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools  contextmenu colorpicker textpattern help',
                    toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
                    image_advtab: true,
                    templates: [
                        {title: 'Test template 1', content: 'Test 1'},
                        {title: 'Test template 2', content: 'Test 2'}
                    ],
                    content_css: [
                        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                        '//www.tinymce.com/css/codepen.min.css'
                    ]
                });
            }

            initTinyMce(".tinyMcArea")
        })
    </script>
@stop
