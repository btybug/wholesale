@extends('layouts.admin')
@section('content')
    {!! Form::model($stock) !!}
<div class="card panel panel-default">
    <div class="card-header panel-heading clearfix">
        <h2 class="m-0 pull-left">SEO Edit Product</h2>
        <div class="pull-right btn-save">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>

    <div class="card-body panel-body">
        <div class="card panel panel-default mt-20 mb-3">
            <div class="card-header panel-heading">FB</div>
            <div class="card-body panel-body">
                <div class="form-group">
                    <div class="row">
                        <label for="seo-facebook-title" class="col-md-2 col-xs-12">Facebook Title</label>
                        <div class="col-md-5 col-xs-12">
                            {!! Form::text('fb[og:title]',($stock)?$stock->getSeoField('og:title','fb'):null,['class'=>'form-control','placeholder'=>getSeo($fbSeo,'og:title',$stock)]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="seo-facebook-desc" class="col-md-2 col-xs-12">Facebook Description</label>
                        <div class="col-md-5 col-xs-12">
                            {!! Form::text('fb[og:description]',($stock)?$stock->getSeoField('og:description','fb'):null,['class'=>'form-control','placeholder'=>getSeo($fbSeo,'og:description',$stock)]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-2 col-xs-12">Facebook Image</label>
                        <div class="col-md-5 col-xs-12">
                            {!! Form::text(null,null,['class'=>'form-control','readonly','disabled','placeholder'=>getSeo($fbSeo,'og:image',$stock)]) !!}

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
                            {!! Form::text('twitter[og:title]',($stock)?$stock->getSeoField('og:title','twitter'):null,['class'=>'form-control','placeholder'=>getSeo($twitterSeo,'og:description',$stock)]) !!}

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="seo-twitter-desc" class="col-md-2 col-xs-12">Twitter Description</label>
                        <div class="col-md-5 col-xs-12">
                            {!! Form::text('twitter[og:description]',($stock)?$stock->getSeoField('og:description','twitter'):null,['class'=>'form-control','placeholder'=>getSeo($twitterSeo,'og:description',$stock)]) !!}

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-2 col-xs-12">Twitter Image</label>
                        <div class="col-md-5 col-xs-12">
                            {!! Form::text(null,null,['class'=>'form-control','readonly','disabled','placeholder'=>getSeo($twitterSeo,'og:image',$stock)]) !!}
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
                                {!! Form::text('general[og:keywords]',($stock)?$stock->getSeoField('og:keywords'):null,['class'=>'form-control','placeholder'=>getSeo($general,'og:keywords',$stock)]) !!}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="seo_title">SEO Title:</label>
                                <img src="/public/images/question-mark.png" alt="question">
                            </th>
                            <td>
                                {!! Form::text('general[og:title]',($stock)?$stock->getSeoField('og:title'):null,['class'=>'form-control','placeholder'=>getSeo($general,'og:title',$stock)]) !!}
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
                                {!! Form::textarea('general[og:description]',($stock)?$stock->getSeoField('og:title'):null,['class'=>'form-control','rows'=>2,'placeholder'=>getSeo($general,'og:description',$stock)]) !!}
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
                                {!! Form::select('robot[robots]',[null=>isset($robot)?(($robot->robots)?'As default Index':'As default No Index'):null,'1'=>'Index','0'=>'No Index'],($stock)?$stock->getSeoField('robots','robot'):null,['class'=>'']) !!}

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