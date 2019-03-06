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
        <div class="col-xs-12">

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
                    <li class="nav-item"><a href="{{ route('admin_dashboard') }}" class="nav-link active" >Dashboard</a></li>
                    <li class="nav-item"><a href="{{ route('admin_dashboard_profile') }}" class="nav-link ">Profile</a></li>
                </ul>

            </div>

            <div class="clearfix">
                <aside class="Header-auth main-header-auth pull-left" id="header-auth">
                    <div class="Header-embedApi" id="embed-api-auth-container" ga-on="click" ga-event-category="User" ga-event-label="auth" ga-event-action="signin">
                    </div>
                </aside>
                <button class="btn btn-primary open_dashboard_widget pull-right">Add new Widget</button>
            </div>
        </div>

    </div>

    <aside class="Header-auth" id="header-auth">
        <h3 class="Header-embedApi" id="embed-api-auth-container" ga-on="click" ga-event-category="User" ga-event-label="auth" ga-event-action="signin">
        </h3>
    </aside>

    <div class="connectedSortable">

        <!-- sortable item -->

        <!-- sortable item -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="panel panel-default">
                        <div class="box-header panel-heading clearfix">
                            <h3 class="pull-left m-0 lh-1">Title</h3>
                            <div class="pull-right">
                                <button type="button" class="btn btn-info btn-sm daterange pull-right" data-toggle="tooltip" title="" data-original-title="Date range">
                                    <i class="fa fa-calendar"></i>
                                </button>
                                <span class="d-inline-block mr-10" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                        <button type="button" class="btn btn-for-widget btn-info btn-sm pull-right" data-toggle="collapse" data-target="#collapseWidget-2" >
                            <i class="fa fa-minus"></i></button>
                    </span>

                            </div>
                        </div>
                        <div id="collapseWidget-2" class="panel-body collapse in" aria-expanded="true">
                            <div class="Dashboard Dashboard--full">
                                <header class="Dashboard-header">
                                    <div class="Titles">
                                        <h1 class="Titles-main" id="view-name">{!! env('SITE_NAME') !!} (All Web Site Data)</h1>
                                        <div class="Titles-sub">Comparing sessions from
                                            <b id="from-dates">last week</b>
                                            to <b id="to-dates">this week</b>
                                        </div>
                                    </div>
                                    <div id="view-selector-container"></div>
                                </header>

                                <ul class="FlexGrid">
                                    <li class="FlexGrid-item">
                                        <div id="data-chart-1-container">
                                        </div>
                                        <div id="date-range-selector-1-container">
                                        </div>

                                    </li>
                                    <li class="FlexGrid-item">
                                        <div id="data-chart-2-container">
                                        </div>
                                        <div id="date-range-selector-2-container"></div>
                                    </li>
                                    <li class="FlexGrid-item">
                                        <div id="data-chart-3-container">
                                        </div>
                                        <div id="date-range-selector-3-container"></div>
                                    </li>
                                </ul>
                            </div>
                            <div class="Dashboard Dashboard--full">

                                <ul class="FlexGrid">
                                    <li class="FlexGrid-item">
                                        <div id="data-chart-4-container">
                                        </div>
                                        <div id="date-range-selector-4-container"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="row">
    @include('admin.widgets.new_orders')
    <!-- ./col -->
    @include('admin.widgets.bounce_rate')
    <!-- ./col -->
    @include('admin.widgets.user_registrations')
    <!-- ./col -->
    @include('admin.widgets.unique_visitors')
    <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                    <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
                    <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
                </ul>
                <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart"
                         style="position: relative; height: 300px;"></div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                </div>
            </div>
            <!-- /.nav-tabs-custom -->

            <!-- Chat box -->
            <div class="box box-success">
                <div class="box-header">
                    <i class="fa fa-comments-o"></i>

                    <h3 class="box-title">Chat</h3>

                    <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                        <div class="btn-group" data-toggle="btn-toggle">
                            <button type="button" class="btn btn-default btn-sm active"><i
                                        class="fa fa-square text-green"></i>
                            </button>
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="box-body chat" id="chat-box">
                    <!-- chat item -->
                    <div class="item">
                        <img src="public/admin_theme/dist/img/user4-128x128.jpg" alt="user image" class="online">

                        <p class="message">
                            <a href="#" class="name">
                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                                Mike Doe
                            </a>
                            I would like to meet you to discuss the latest news about
                            the arrival of the new theme. They say it is going to be one the
                            best themes on the market
                        </p>
                        <div class="attachment">
                            <h4>Attachments:</h4>

                            <p class="filename">
                                Theme-thumbnail-image.jpg
                            </p>

                            <div class="pull-right">
                                <button type="button" class="btn btn-primary btn-sm btn-flat">Open</button>
                            </div>
                        </div>
                        <!-- /.attachment -->
                    </div>
                    <!-- /.item -->
                    <!-- chat item -->
                    <div class="item">
                        <img src="public/admin_theme/dist/img/user3-128x128.jpg" alt="user image" class="offline">

                        <p class="message">
                            <a href="#" class="name">
                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
                                Alexander Pierce
                            </a>
                            I would like to meet you to discuss the latest news about
                            the arrival of the new theme. They say it is going to be one the
                            best themes on the market
                        </p>
                    </div>
                    <!-- /.item -->
                    <!-- chat item -->
                    <div class="item">
                        <img src="public/admin_theme/dist/img/user2-160x160.jpg" alt="user image" class="offline">

                        <p class="message">
                            <a href="#" class="name">
                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                                Susan Doe
                            </a>
                            I would like to meet you to discuss the latest news about
                            the arrival of the new theme. They say it is going to be one the
                            best themes on the market
                        </p>
                    </div>
                    <!-- /.item -->
                </div>
                <!-- /.chat -->
                <div class="box-footer">
                    <div class="input-group">
                        <input class="form-control" placeholder="Type message...">

                        <div class="input-group-btn">
                            <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box (chat box) -->

            <!-- TO DO List -->
            <div class="box box-primary">
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>

                    <h3 class="box-title">To Do List</h3>

                    <div class="box-tools pull-right">
                        <ul class="pagination pagination-sm inline">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                    <ul class="todo-list">
                        <li>
                            <!-- drag handle -->
                            <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                            <!-- checkbox -->
                            <input type="checkbox" value="">
                            <!-- todo text -->
                            <span class="text">Design a nice theme</span>
                            <!-- Emphasis label -->
                            <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                            <!-- General tools such as edit or delete-->
                            <div class="tools">
                                <i class="fa fa-edit"></i>
                                <i class="fa fa-trash-o"></i>
                            </div>
                        </li>
                        <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                            <input type="checkbox" value="">
                            <span class="text">Make the theme responsive</span>
                            <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                            <div class="tools">
                                <i class="fa fa-edit"></i>
                                <i class="fa fa-trash-o"></i>
                            </div>
                        </li>
                        <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                            <input type="checkbox" value="">
                            <span class="text">Let theme shine like a star</span>
                            <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                            <div class="tools">
                                <i class="fa fa-edit"></i>
                                <i class="fa fa-trash-o"></i>
                            </div>
                        </li>
                        <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                            <input type="checkbox" value="">
                            <span class="text">Let theme shine like a star</span>
                            <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                            <div class="tools">
                                <i class="fa fa-edit"></i>
                                <i class="fa fa-trash-o"></i>
                            </div>
                        </li>
                        <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                            <input type="checkbox" value="">
                            <span class="text">Check your messages and notifications</span>
                            <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                            <div class="tools">
                                <i class="fa fa-edit"></i>
                                <i class="fa fa-trash-o"></i>
                            </div>
                        </li>
                        <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                            <input type="checkbox" value="">
                            <span class="text">Let theme shine like a star</span>
                            <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                            <div class="tools">
                                <i class="fa fa-edit"></i>
                                <i class="fa fa-trash-o"></i>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                    <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item
                    </button>
                </div>
            </div>
            <!-- /.box -->

            <!-- quick email widget -->
            @include('admin.widgets.quick_email')

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

            <!-- Map box -->
        @include('admin.widgets.map_box')
        <!-- /.box -->

            <!-- solid sales graph -->
            <div class="box box-solid bg-teal-gradient">
                <div class="box-header">
                    <i class="fa fa-th"></i>

                    <h3 class="box-title">Sales Graph</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i
                                    class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body border-radius-none">
                    <div class="chart" id="line-chart" style="height: 250px;"></div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer no-border">
                    <div class="row">
                        <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                            <input type="text" class="knob" data-readonly="true" value="20" data-width="60"
                                   data-height="60"
                                   data-fgColor="#39CCCC">

                            <div class="knob-label">Mail-Orders</div>
                        </div>
                        <!-- ./col -->
                        <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                            <input type="text" class="knob" data-readonly="true" value="50" data-width="60"
                                   data-height="60"
                                   data-fgColor="#39CCCC">

                            <div class="knob-label">Online</div>
                        </div>
                        <!-- ./col -->
                        <div class="col-xs-4 text-center">
                            <input type="text" class="knob" data-readonly="true" value="30" data-width="60"
                                   data-height="60"
                                   data-fgColor="#39CCCC">

                            <div class="knob-label">In-Store</div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->

            <!-- Calendar -->
            <div class="box box-solid bg-green-gradient">
                <div class="box-header">
                    <i class="fa fa-calendar"></i>

                    <h3 class="box-title">Calendar</h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <!-- button with a dropdown -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bars"></i></button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="#">Add new event</a></li>
                                <li><a href="#">Clear events</a></li>
                                <li class="divider"></li>
                                <li><a href="#">View calendar</a></li>
                            </ul>
                        </div>
                        <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i
                                    class="fa fa-times"></i>
                        </button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <!--The calendar -->
                    <div id="calendar" style="width: 100%"></div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-black">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- Progress bars -->
                            <div class="clearfix">
                                <span class="pull-left">Task #1</span>
                                <small class="pull-right">90%</small>
                            </div>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                            </div>

                            <div class="clearfix">
                                <span class="pull-left">Task #2</span>
                                <small class="pull-right">70%</small>
                            </div>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <div class="clearfix">
                                <span class="pull-left">Task #3</span>
                                <small class="pull-right">60%</small>
                            </div>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                            </div>

                            <div class="clearfix">
                                <span class="pull-left">Task #4</span>
                                <small class="pull-right">40%</small>
                            </div>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.box -->

        </section>
        <!-- right col -->
    </div>
    <!-- /.row (main row) -->
    <div class="dashboard_modal_add_widget">
        <div class="modal_add_widget">
            <div class="connectedSortable">
                <div>
                    <div class="box-header" style="background-color: red;">
                        <ul>
                            <li>1</li>
                            <li>2</li>
                            <li>4</li>

                        </ul>
                    </div>
                </div>
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
    {!! Html::script("public/admin_theme/dist/js/pages/dashboard.js")!!}

    <!-- Include the ViewSelector2 component script. -->



    <script>
        $('body').on('click', '.open_dashboard_widget', function () {
            $('.dashboard_modal_add_widget').toggleClass('active')
        })

        {{--widget btn--}}
        $('.btn-for-widget').on('click', function () {
            $(this).find('i').toggleClass('fa-plus fa-minus');
        })
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
        gapi.analytics.ready(function () {
            console.log(gapi);
            /**
             * Authorize the user immediately if the user has already granted access.
             * If no access has been created, render an authorize button inside the
             * element with the ID "embed-api-auth-container".
             */
//            gapi.analytics.auth.authorize({
//                serverAuth: {
//                    access_token:'ya29.GluuBn8n-XNRJimEWv1Wlarl3Q2Fj7hnJotqnrXeKSVkFXA_hgB3TVHou_ltLAGrGreCvlr1fwujXfs-TVJUWb0GP1_lRcqV-3rqV6zK1Lt7ndwfmkjOWJLlquuE'
//                }
//            });
  gapi.analytics.auth.authorize({
                container: 'embed-api-auth-container',
                clientid: '{!! env('GOOGLE_CLIENT_ID') !!}'
            });
            var commonConfig = {
                query: {
                    metrics: 'ga:sessions',
                    dimensions: 'ga:date'
                },
                chart: {
                    type: 'LINE',
                    options: {
                        width: '100%'
                    }
                }
            };


            /**
             * Query params representing the first chart's date range.
             */
            var dateRange1 = {
                'start-date': '14daysAgo',
                'end-date': 'today',
                'metrics': 'ga:visitors'
            };


            /**
             * Query params representing the second chart's date range.
             */
            var dateRange2 = {
                'start-date': '7daysAgo',
                'end-date': 'today'
            };
            var dateRange3 = {
                'ids': 'ga:ranges', // <-- Replace with the ids value for your view.
                'start-date': '30daysAgo',
                'end-date': 'yesterday',
                'metrics': 'ga:pageviews',
                'dimensions': 'ga:pagePathLevel1',
                'sort': '-ga:pageviews',
                'filters': 'ga:pagePathLevel1!=/',
                'max-results': '7',
            };
            var dateRange4 = {
                'ids': 'ga:{!! env('ANALYTICS_VIEW') !!}', // <-- Replace with the ids value for your view.
                'start-date': '30daysAgo',
                'end-date': 'today',
                'metrics': 'ga:sessions,ga:users',
                'dimensions': 'ga:date'
            };


            /**
             * Create a new ViewSelector2 instance to be rendered inside of an
             * element with the id "view-selector-container".
             */
            var viewSelector = new gapi.analytics.ext.ViewSelector2({
                container: 'view-selector-container',
            }).execute();


            /**
             * Create a new DateRangeSelector instance to be rendered inside of an
             * element with the id "date-range-selector-1-container", set its date range
             * and then render it to the page.
             */
            var dateRangeSelector1 = new gapi.analytics.ext.DateRangeSelector({
                container: 'date-range-selector-1-container'
            })
                .set(dateRange1)
                .execute();

            /**
             * Create a new DateRangeSelector instance to be rendered inside of an
             * element with the id "date-range-selector-2-container", set its date range
             * and then render it to the page.
             */
            var dateRangeSelector2 = new gapi.analytics.ext.DateRangeSelector({
                container: 'date-range-selector-2-container'
            })
                .set(dateRange2)
                .execute();
            var dateRangeSelector3 = new gapi.analytics.ext.DateRangeSelector({
                container: 'date-range-selector-3-container'
            })
                .set(dateRange3)
                .execute();
            var dateRangeSelector4 = new gapi.analytics.ext.DateRangeSelector({
                container: 'date-range-selector-4-container'
            })
                .set(dateRange4)
                .execute();


            /**
             * Create a new DataChart instance with the given query parameters
             * and Google chart options. It will be rendered inside an element
             * with the id "data-chart-1-container".
             */
            var dataChart1 = new gapi.analytics.googleCharts.DataChart(commonConfig)
                .set({query: dateRange1})
                .set({chart: {container: 'data-chart-1-container'}});


            /**
             * Create a new DataChart instance with the given query parameters
             * and Google chart options. It will be rendered inside an element
             * with the id "data-chart-2-container".
             */
            var dataChart2 = new gapi.analytics.googleCharts.DataChart(commonConfig)
                .set({query: dateRange2})
                .set({chart: {container: 'data-chart-2-container'}});

            var dataChart3 = new gapi.analytics.googleCharts.DataChart(commonConfig).set({
                chart: {
                    'container': 'data-chart-3-container',
                    'type': 'PIE',
                    'options': {
                        'width': '100%',
                        'pieHole': '4/9'
                    }
                }
            }).set({query: dateRange3});

            var dataChart4 = new gapi.analytics.googleCharts.DataChart(commonConfig).set({
                chart: {
                    'container': 'data-chart-4-container',
                    'type': 'LINE',
                    'options': {
                        'width': '100%'
                    }
                }
            }).set({query: dateRange4})


            /**
             * Register a handler to run whenever the user changes the view.
             * The handler will update both dataCharts as well as updating the title
             * of the dashboard.
             */
            viewSelector.on('viewChange', function (data) {
                dataChart1.set({query: {ids: data.ids}}).execute();
                dataChart2.set({query: {ids: data.ids}}).execute();
                dataChart3.set({query: {ids: data.ids}}).execute();
                dataChart4.set({query: {ids: data.ids}}).execute();
                var title = document.getElementById('view-name');
                title.innerHTML = data.property.name + ' (' + data.view.name + ')';
            });


            /**
             * Register a handler to run whenever the user changes the date range from
             * the first datepicker. The handler will update the first dataChart
             * instance as well as change the dashboard subtitle to reflect the range.
             */
            dateRangeSelector1.on('change', function (data) {
                dataChart1.set({query: data}).execute();

                // Update the "from" dates text.
                var datefield = document.getElementById('from-dates');
                datefield.innerHTML = data['start-date'] + '&mdash;' + data['end-date'];
            });


            /**
             * Register a handler to run whenever the user changes the date range from
             * the second datepicker. The handler will update the second dataChart
             * instance as well as change the dashboard subtitle to reflect the range.
             */
            dateRangeSelector2.on('change', function (data) {
                dataChart2.set({query: data}).execute();

                // Update the "to" dates text.
                var datefield = document.getElementById('to-dates');
                datefield.innerHTML = data['start-date'] + '&mdash;' + data['end-date'];
            });
            dateRangeSelector3.on('change', function (data) {
                dataChart3.set({query: data}).execute();

                // Update the "to" dates text.
                var datefield = document.getElementById('to-dates');
                datefield.innerHTML = data['start-date'] + '&mdash;' + data['end-date'];
            });
            dateRangeSelector4.on('change', function (data) {
                dataChart4.set({query: data}).execute();

                // Update the "to" dates text.
                var datefield = document.getElementById('to-dates');
                datefield.innerHTML = data['start-date'] + '&mdash;' + data['end-date'];
            });
        });

    </script>
@stop
