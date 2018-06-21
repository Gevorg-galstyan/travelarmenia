<ul class="list-group search-result text-left">
    @foreach($results as $result)
        <li class="list-group-item"><a href="{{route('apartment',$result->slug)}}">{{$result->translate()->title}}</a>
        </li>
    @endforeach
    @if(!$results->count())
        <li class="list-group-item">Not Result</li>
    @endif
</ul>
