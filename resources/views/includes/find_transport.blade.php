<div role="tabpanel" id="car-transport" class="tab-pane fade">
    <div class="find-widget find-car-widget widget">
        <h4 class="title-widgets">FIND CAR</h4>
        <form action="{{route('transports')}}" class="content-widget">
            <div class="text-input small-margin-top">
                <div class="text-box-wrapper half left">
                    <label class="tb-label"> Type </label>

                    <div class="select-wrapper">
                        <!--i.fa.fa-chevron-down-->
                        <select name="car_type" class="form-control custom-select">
                            <option value="">Choose Type ...</option>
                            @foreach($car_types as $car_type)
                                <option value="{{$car_type->id}}">
                                    {{$car_type->translate()->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="text-box-wrapper half right ">
                    <label class="tb-label"> Model </label>
                    <div class="select-wrapper">
                        <!--i.fa.fa-chevron-down-->
                        <select name="car_mark" class="form-control custom-select child">
                            <option value="">Choose Mark ...</option>
                            @foreach($car_models as $car_model)
                                <option value="{{$car_model->id}}">
                                    {{$car_model->translate()->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="text-box-wrapper">
                    <label class="tb-label">Car Model</label>
                    <div class="input-group">
                        <input type="text"
                               name="model"
                               placeholder="Car Model"
                               class="tb-input">
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