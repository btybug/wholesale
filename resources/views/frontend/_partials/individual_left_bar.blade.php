{{--<div class="nav flex-column justify-content-center nav-pills" aria-orientation="vertical">--}}
    {{--<a href="{!! route('blog') !!}" class="nav-link {{ ($type == 'active') ? 'active' : '' }} d-flex flex-column align-items-center">--}}
        {{--<span class="name">News</span></a>--}}
    {{--<a href="#" class="nav-link {{ ($type == 'active') ? 'forums' : '' }} d-flex flex-column align-items-center">--}}
        {{--<span class="name">Forums</span>--}}
    {{--</a>--}}
    {{--<a href="#" class="nav-link {{ ($type == 'active') ? 'socials' : '' }} d-flex flex-column align-items-center">--}}
        {{--<span class="name">Socials</span>--}}
    {{--</a>--}}
{{--</div>--}}




<div class="category-select news-page-select-wall">
    <select class="select-2 select-2--no-search main-select main-select-2arrows products-filter-wrap_select not-selected arrow-dark" style="width: 100%">
        <option class="selected">{!! __('news') !!}</option>
        <option>News 1</option>
        <option>News 2</option>
    </select>
</div>
