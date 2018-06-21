<div role="tabpanel" id="apartments" class="tab-pane fade">
    <div class="find-widget find-tours-widget widget">
        <h4 class="title-widgets">FIND TOURS</h4>
        <form action="{{route('apartments')}}" class="content-widget">
            <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text"
                           class="form-control input-lg"
                           name="apartment"
                           placeholder="find your excursion"/>
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg search-button"
                                type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </form>
    </div>
</div>