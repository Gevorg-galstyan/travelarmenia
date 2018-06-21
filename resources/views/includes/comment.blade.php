<li class="media parent">
    <div class="comment-item ">
        <div class="media">
            <div class="pull-left">
                @if($comment->user_name)
                    <div class="author">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        {{$comment->user_name}}
                    </div>
                @endif
                @if($comment->user_country)
                    <div class="author">
                        <i class="fa fa-globe" aria-hidden="true"></i>
                        {{$comment->user_country}}
                    </div>
                @endif
            </div>
            <div class="pull-right time"><i
                        class="fa fa-clock-o"> </i>
                <span>{{$comment->created_at->diffForHumans()}}</span>
            </div>
            <div class="clearfix"></div>
            <div class="des">
                {{$comment->text}}
            </div>
            @if($comment->images)
                @php($images = json_decode($comment->images, true))
                @foreach(array_chunk($images,6) as $chunk)
                    <div class="col-sm-12 margin-bottom">
                        @foreach($chunk as $image)
                            <div class="col-lg-2">
                                <div class="hovereffect">
                                    <img class="img-responsive"
                                         src="{{Voyager::image(str_replace('.jpg','-tumb.jpg', $image))}}"
                                         alt="" width="250px"
                                         height="100%">
                                    <a href="{{Voyager::image($image)}}"
                                       data-fancybox-group="comment_{{$i}}"
                                       class="wp-gallery  fancybox thumb">
                                        <div class="overlay">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</li>
<hr>