@extends('layouts.frontend')
@section('content')
    <main class="main-content position-relative">
        <div class="d-flex">
            {{--acoount sidebar--}}
            <div class="profile-sidebar profile-sidebar--inner-pages d-flex flex-column align-items-center">
                @include('frontend.my_account._partials.left_bar')
                <div class="mt-auto">
                    {!! Form::open(['url'=>route('logout')]) !!}
                    <div class="text-center">
                        <button type="submit"
                                class="profile-sidebar_logout-btn d-inline-flex align-items-center justify-content-center font-14 text-uppercase text-white pointer">
                            {!! __('logout') !!}
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
            <div class="profile-inner-pg-right-cnt">
                <div class="profile-inner-pg-right-cnt_inner h-100">
                    <div class="row flex-lg-row flex-column-reverse">
                        <div class="col-lg-9">
                            <div class="account--order-review-wrap">
                                <ul class="nav nav-tabs mb-3" id="myTabReview" role="tablist">
                                    @foreach($items as $item)
                                    <li class="nav-item">
                                        <a class="nav-link @if($loop->first) active @endif" id="reviewItem{{$item->id}}-tab" data-toggle="tab" href="#reviewItem{{ $item->id }}"
                                           role="tab" aria-controls="reviewItem{{ $item->id }}" aria-selected="true">{!! $item->name !!}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    @foreach($items as $item)
                                        <div class="tab-pane fade @if($loop->first) show active @endif" id="reviewItem{{$item->id}}" role="tabpanel" aria-labelledby="reviewItem{{$item->id}}-tab">
                                            @php
                                            $model = $order->reviews()->where('item_id',$item->id)->first();
                                            @endphp
                                            @if($model && $model->status == \App\Enums\ReviewStatusTypes::PUBLISHED)
                                                <section class="reviews__card-wrapper">
                                                    <blockquote class="rating__card__quote">“{!! $model->review !!}”</blockquote>

                                                    <div class="rating__card__stars">
                                                        <span class="fa fa-star {{ ($model->rate >= \App\Enums\ReviewStatusTypes::STAR1 )?'checked':'' }}"></span>
                                                        <span class="fa fa-star {{ ($model->rate >= \App\Enums\ReviewStatusTypes::STAR2 )?'checked':'' }}"></span>
                                                        <span class="fa fa-star {{ ($model->rate >= \App\Enums\ReviewStatusTypes::STAR3 )?'checked':'' }}"></span>
                                                        <span class="fa fa-star {{ ($model->rate >= \App\Enums\ReviewStatusTypes::STAR4 )?'checked':'' }}"></span>
                                                        <span class="fa fa-star {{ ($model->rate >= \App\Enums\ReviewStatusTypes::STAR5 )?'checked':'' }}"></span>
                                                    </div>
                                                    <p class="rating__card__bottomText">by {!! $model->nickname !!} on {!! BBgetDateFormat($model->created_at) !!}</p>
                                                </section>
                                            @else
                                                {!! Form::model($model,['class' => 'form-horizontal']) !!}
                                                {!! Form::hidden('item_id',$item->id) !!}
                                                {!! Form::hidden('id',null) !!}
                                                <div class="account--order-review-first-tab">
                                                    @if($model && ($model->status == \App\Enums\ReviewStatusTypes::SUBMITTED
                                                    || $model->status == \App\Enums\ReviewStatusTypes::RESUBMITTED || $model->status == \App\Enums\ReviewStatusTypes::BLOCKED))
                                                    <fieldset disabled="disabled">
                                                    @endif
                                                        <h1 class="text-uppercase title font-18 text-gray-clr font-main-bold">You're reviewing:{{ $item->name }}</h1>
                                                        <p class="font-14">How do you rate this product?<span class="text-danger">*</span></p>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-striped">
                                                                <thead>
                                                                <tr>
                                                                    <th class="text-uppercase"></th>
                                                                    <th class="text-uppercase text-center">1 star</th>
                                                                    <th class="text-uppercase text-center">2 stars</th>
                                                                    <th class="text-uppercase text-center">3 stars</th>
                                                                    <th class="text-uppercase text-center">4 stars</th>
                                                                    <th class="text-uppercase text-center">5 stars</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>Overall Rating</td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            {!! Form::radio('rate',1) !!}
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            {!! Form::radio('rate',2) !!}
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            {!! Form::radio('rate',3) !!}
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            {!! Form::radio('rate',4) !!}
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-center">
                                                                            {!! Form::radio('rate',5) !!}
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nicknameField">Nickname <span class="text-danger">*</span></label>
                                                            {!! Form::text('nickname',null,['class' => 'form-control']) !!}
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="summaryField">Summary <span class="text-danger">*</span></label>
                                                            {!! Form::text('summary',null,['class' => 'form-control']) !!}
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Review <span class="text-danger">*</span></label>
                                                            {!! Form::textarea('review',null,['class' => 'form-control','cols' => 30,'rows'=> 10]) !!}
                                                        </div>

                                                        <button class="btn btn-primary float-right">
                                                            Submit
                                                        </button>

                                                    @if($model)
                                                        @if($model->status == \App\Enums\ReviewStatusTypes::SUBMITTED ||
                                                        $model->status == \App\Enums\ReviewStatusTypes::RESUBMITTED)
                                                        <span>Your Review under administration review ...</span>
                                                        @endif
                                                        </fieldset>
                                                    @endif
                                                </div>
                                                {!! Form::close() !!}
                                            @endif
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--@include('frontend.my_account._partials.verify_bar.blade_old.php')--}}


    </main>
@stop
