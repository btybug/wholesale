@extends('layouts.frontend')
@section('content')
    <main class="page-main-content main-content">
        <div class="d-flex h-100">
    @include('frontend._partials.left_bar')
    <div class="main-right-wrapp">

    </div>
            @include('frontend.my_account._partials.verify_bar.blade_old.php')

        </div>
    </main>
@stop