<div class="special-offer margin-top70">
    <h3 class="title-style-2">special offer</h3>
    <div class="special-offer-list">
        @foreach($similarHotels as $similarHotel)
            <div class="special-offer-layout" title="{{$similarHotel->translate()->name}}">
                <div class="image-wrapper">
                    <a href="{{route('hotel',['id' => $similarHotel->slug])}}" class="link">
                        <img src="{{asset(Voyager::image($similarHotel->thumbnail('tumb')))}}"
                             alt="{{$similarHotel->translate()->name}}"
                             title="{{$similarHotel->translate()->name}}"
                                class="img-responsive">
                    </a>
                    <div class="title-wrapper">
                        <a href="{{route('hotel',['id' => $similarHotel->slug])}}" class="title">
                            {{$similarHotel->translate()->name}}
                        </a>
                        <i class="icons flaticon-circle"></i></div>
                </div>
            </div>
        @endforeach
    </div>
</div>