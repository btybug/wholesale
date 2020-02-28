@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header clearfix">
            <h2 class="m-0 pull-left">SEO</h2>
            <div class="pull-right">
                <button class="btn btn-info save">Save</button>
            </div>
        </div>
        <div class="card-body">
            {!! Form::open(['id' => 'rowsEditForm']) !!}
            <div class="">
                @if(count(get_languages()))
                    <ul class="nav nav-tabs mb-3">
                        @foreach(get_languages() as $language)
                            <li class="nav-item "><a class="nav-link @if($loop->first) active @endif"
                                                     data-toggle="tab"
                                                     href="#{{ strtolower($language->code) }}">
                                            <span
                                                class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                </a></li>
                        @endforeach
                    </ul>
                @endif


                @if(count(get_languages()))
                    @foreach(get_languages() as $language)
                        <div id="{{ strtolower($language->code) }}"
                             class="tab-pane fade  @if($loop->first) in active show @endif">
                            <div class="container-fluid">
                                <div><h3>Stock Multiple SEO Edit</h3></div>
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Focus Keyword:</th>
                                            <th>SEO Title:</th>
                                            <th>Meta description:</th>
                                            <th>URL:</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($posts as $post)
                                            <tr>
                                                <td>
                                                    {!! $post->id !!}
                                                </td>
                                                <td>
                                                    {!! get_translated($post,strtolower($language->code),'title') !!}

                                                </td>
                                                <td>
                                                    {!! Form::text($post->id.'[translatable]['.strtolower($language->code).'][keywords]',get_translated($post->seo,strtolower($language->code),'keywords'),['class'=>'form-control','placeholder'=>getSeo($general,'og:keywords',$post)]) !!}


                                                </td>
                                                <td>
                                                    {!! Form::text($post->id.'[translatable]['.strtolower($language->code).'][title]',get_translated($post->seo,strtolower($language->code),'title'),['class'=>'form-control','placeholder'=>getSeo($general,'og:title',$post)]) !!}

                                                </td>
                                                <td>
                                                    {!! Form::textarea($post->id.'[translatable]['.strtolower($language->code).'][description]',get_translated($post->seo,strtolower($language->code),'description'),['class'=>'form-control','rows'=>2,'placeholder'=>getSeo($general,'og:description',$post)]) !!}

                                                </td>

                                                <td>
                                                    {!! Form::text($post->id.'[post][translatable]['.strtolower($language->code).'][url]',get_translated($post,strtolower($language->code),'url'),['class'=>'form-control']) !!}
                                                    {!! Form::hidden($post->id.'[seo_id]',($post->seo)?$post->seo->id:null)!!}
                                                </td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        {!! Form::close() !!}
    </div>
    </div>

@stop
@section('js')
    <script>
        $(function () {
            $('.save').on('click',function () {
                $('form#rowsEditForm').submit();
            })
        })
    </script>
@stop
