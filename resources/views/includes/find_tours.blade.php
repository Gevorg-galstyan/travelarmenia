<div role="tabpanel" id="tours" class="tab-pane fade in active">
    <div class="find-widget find-flight-widget widget">
        <h4 class="title-widgets">FIND YOUR FLIGHT</h4>
        <form action="{{route('tours',$countries->first()->slug)}}" class="content-widget find-tour" method="get" data-status="tours">
            <div class="ffw-radio-selection">
                <span class="ffw-radio-btn-wrapper">
                    <input type="radio"
                           name="i_g"
                           value="individual"
                           id="flight-type-1"
                           checked="checked"
                           class="ffw-radio-btn">
                    <label for="flight-type-1"
                           class="ffw-radio-label">
                       Individual
                    </label>
                </span>
                <span class="ffw-radio-btn-wrapper">
                    <input type="radio"
                           name="i_g"
                           value="groups"
                           id="flight-type-2"
                           class="ffw-radio-btn">
                    <label
                            for="flight-type-2"
                            class="ffw-radio-label">
                        Groups
                    </label>
                </span>
                <div
                        class="stretch">&nbsp;
                </div>
            </div>
            <div class="text-input small-margin-top">
                <div class="place text-box-wrapper">
                    <label class="tb-label"> Country </label>
                    <div class="select-wrapper">
                        <!--i.fa.fa-chevron-down-->
                        <select class="form-control custom-select country" data-target="tours">
                            @foreach($countries as $i => $country)
                                <option value="{{$country->slug}}">
                                    {{$country->translate()->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="place  text-box-wrapper">
                    <label class="tb-label"> Type </label>

                    <div class="select-wrapper">
                        <!--i.fa.fa-chevron-down-->
                        <select name="type" class="form-control custom-select">
                            <option value="">Choose Type ...</option>
                            @foreach($catTypes as $catType)
                                <option value="{{$catType->link}}">
                                    {{$catType->translate(session('locale'))->name}}
                                </option>
                            @endforeach
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