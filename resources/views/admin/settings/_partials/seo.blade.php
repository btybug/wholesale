<div class="card panel panel-default">
    <div class="card-header panel-heading">
        <h2 class="m-0">SEO</h2>
    </div>
    <div class="card-body panel-body">

        <div class="seo-pages mt-20">
            <div class="">
                <div class="row mt-20">

                    <div class="col-md-9 col-8">
                        <div class="card panel panel-default">
                            <div class="card-header panel-heading">General</div>
                            {!! Form::model($seo,['url'=>route('post_admin_settings_main_pages_seo')]) !!}
                            {!! Form::hidden('id') !!}
                            <div class="clearfix"></div>
                            <div class="tab-content setting-general-footer--tabs">
                                <div class="tab-pane fade active in show" id="tab1"
                                     aria-labelledby="tab1-tab">
                                    <div>
                                        @if(count(get_languages()))
                                            <ul class="nav nav-tabs">
                                                @foreach(get_languages() as $language)
                                                    <li class="nav-item "><a class="nav-link @if($loop->first) active @endif" data-toggle="tab"
                                                                             href="#{{ strtolower($language->code) }}">
                                                            <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                                        </a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        <div class="tab-content pt-25">
                                            @if(count(get_languages()))
                                                @foreach(get_languages() as $language)
                                                    <div id="{{ strtolower($language->code) }}"
                                                         class="tab-pane fade  @if($loop->first) in active show @endif">
                                                        <div class="card-body panel-body">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <label for="seo-title" class="col-xl-3 col-md-4 col-sm-3">Title</label>
                                                                    <div class="col-xl-5 col-md-8 col-sm-9">
                                                                        {!! Form::text('translatable['.strtolower($language->code).'][title]',get_translated($seo,strtolower($language->code),'title'),['class'=>'form-control']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <label for="seo-desc" class="col-xl-3 col-md-4 col-sm-3">Description</label>
                                                                    <div class="col-xl-5 col-md-8 col-sm-9">
                                                                        {!! Form::text('translatable['.strtolower($language->code).'][description]',get_translated($seo,strtolower($language->code),'description'),['class'=>'form-control']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <label for="seo-keywords" class="col-xl-3 col-md-4 col-sm-3">Focus keywords</label>
                                                                    <div class="col-xl-5 col-md-8 col-sm-9">
                                                                        {!! Form::text('translatable['.strtolower($language->code).'][keywords]',get_translated($seo,strtolower($language->code),'keywords'),['class'=>'form-control']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <label for="seo-title" class="col-xl-3 col-md-4 col-sm-3">Image</label>
                                                                    <div class="col-xl-5 col-md-8 col-sm-9">
                                                                        {!! media_button('translatable['.strtolower($language->code).'][image]', (new stdClass(['image'=>get_translated($seo,strtolower($language->code),'image')]))) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if(get_translated($seo,strtolower($language->code),'image'))
                                                        <img src="{!! get_translated($seo,strtolower($language->code),'image') !!}" alt="">
                                                            @endif
                                                    </div>
                                                @endforeach
                                            @endif
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="seo-meta-robots" class="col-xl-3 col-md-4 col-sm-3">Meta
                                                        Robots</label>
                                                    <div class="col-xl-5 col-md-8 col-sm-9">
                                                        {!! Form::select('robots',['1'=>'Index','0'=>'No Index'],isset($seo)?$seo->robots:null,['class'=>'form-control']) !!}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {!! Form::hidden('p',$p) !!}
                            @ok('post_admin_seo_pages')
                            <button type="submit" id="submit" class="btn btn-info">Save</button>
                            @endok
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
