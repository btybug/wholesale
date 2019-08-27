@extends('layouts.frontend')
@section('content')
   <main class="main-content">
       <section class="support__pages-wrapper ">
           <div class="container main-max-width">
               <div class="row">
                   <div class="col-md-3">
                       <ul class="left-wrapper">
                           @if(LaravelGmail::check())
                               <li class="item-wrap">
                                   <a href="{!! route('support_contact_us') !!}"
                                      class="d-flex align-items-center item-link">
                                       <span class="line"></span>
                                       <div class="item-photo">
                                           <img src="/public/img/message-icon.png" alt="contact">
                                       </div>
                                       <div class="item-name font-20">Contact Us</div>
                                   </a>
                               </li>
                           @endif
                           <li class="item-wrap">
                               <a href="{!! route('delivery') !!}" class="d-flex align-items-center item-link">
                                   <div class="item-photo">
                                       <img src="/public/img/delivery-icon.png" alt="Delivery">
                                   </div>
                                   <div class="item-name font-20">Delivery</div>
                               </a>
                           </li>
                           <li class="item-wrap">
                               <a href="{!! route('terms_conditions') !!}"
                                  class="d-flex align-items-center item-link active">
                                   <div class="item-photo">
                                       <img src="/public/img/paper-icon.png" alt="Terms Conditions">
                                   </div>
                                   <div class="item-name font-20">Terms & Conditions</div>
                               </a>
                           </li>

                           <li class="item-wrap">
                               <a href="{!! route('faq_page') !!}" class="d-flex align-items-center item-link">
                                   <div class="item-photo">
                                       <img src="/public/img/faq-icon.png" alt="FAQ">
                                   </div>
                                   <div class="item-name font-20">FAQ</div>
                               </a>
                           </li>
                       </ul>
                   </div>
                   <div class="col-md-9">
                       <h3>Terms and Conditions</h3>
                       <div>
                           {!! @$model->description !!}
                       </div>
                   </div>
               </div>
           </div>
       </section>

   </main>
@stop
