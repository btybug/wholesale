@extends('layouts.admin')
@section('content-header')
    {{--<h1>--}}
    {{--Dashboard--}}
    {{--<small>Control panel</small>--}}
    {{--</h1>--}}
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-12">

            <div class="profile-header">

                <div class="profile-header-cover"></div>

                <div class="profile-header-content">

                    <div class="profile-header-img">
                        <img src="{!! user_avatar() !!}" class="user-image" alt="User Image">
                    </div>

                    <div class="profile-header-info">
                        <h4 class="m-t-10 m-b-5">{{ Auth::user()->name }}</h4>
                        <p class="m-b-10">{{ Auth::user()->role->title }}</p>
                        {{--<a href="#" class="btn btn-xs btn-info">Edit Profile</a>--}}

                    </div>

                </div>

                <ul class="profile-header-tab nav nav-tabs">
                    <li class="nav-item"><a href="{{ route('admin_dashboard') }}" class="nav-link active">Dashboard</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('admin_dashboard_profile') }}" class="nav-link ">Profile</a>
                    </li>

                </ul>

            </div>

            <div class="clearfix mt-5">
                <aside class="Header-auth main-header-auth pull-left" id="header-auth">
                    <div class="Header-embedApi" id="embed-api-auth-container" ga-on="click" ga-event-category="User"
                         ga-event-label="auth" ga-event-action="signin">
                    </div>
                </aside>
                <button class="btn btn-primary open_dashboard_widget pull-right">Add new Widget</button>
            </div>
        </div>

    </div>

    <aside class="Header-auth" id="header-auth">
        <h3 class="Header-embedApi" id="embed-api-auth-container" ga-on="click" ga-event-category="User"
            ga-event-label="auth" ga-event-action="signin">
        </h3>
    </aside>
    <div id="sortable-9">

    </div>
    <div class="row">
        <div class="col-sm-12 connectedSortable" data-placement="top">
            {!! render_widgets('top') !!}
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-6 connectedSortable" data-placement="small_left">
            {!! render_widgets('small_left') !!}
        </div>
        <div class="col-xl-3 col-lg-6 connectedSortable" data-placement="small_middle_left">
            {!! render_widgets('small_middle_left') !!}
        </div>
        <div class="col-xl-3 col-lg-6 connectedSortable" data-placement="small_middle_right">
            {!! render_widgets('small_middle_right') !!}
        </div>
        <div class="col-xl-3 col-lg-6 connectedSortable" data-placement="small_right">
            {!! render_widgets('small_right') !!}
        </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable" data-placement="bottom_7">
            {!! render_widgets('bottom_7') !!}
        </section>
        <section class="col-lg-5 connectedSortable" data-placement="bottom_5">
            {!! render_widgets('bottom_5') !!}
        </section>
        <!-- right col -->
    </div>

    <!-- /.row (main row) -->
    <div class="dashboard_modal_add_widget">
        @php
            $permissions=config('widgets');
        @endphp
        <div class="modal_add_widget">
            <button class="btn btn-danger btn-block close-widget-modal">CLOSE</button>
            <div class="connectedSortable" id="connectedSortable">
                @foreach($permissions as $key => $item)
                    @if(! in_array($key,$widgets))
                        <div id="{{ $key }}">
                            <div class="box-header">
                               {!! $item['name'] !!}
                            </div>
                            <div class="widget-html hide">
                                @include($item['view'])
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>


    </div>
@stop
@section('css')
    <!-- jvectormap -->
    {!! Html::style("public/admin_theme/bower_components/jvectormap/jquery-jvectormap.css") !!}
    {!! Html::style("public/admin_assets/css/dashboard.css") !!}
    {!! HTML::style('/public/js/google/analytic/index.css') !!}
