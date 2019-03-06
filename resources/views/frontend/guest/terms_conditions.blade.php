@extends('layouts.frontend')
@section('content')
   <main class="main-content">
       <h3>Terms and Conditions</h3>
       <div>
           {!! @$model->description !!}
       </div>
   </main>
@stop