@extends('layouts.admin')
@section('content')
    {!! Form::model($seo) !!}
    @if($seo)
        {!! Form::hidden('id',$seo->id) !!}

    @endif
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="tabSeo1-tab" data-toggle="tab" href="#tabSeo1" role="tab" aria-controls="tabSeo1" aria-selected="true">Tab 1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tabSeo2-tab" data-toggle="tab" href="#tabSeo2" role="tab" aria-controls="tabSeo2" aria-selected="false">Tab 2</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="tabSeo1" role="tabpanel" aria-labelledby="tabSeo1-tab">
            {!! Form::hidden('post_id',$post->id) !!}
            <div class="card panel panel-default">
                <div class="card-header panel-heading clearfix">
                    <h2 class="m-0 pull-left">SEO Edit Post</h2>
                    <div class="pull-right btn-save">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>

                <div class="card-body panel-body">
                    @if(count(get_languages()))
                        <ul class="nav nav-tabs mb-3">
                            @foreach(get_languages() as $language)
                                <li class="nav-item "><a class="nav-link @if($loop->first) active @endif"
                                                         data-toggle="tab"
                                                         href="#{{ strtolower($language->code) }}">
                                        <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                    </a></li>
                            @endforeach
                        </ul>
                    @endif

                    @if(count(get_languages()))
                        @foreach(get_languages() as $language)
                            <div id="{{ strtolower($language->code) }}"
                                 class="tab-pane fade  @if($loop->first) in active show @endif">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="seo-general-content">
                                            <div class="card panel panel-default mt-20 mb-3">
                                                <div class="card-header panel-heading">General</div>
                                                <div class="card-body panel-body">
                                                    <table class="form-table table">
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row" style="width: 16.5%">
                                                                <label for="seo_focuskw">Focus Keyword:</label>
                                                                <img src="/public/images/question-mark.png" alt="question">
                                                            </th>
                                                            <td>
                                                                {!! Form::text('translatable['.strtolower($language->code).'][keywords]',get_translated($seo,strtolower($language->code),'keywords'),['class'=>'form-control','placeholder'=>getSeo($general,'og:keywords',$post)]) !!}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width: 16.5%">
                                                                <label for="seo_title">SEO Title:</label>
                                                                <img src="/public/images/question-mark.png" alt="question">
                                                            </th>
                                                            <td>
                                                                {!! Form::text('translatable['.strtolower($language->code).'][title]',get_translated($seo,strtolower($language->code),'title'),['class'=>'form-control','placeholder'=>getSeo($general,'og:title',$post)]) !!}
                                                                <br>
                                                                <div>
                                                                    <p><span class="wrong">Warning:</span>
                                                                        Title display in Google is limited to a fixed width, yours is too long.
                                                                    </p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width: 16.5%">
                                                                <label for="seo_metadesc">Meta description:</label>
                                                                <img src="/public/images/question-mark.png" alt="question">
                                                            </th>
                                                            <td>
                                                                {!! Form::textarea('translatable['.strtolower($language->code).'][description]',get_translated($seo,strtolower($language->code),'description'),['class'=>'form-control','rows'=>2,'placeholder'=>getSeo($general,'og:description',$post)]) !!}
                                                                <div>The <code>meta</code> description will be limited to 156 chars, 156 chars left.
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                <label for="seo_canonical">URL:</label>
                                                            </th>
                                                            <td>
                                                                {!! Form::text('post[translatable]['.strtolower($language->code).'][url]',get_translated($post,strtolower($language->code),'url'),['class'=>'form-control']) !!}
                                                                <br>
                                                                <div>The canonical URL that this page should point to, leave empty to default to
                                                                    permalink. <a target="_blank"
                                                                                  href="#">Cross
                                                                        domain canonical</a> supported too.
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="card panel panel-default mt-20 mb-3">
                                    <div class="card-header panel-heading">FB</div>
                                    <div class="card-body panel-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="seo-facebook-title" class="col-md-2 col-xs-12">Facebook Title</label>
                                                <div class="col-md-5 col-xs-12">
                                                    {!! Form::text('translatable['.strtolower($language->code).'][fb_title]',get_translated($seo,strtolower($language->code),'fb_title'),['class'=>'form-control','placeholder'=>getSeo($fbSeo,'og:title',$post)]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="seo-facebook-desc" class="col-md-2 col-xs-12">Facebook Description</label>
                                                <div class="col-md-5 col-xs-12">
                                                    {!! Form::text('translatable['.strtolower($language->code).'][fb_description]',get_translated($seo,strtolower($language->code),'fb_description'),['class'=>'form-control','placeholder'=>getSeo($fbSeo,'og:description',$post)]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-2 col-xs-12">Facebook Image</label>
                                                <div class="col-md-5 col-xs-12">
                                                    {!! Form::text('translatable['.strtolower($language->code).'][fb_image]',get_translated($seo,strtolower($language->code),'fb_image'),['class'=>'form-control','readonly','disabled','placeholder'=>getSeo($fbSeo,'og:image',$post)]) !!}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card panel panel-default mb-3">
                                    <div class="card-header panel-heading">Twitter</div>
                                    <div class="card-body panel-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="seo-twitter-title" class="col-md-2 col-xs-12">Twitter Title</label>
                                                <div class="col-md-5 col-xs-12">
                                                    {!! Form::text('translatable['.strtolower($language->code).'][twitter_title]',get_translated($seo,strtolower($language->code),'twitter_title'),['class'=>'form-control','placeholder'=>getSeo($twitterSeo,'og:description',$post)]) !!}

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="seo-twitter-desc" class="col-md-2 col-xs-12">Twitter Description</label>
                                                <div class="col-md-5 col-xs-12">
                                                    {!! Form::text('translatable['.strtolower($language->code).'][twitter_description]',get_translated($seo,strtolower($language->code),'twitter_description'),['class'=>'form-control','placeholder'=>getSeo($twitterSeo,'og:description',$post)]) !!}

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-2 col-xs-12">Twitter Image</label>
                                                <div class="col-md-5 col-xs-12">
                                                    {!! Form::text('translatable['.strtolower($language->code).'][twitter_image]',get_translated($seo,strtolower($language->code),'twitter_image'),['class'=>'form-control','placeholder'=>getSeo($twitterSeo,'og:image',$post)]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="seo-advanced">
                        <div class="card panel panel-default mt-20 mb-3">
                            <div class="card-header panel-heading">Robots</div>
                            <div class="card-body panel-body">
                                <table class="form-table table">
                                    <tbody>
                                    <tr>
                                        <th scope="row" style="width: 16.5%;">
                                            <label for="seo_meta-robots-noindex">Meta Robots Index:</label>
                                        </th>
                                        <td>
                                            {!! Form::select('robots',[null=>isset($robot)?(($robot->robots)?'As default Index':'As default No Index'):null,'1'=>'Index','0'=>'No Index'],null,['class'=>'form-control']) !!}

                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 16.5%;">Meta Robots Follow</th>
                                        <td>
                                            {!! Form::radio('robots_follow',0,null,['id'=>'seo_meta-robots-nofollow_0']) !!}
                                            <label for="seo_meta-robots-nofollow_0">Follow</label>
                                            {!! Form::radio('robots_follow',1,null,['id'=>'seo_meta-robots-nofollow_0']) !!}
                                            <label for="seo_meta-robots-nofollow_1">Nofollow</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 16.5%;">
                                            <label for="seo_meta-robots-adv">Meta Robots Advanced:</label>
                                        </th>
                                        <td>
                                            {!! Form::select('meta_robots_advanced',
                                            [null=>'Site-wide default: None',
                                            'none'=>'None',
                                            'noodp'=>'NO ODP',
                                            'noydir'=>'None',
                                            'noimageindex'=>'No Image Index',
                                            'noarchive'=>'No Archive',
                                            'nosnippet'=>'No Snippet',
                                            ],
                                           @json_decode($seo->meta_robots_advanced,true),['style'=>'height: 144px','id'=>'seo_meta-robots-adv','multiple'=>'multiple']) !!}

                                            <div>Advanced <code>meta</code> robots settings for this page.</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <table class="form-table table">
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="tab-pane fade" id="tabSeo2" role="tabpanel" aria-labelledby="tabSeo2-tab">
            2
        </div>
    </div>

@stop
