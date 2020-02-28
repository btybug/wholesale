@extends('layouts.admin',['activePage'=>'staff'])
@section('content')

    <div id="cv" class="instaFade">
        <div class="mainDetails">
            <div id="headshot" class="quickFade">
                <img src="{!!  url(Storage::disk('local')->url('app/public/'.$model->photo))!!}" alt="user"/>
            </div>

            <div id="name">
{{--                <h1 class="quickFade delayTwo">{!! $model->name.' '.$model->last_name !!}</h1>--}}
{{--                <h2 class="quickFade delayThree">{!! $model->role->name !!}</h2>--}}
            </div>

            <div id="contactDetails" class="quickFade delayFour">
                <ul>
                    <li>e: <a href="mailto:joe@bloggs.com" target="_blank">{!! $model->email !!}</a></li>
                    <li>m: {!! $model->phone !!}</li>
                    <li>a: {!! $model->address !!}</li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>

        <div id="mainArea" class="quickFade delayFive">
            <section>
                <article>
                    <div class="sectionTitle">
                        <h1>Gender</h1>
                    </div>

                    <div class="sectionContent">
                        <p>{!! $model->gender !!}</p>
                    </div>
                </article>
                <div class="clear"></div>
            </section>


            <section>
                <div class="sectionTitle">
                    <h1>Passport</h1>
                </div>

                <div class="sectionContent">
                    <article>
                        <h2>{!! $model->pass_type !!}</h2>
                        <p>{!! $model->app_pass !!}</p>
                    </article>
                </div>
                <div class="clear"></div>
            </section>


            <section>
                <div class="sectionTitle">
                    <h1>Status</h1>
                </div>

                <div class="sectionContent">
                    <article>
{{--                        <p>{!! \App\Models\Staff::$statuses[$model->status] !!}</p>--}}
                    </article>
                </div>
                <div class="clear"></div>
            </section>
            <section>
                <div class="sectionTitle">
                    <h1>Family Status</h1>
                </div>
                <div class="sectionContent">

                    <article>
                        <p>{!! $model->family_status !!}</p>
                    </article>
                </div>
                <div class="clear"></div>
            </section>
            <section>
                <div class="sectionTitle">
                    <h1>Rating</h1>
                </div>
                <div class="sectionContent">

                    <article>
                        <p>{!! $model->rating !!}</p>
                    </article>
                </div>
                <div class="clear"></div>
            </section>


            <section>
                <div class="sectionTitle">
                    <h1>Shop</h1>
                </div>
                <div class="sectionContent">

                    <article>
{{--                        <p>{!! $model->shop->name !!}</p>--}}
                    </article>
                </div>
                <div class="clear"></div>
            </section>
            <section>
                <div class="sectionTitle">
                    <h1>Salary</h1>
                </div>
                <div class="sectionContent">

                    <article>
                        <p>{!! $model->salary !!}</p>
                    </article>
                </div>
                <div class="clear"></div>
            </section>
            <section>
                <div class="sectionTitle">
                    <h1>Hired At</h1>
                </div>
                <div class="sectionContent">

                    <article>
                        <p>{!! $model->hired_at !!}</p>
                    </article>
                </div>
                <div class="clear"></div>
            </section>
            <section>
                <div class="sectionTitle">
                    <h1>Ability</h1>
                </div>
                <div class="sectionContent">

                    <article>
                        <p>{!! $model->role->description !!}</p>
                    </article>
                </div>
                <div class="clear"></div>
            </section>
            <section>
                <div class="sectionTitle" data-barcode="{!! $model->app_pass !!}">
{{--                    {!! $barcode !!}--}}
                </div>
                <div id="svg_barcode"></div>
                <div class="clear"></div>
            </section>


        </div>
    </div>
@stop
@section('css')
    <link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700|Lato:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/public/css/cv.css">
@stop
@section('js')
    <script>
        $(document).ready(function() {
            $('#svg_barcode').append(`<svg id="svg_${$('.sectionTitle[data-barcode]').data('barcode')}"></svg>`)
            JsBarcode(`#svg_${$('.sectionTitle[data-barcode]').data('barcode')}`, $('.sectionTitle[data-barcode]').data('barcode'), {
                // format,
                // font: text_font,
                // fontSize: font_size,
                // textMargin: text_margin,
                // height,
                // width,
                // margin,
                // background: back_color,
                // lineColor: line_color,
                // textAlign: text_align,
                // fontOptions,
                // displayValue,
            })
                .render();
        });
    </script>
@stop