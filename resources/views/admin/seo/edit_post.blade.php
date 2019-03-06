@extends('layouts.admin')
@section('content')
    {!! Form::model($post) !!}
<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h2 class="m-0 pull-left">SEO Edit Post</h2>
        <div class="pull-right btn-save">
            <button type="submit" class="btn btn-info">Save</button>
        </div>
    </div>

    <div class="panel-body">
        <div class="panel panel-default mt-20">
            <div class="panel-heading">FB</div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="row">
                        <label for="seo-facebook-title" class="col-md-2 col-xs-12">Facebook Title</label>
                        <div class="col-md-5 col-xs-12">
                            {!! Form::text('fb[og:title]',($post)?$post->getSeoField('og:title','fb'):null,['class'=>'form-control','placeholder'=>getSeo($fbSeo,'og:title',$post)]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="seo-facebook-desc" class="col-md-2 col-xs-12">Facebook Description</label>
                        <div class="col-md-5 col-xs-12">
                            {!! Form::text('fb[og:description]',($post)?$post->getSeoField('og:description','fb'):null,['class'=>'form-control','placeholder'=>getSeo($fbSeo,'og:description',$post)]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-2 col-xs-12">Facebook Image</label>
                        <div class="col-md-5 col-xs-12">
                            {!! Form::text(null,null,['class'=>'form-control','readonly','disabled','placeholder'=>getSeo($fbSeo,'og:image',$post)]) !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default mt-20">
            <div class="panel-heading">Twitter</div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="row">
                        <label for="seo-twitter-title" class="col-md-2 col-xs-12">Twitter Title</label>
                        <div class="col-md-5 col-xs-12">
                            {!! Form::text('twitter[og:title]',($post)?$post->getSeoField('og:title','twitter'):null,['class'=>'form-control','placeholder'=>getSeo($twitterSeo,'og:description',$post)]) !!}

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="seo-twitter-desc" class="col-md-2 col-xs-12">Twitter Description</label>
                        <div class="col-md-5 col-xs-12">
                            {!! Form::text('twitter[og:description]',($post)?$post->getSeoField('og:description','twitter'):null,['class'=>'form-control','placeholder'=>getSeo($twitterSeo,'og:description',$post)]) !!}

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-2 col-xs-12">Twitter Image</label>
                        <div class="col-md-5 col-xs-12">
                            {!! Form::text(null,null,['class'=>'form-control','readonly','disabled','placeholder'=>getSeo($twitterSeo,'og:image',$post)]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="seo-general-content">
                    <table class="form-table table">
                        <tbody>
                        <tr>
                            <th scope="row">
                                <label for="seo_focuskw">Focus Keyword:</label>
                                <img src="/public/images/question-mark.png" alt="question">
                            </th>
                            <td>
                                {!! Form::text('general[og:keywords]',($post)?$post->getSeoField('og:keywords'):null,['class'=>'form-control','placeholder'=>getSeo($general,'og:keywords',$post)]) !!}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="seo_title">SEO Title:</label>
                                <img src="/public/images/question-mark.png" alt="question">
                            </th>
                            <td>
                                {!! Form::text('general[og:title]',($post)?$post->getSeoField('og:title'):null,['class'=>'form-control','placeholder'=>getSeo($general,'og:title',$post)]) !!}
                                <br>
                                <div>
                                    <p><span class="wrong">Warning:</span>
                                        Title display in Google is limited to a fixed width, yours is too long.
                                    </p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="seo_metadesc">Meta description:</label>
                                <img src="/public/images/question-mark.png" alt="question">
                            </th>
                            <td>
                                {!! Form::textarea('general[og:description]',($post)?$post->getSeoField('og:title'):null,['class'=>'form-control','rows'=>2,'placeholder'=>getSeo($general,'og:description',$post)]) !!}
                                <div>The <code>meta</code> description will be limited to 156 chars, 156 chars left.
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="seo-advanced">
                    <table class="form-table table">
                        <tbody>
                        <tr>
                            <th scope="row">
                                <label for="seo_meta-robots-noindex">Meta Robots Index:</label>
                            </th>
                            <td>
                                {!! Form::select('robot[robots]',[null=>isset($robot)?(($robot->robots)?'As default Index':'As default No Index'):null,'1'=>'Index','0'=>'No Index'],($post)?$post->getSeoField('robots','robot'):null,['class'=>'']) !!}

                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Meta Robots Follow</th>
                            <td>
                                <input type="radio" checked="checked" id="seo_meta-robots-nofollow_0"
                                       value="0">
                                <label for="seo_meta-robots-nofollow_0">Follow</label>
                                <input type="radio" id="seo_meta-robots-nofollow_1"
                                       value="1">
                                <label for="seo_meta-robots-nofollow_1">Nofollow</label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="seo_meta-robots-adv">Meta Robots Advanced:</label>
                            </th>
                            <td>
                                <select multiple="multiple" size="7" style="height: 144px;"
                                        id="seo_meta-robots-adv"
                                        class="">
                                    <option selected="selected" value="-">Site-wide default: None</option>
                                    <option value="none">None</option>
                                    <option value="noodp">NO ODP</option>
                                    <option value="noydir">NO YDIR</option>
                                    <option value="noimageindex">No Image Index</option>
                                    <option value="noarchive">No Archive</option>
                                    <option value="nosnippet">No Snippet</option>
                                </select>
                                <div>Advanced <code>meta</code> robots settings for this page.</div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="seo_canonical">Canonical URL:</label>
                            </th>
                            <td>
                                <input type="text" id="seo_canonical" value=""
                                       class="form-control"><br>
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
            <div class="col-md-3">

            </div>
        </div>
    </div>
</div>
    {!! Form::close() !!}
    @stop