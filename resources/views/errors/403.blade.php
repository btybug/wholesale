@extends('layouts.frontend')

@section('content')
<main class="main-content">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3 col-12 p-3 error-main">
                <div class="row">
                    <div class="col-lg-8 col-12 col-sm-10 offset-lg-2 offset-sm-1">
                        <h1 class="m-0">403</h1>
                        <h6>Permission denied, please login</h6>
                        <p>Lorem ipsum dolor sit <span class="text-info">amet</span>, consectetur <span class="text-info">adipisicing</span> elit, sed do eiusmod.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('css')
    <style type="text/css">
        .error-main{
            background-color: #fff;
            box-shadow: 0px 10px 10px -10px #5D6572;
            margin-bottom: 10px;
        }
        .error-main h1{
            font-weight: bold;
            color: #444444;
            font-size: 100px;
            text-shadow: 2px 4px 5px #6E6E6E;
        }
        .error-main h6{
            color: #42494F;
        }
        .error-main p{
            color: #9897A0;
            font-size: 14px;
        }
    </style>
@stop
