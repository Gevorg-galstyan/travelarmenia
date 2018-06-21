@php
    $price = 0;
    $roomPrice = $room->price;
@endphp


@php
    $price = $room->seasons->whereIn('seasion_id', $seasons)->first();
    if ($price->count() > 0){
    $price = $price->price;
    }else{
    $price = 0;
    }
@endphp

@php
    if ($price <= 0){
        if ($roomPrice > 0){
            $price = $roomPrice;

        }
    }

@endphp
@if($price > 0)
    <div class="title">
        <div class="price"><sup>$</sup><span
                    class="number">{{$price}}</span></div>
        <p class="for-price">for person per night</p>
    </div>
@else

@endif


