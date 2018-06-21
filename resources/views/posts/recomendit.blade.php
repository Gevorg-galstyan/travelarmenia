@if($recomendit_posts->count() > 0)
    <div class="recent-post-widget widget">
        <div class="title-widget">
            <div class="title">@lang('blog.recent_post')</div>
        </div>
        <div class="content-widget">


            <div class="recent-post-list">
                @foreach($recomendit_posts as $post)
                        <div class="single-widget-item">
                            <div class="single-recent-post-widget">
                                <a href="{{route('blog_detail',['slug'=> $post->slug])}}"
                                   class="thumb img-wrapper">
                                    <img src="{{asset(Voyager::image($post->thumbnail('popular')))}}"
                                         alt="{{$post->translate()->title}}"
                                         title="{{$post->translate()->title}}">
                                </a>
                                <div class="post-info">
                                    @php
                                        $date = explode(' ', $post->created_at);
                                        $date = explode('-', $date[0]);
                                        $dateObj   = DateTime::createFromFormat('!m', $date[1]);
                                        $carbon = new \Carbon\Carbon();
                                        $carbon->setLocale(config('app.locale'));
                                        $monthName = $carbon->parse($post->created_at)->format('F');
                                    @endphp
                                    <div class="meta-info">
                                        <span>
                                            {{$monthName.' '.$date[2].', '.$date[0] }}
                                        </span>
                                    </div>
                                    <div class="single-rp-preview">
                                        {{$post->translate()->title}}
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>


        </div>
    </div>
@endif