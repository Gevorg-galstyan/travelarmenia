@if(isset($simple))
    <span class="content-tag">@lang('blog.tags')</span>
@else
    <div class="title-widget">
        <div class="title">@lang('blog.tags')</div>
    </div>
@endif
<div class="content-widget">
    @foreach($tags as  $tag)
        <a href="{{route('blog',
            [(isset($category_active_slug)?$category_active_slug:'all'), $tag->slug])}}"
           class="tag {{isset($tag_active_slug) && $tag_active_slug == $tag->slug ? 'category-active' : ''}}">{{$tag->translate()->name}}</a>
    @endforeach
</div>