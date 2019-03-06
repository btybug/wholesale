@foreach($category->faqs as $faq)
    <div class="card card-accordion"><a class="card-header collapsed" href="#"
                                        data-toggle="collapse"
                                        data-target="#collapseOne-{{ $faq->id }}-content"
                                        id="collapseOne-{{ $faq->id }}-header" aria-expanded="false"
                                        aria-controls="collapseOne-{{ $faq->id }}-content">
            {{ $faq->question }}</a>
        <div class="collapse" id="collapseOne-{{ $faq->id }}-content"
             aria-labelledby="collapseOne-{{ $faq->id }}-header" data-parent="#accordion-2" style="">
            <div class="card-body">{!! $faq->answer !!}
            </div>
        </div>
    </div>
@endforeach