<div role="tabpanel" id="hotel" class="tab-pane fade">
    <div class="find-widget find-hotel-widget widget">
        <h4 class="title-widgets">FIND HOTEL</h4>
        <form action="{{route('hotels', $countries->first()->slug)}}" class="content-widget" data-status="hotels">
            <div class="text-input small-margin-top">
                <div class="place text-box-wrapper">
                    <label class="tb-label"> Country </label>
                    <div class="select-wrapper">
                        <!--i.fa.fa-chevron-down-->
                        <select class="form-control custom-select hotel-country country" data-target="hotels">
                            @foreach($countries->where('id', '!=', 4) as $i => $country)
                                <option value="{{$country->slug}}">
                                    {{$country->translate()->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="place text-box-wrapper">
                    <label class="tb-label"> City </label>
                    <div class="select-wrapper">
                        <!--i.fa.fa-chevron-down-->
                        <select class="form-control custom-select hotel-city" name="city">
                            <option>Choose city ...</option>
                            @foreach($countries->where('id', '!=', 4) as $i => $country)
                                @foreach($country->cities as $city)
                                    <option value="{{$city->slug}}" class="city-{{$country->slug}}"
                                            style="{{$i != 0 ? 'display:none;': ''}}">
                                        {{$city->translate()->name}}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="count child-count text-box-wrapper"><label
                            class="tb-label">Child</label>
                    <div class="select-wrapper">
                        <!--i.fa.fa-chevron-down-->
                        <select name="type" class="form-control custom-select">
                            <option value="hotel">Hotel</option>
                            <option value="hostel">Hostel</option>
                            <option value="resort">Resort</option>
                            <option value="villa">Villa</option>
                            <option value="motel">Motel</option>
                            <option value="bungalow">Bungalow</option>
                        </select>
                    </div>
                </div>
                <button type="submit" data-hover="SEARCH NOW"
                        class="btn btn-slide"><span
                            class="text">SEARCH NOW</span><span
                            class="icons fa fa-long-arrow-right"></span>
                </button>
            </div>
        </form>
    </div>
</div>