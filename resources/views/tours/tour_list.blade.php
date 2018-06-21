@foreach($tours->chunk(2) as $chunk)
    <div class="row">
        @foreach($chunk as $tour)
            <div class="col-sm-6">
                @include('tours.tour_item')
            </div>
        @endforeach
    </div>
@endforeach

<nav class="pagination-list margin-top70">
    {{$tours->links()}}
</nav>