@stop
@section('js')


    <!-- jvectormap -->
    {!! Html::script("public/admin_theme/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js")!!}
    {!! Html::script("public/admin_theme/plugins/jvectormap/jquery-jvectormap-world-mill-en.js")!!}
    {!! Html::script("public/admin_theme/dist/js/pages/dashboard.js?v=".rand(111,999))!!}

    <!-- Include the ViewSelector2 component script. -->

    <script>

    </script>
    <script>
        (function (w, d, s, g, js, fs) {
            g = w.gapi || (w.gapi = {});
            g.analytics = {
                q: [], ready: function (f) {
                    this.q.push(f);
                }
            };
            js = d.createElement(s);
            fs = d.getElementsByTagName(s)[0];
            js.src = 'https://apis.google.com/js/platform.js';
            fs.parentNode.insertBefore(js, fs);
            js.onload = function () {
                g.load('analytics');
            };
        }(window, document, 'script'));
    </script>
    {!! HTML::script('/public/js/google/analytic/view-selector2.js') !!}
    {!! HTML::script('/public/js/google/analytic/date-range-selector.js') !!}
    <script>
        {{--gapi.analytics.ready(function () {--}}
            {{--console.log(gapi);--}}
            {{--/**--}}
             {{--* Authorize the user immediately if the user has already granted access.--}}
             {{--* If no access has been created, render an authorize button inside the--}}
             {{--* element with the ID "embed-api-auth-container".--}}
             {{--*/--}}
{{--//            gapi.analytics.auth.authorize({--}}
{{--//                serverAuth: {--}}
{{--//                    access_token:'ya29.GluuBn8n-XNRJimEWv1Wlarl3Q2Fj7hnJotqnrXeKSVkFXA_hgB3TVHou_ltLAGrGreCvlr1fwujXfs-TVJUWb0GP1_lRcqV-3rqV6zK1Lt7ndwfmkjOWJLlquuE'--}}
{{--//                }--}}
{{--//            });--}}
            {{--gapi.analytics.auth.authorize({--}}
                {{--container: 'embed-api-auth-container',--}}
                {{--clientid: '{!! env('GOOGLE_CLIENT_ID') !!}'--}}
            {{--});--}}
            {{--var commonConfig = {--}}
                {{--query: {--}}
                    {{--metrics: 'ga:sessions',--}}
                    {{--dimensions: 'ga:date'--}}
                {{--},--}}
                {{--chart: {--}}
                    {{--type: 'LINE',--}}
                    {{--options: {--}}
                        {{--width: '100%'--}}
                    {{--}--}}
                {{--}--}}
            {{--};--}}


            {{--/**--}}
             {{--* Query params representing the first chart's date range.--}}
             {{--*/--}}
            {{--var dateRange1 = {--}}
                {{--'start-date': '14daysAgo',--}}
                {{--'end-date': 'today',--}}
                {{--'metrics': 'ga:visitors'--}}
            {{--};--}}


            {{--/**--}}
             {{--* Query params representing the second chart's date range.--}}
             {{--*/--}}
            {{--var dateRange2 = {--}}
                {{--'start-date': '7daysAgo',--}}
                {{--'end-date': 'today'--}}
            {{--};--}}
            {{--var dateRange3 = {--}}
                {{--'ids': 'ga:ranges', // <-- Replace with the ids value for your view.--}}
                {{--'start-date': '30daysAgo',--}}
                {{--'end-date': 'yesterday',--}}
                {{--'metrics': 'ga:pageviews',--}}
                {{--'dimensions': 'ga:pagePathLevel1',--}}
                {{--'sort': '-ga:pageviews',--}}
                {{--'filters': 'ga:pagePathLevel1!=/',--}}
                {{--'max-results': '7',--}}
            {{--};--}}
            {{--var dateRange4 = {--}}
                {{--'ids': 'ga:{!! env('ANALYTICS_VIEW') !!}', // <-- Replace with the ids value for your view.--}}
                {{--'start-date': '30daysAgo',--}}
                {{--'end-date': 'today',--}}
                {{--'metrics': 'ga:sessions,ga:users',--}}
                {{--'dimensions': 'ga:date'--}}
            {{--};--}}


            {{--/**--}}
             {{--* Create a new ViewSelector2 instance to be rendered inside of an--}}
             {{--* element with the id "view-selector-container".--}}
             {{--*/--}}
            {{--var viewSelector = new gapi.analytics.ext.ViewSelector2({--}}
                {{--container: 'view-selector-container',--}}
            {{--}).execute();--}}


            {{--/**--}}
             {{--* Create a new DateRangeSelector instance to be rendered inside of an--}}
             {{--* element with the id "date-range-selector-1-container", set its date range--}}
             {{--* and then render it to the page.--}}
             {{--*/--}}
{{--//            var dateRangeSelector1 = new gapi.analytics.ext.DateRangeSelector({--}}
{{--//                container: 'date-range-selector-1-container'--}}
{{--//            })--}}
{{--//                .set(dateRange1)--}}
{{--//                .execute();--}}

            {{--/**--}}
             {{--* Create a new DateRangeSelector instance to be rendered inside of an--}}
             {{--* element with the id "date-range-selector-2-container", set its date range--}}
             {{--* and then render it to the page.--}}
             {{--*/--}}
{{--//            var dateRangeSelector2 = new gapi.analytics.ext.DateRangeSelector({--}}
{{--//                container: 'date-range-selector-2-container'--}}
{{--//            })--}}
{{--//                .set(dateRange2)--}}
{{--//                .execute();--}}
{{--//            var dateRangeSelector3 = new gapi.analytics.ext.DateRangeSelector({--}}
{{--//                container: 'date-range-selector-3-container'--}}
{{--//            })--}}
{{--//                .set(dateRange3)--}}
{{--//                .execute();--}}
{{--//            var dateRangeSelector4 = new gapi.analytics.ext.DateRangeSelector({--}}
{{--//                container: 'date-range-selector-4-container'--}}
{{--//            })--}}
{{--//                .set(dateRange4)--}}
{{--//                .execute();--}}


            {{--/**--}}
             {{--* Create a new DataChart instance with the given query parameters--}}
             {{--* and Google chart options. It will be rendered inside an element--}}
             {{--* with the id "data-chart-1-container".--}}
             {{--*/--}}
{{--//            var dataChart1 = new gapi.analytics.googleCharts.DataChart(commonConfig)--}}
{{--//                .set({query: dateRange1})--}}
{{--//                .set({chart: {container: 'data-chart-1-container'}});--}}
{{--//--}}
{{--//--}}
{{--//            /**--}}
{{--//             * Create a new DataChart instance with the given query parameters--}}
{{--//             * and Google chart options. It will be rendered inside an element--}}
{{--//             * with the id "data-chart-2-container".--}}
{{--//             */--}}
{{--//            var dataChart2 = new gapi.analytics.googleCharts.DataChart(commonConfig)--}}
{{--//                .set({query: dateRange2})--}}
{{--//                .set({chart: {container: 'data-chart-2-container'}});--}}
{{--//--}}
{{--//            var dataChart3 = new gapi.analytics.googleCharts.DataChart(commonConfig).set({--}}
{{--//                chart: {--}}
{{--//                    'container': 'data-chart-3-container',--}}
{{--//                    'type': 'PIE',--}}
{{--//                    'options': {--}}
{{--//                        'width': '100%',--}}
{{--//                        'pieHole': '4/9'--}}
{{--//                    }--}}
{{--//                }--}}
{{--//            }).set({query: dateRange3});--}}
{{--//--}}
{{--//            var dataChart4 = new gapi.analytics.googleCharts.DataChart(commonConfig).set({--}}
{{--//                chart: {--}}
{{--//                    'container': 'data-chart-4-container',--}}
{{--//                    'type': 'LINE',--}}
{{--//                    'options': {--}}
{{--//                        'width': '100%'--}}
{{--//                    }--}}
{{--//                }--}}
{{--//            }).set({query: dateRange4})--}}


            {{--/**--}}
             {{--* Register a handler to run whenever the user changes the view.--}}
             {{--* The handler will update both dataCharts as well as updating the title--}}
             {{--* of the dashboard.--}}
             {{--*/--}}
{{--//            viewSelector.on('viewChange', function (data) {--}}
{{--//                dataChart1.set({query: {ids: data.ids}}).execute();--}}
{{--//                dataChart2.set({query: {ids: data.ids}}).execute();--}}
{{--//                dataChart3.set({query: {ids: data.ids}}).execute();--}}
{{--//                dataChart4.set({query: {ids: data.ids}}).execute();--}}
{{--//                var title = document.getElementById('view-name');--}}
{{--//                title.innerHTML = data.property.name + ' (' + data.view.name + ')';--}}
{{--//            });--}}


            {{--/**--}}
             {{--* Register a handler to run whenever the user changes the date range from--}}
             {{--* the first datepicker. The handler will update the first dataChart--}}
             {{--* instance as well as change the dashboard subtitle to reflect the range.--}}
             {{--*/--}}
{{--//            dateRangeSelector1.on('change', function (data) {--}}
{{--//                dataChart1.set({query: data}).execute();--}}
{{--//--}}
{{--//                // Update the "from" dates text.--}}
{{--//                var datefield = document.getElementById('from-dates');--}}
{{--//                datefield.innerHTML = data['start-date'] + '&mdash;' + data['end-date'];--}}
{{--//            });--}}


            {{--/**--}}
             {{--* Register a handler to run whenever the user changes the date range from--}}
             {{--* the second datepicker. The handler will update the second dataChart--}}
             {{--* instance as well as change the dashboard subtitle to reflect the range.--}}
             {{--*/--}}
{{--//            dateRangeSelector2.on('change', function (data) {--}}
{{--//                dataChart2.set({query: data}).execute();--}}
{{--//--}}
{{--//                // Update the "to" dates text.--}}
{{--//                var datefield = document.getElementById('to-dates');--}}
{{--//                datefield.innerHTML = data['start-date'] + '&mdash;' + data['end-date'];--}}
{{--//            });--}}
{{--//            dateRangeSelector3.on('change', function (data) {--}}
{{--//                dataChart3.set({query: data}).execute();--}}
{{--//--}}
{{--//                // Update the "to" dates text.--}}
{{--//                var datefield = document.getElementById('to-dates');--}}
{{--//                datefield.innerHTML = data['start-date'] + '&mdash;' + data['end-date'];--}}
{{--//            });--}}
{{--//            dateRangeSelector4.on('change', function (data) {--}}
{{--//                dataChart4.set({query: data}).execute();--}}
{{--//--}}
{{--//                // Update the "to" dates text.--}}
{{--//                var datefield = document.getElementById('to-dates');--}}
{{--//                datefield.innerHTML = data['start-date'] + '&mdash;' + data['end-date'];--}}
{{--//            });--}}
        {{--});--}}

    </script>
@stop
