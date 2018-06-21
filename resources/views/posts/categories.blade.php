@if($categories->count() > 0)
    <div class="categories-widget widget">
        <div class="title-widget">
            <div class="title">@lang('blog.categories')</div>
        </div>
        <div class="content-widget">
            <ul class="widget-list">
                @foreach($categories as $category)
                    <li class="single-widget-item">
                        <a href="{{route('blog',[$category->slug, $tag_active_slug??''])}}"
                           class="link {{isset($category_active_slug ) && $category_active_slug == $category->slug ? 'category-active' : ''}}">
                            <span class="fa-custom category">{{$category->translate()->name}}</span>
                            <span class="count">{{$category->posts->count()}}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif