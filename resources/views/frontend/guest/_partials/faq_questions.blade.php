@foreach($category->faqs as $faq)
    <div class="card card-accordion faq-page-card-wrapper">
        <a href="{!! route('faq_page_single',$faq->slug) !!}" class="card-header d-flex flex-wrap justify-content-between">
            <span>{{ $faq->question }}</span>
            <span><i class="fas fa-long-arrow-alt-right"></i></span>
        </a>
{{--        <div class="collapse" id="collapseOne-{{ $faq->id }}-content"--}}
{{--             aria-labelledby="collapseOne-{{ $faq->id }}-header" data-parent="#accordion-2" style="">--}}
{{--            <div class="card-body">{!! $faq->answer !!}--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@endforeach
