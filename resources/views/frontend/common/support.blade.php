@extends('layouts.frontend')
@section('content')
   <main class="main-content">
       <div class="container">
           <section class="qcbox_section">
               <div class="product-introduce">
                   <h1 class="mb-5 text-uppercase text-my-yellow">Support</h1>
                   <div class="row">
                       <div class="col-sm-3">
                           <a href="{!! route('faq_page') !!}"
                              class="text-center mb-4 px-5 py-4 d-flex flex-column d-block shadow-sm bg-white">
                            <span class="d-inline-block mb-3"><i class="fa fa-5x fa-file-text"
                                                                 aria-hidden="true"></i></span>
                               <strong>FAQ</strong>
                               <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, sequi..</span>
                           </a>
                       </div>


                       <div class="col-sm-3">
                           <a href="{!! route('terms_conditions') !!}"
                              class="text-center mb-4 px-5 py-4 d-flex flex-column d-block shadow-sm bg-white">
                               <span class="d-inline-block mb-3"><i class="fa fa-5x fa-list" aria-hidden="true"></i></span>
                               <strong>Terms & conditions</strong>
                               <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, sequi..</span>
                           </a>
                       </div>

                       <div class="col-sm-3">
                           <a href="{!! route('delivery') !!}"
                              class="text-center mb-4 px-5 py-4 d-flex flex-column d-block shadow-sm bg-white">
                               <span class="d-inline-block mb-3"><i class="fa fa-5x fa-paper-plane" aria-hidden="true"></i></span>
                               <strong>Delivery</strong>
                               <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, sequi..</span>
                           </a>
                       </div>


                       @if(LaravelGmail::check())
                           <div class="col-sm-3">
                               <a href="{!! route('support_contact_us') !!}"
                                  class="text-center mb-4 px-5 py-4 d-flex flex-column d-block shadow-sm bg-white">
                                   <span class="d-inline-block mb-3"><i class="fas fa-5x fa-file-contract"></i></span>
                                   <strong>Contact us</strong>
                                   <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, sequi..</span>
                               </a>
                           </div>
                       @endif

                   </div>
               </div>
           </section>
       </div>
   </main>
@stop