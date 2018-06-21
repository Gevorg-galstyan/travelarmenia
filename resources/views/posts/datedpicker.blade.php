<div class="col-1">
    <div class="archives-widget widget">
        <div class="title-widget">
            <div class="title">@lang('blog.archives')</div>
        </div>
        <div class="content-widget">
            <div class="archive-datepicker" data-url="{{route('blog',[($category_active_slug??'all'), $tag_active_slug??''])}}"></div>
        </div>
    </div>
</div>