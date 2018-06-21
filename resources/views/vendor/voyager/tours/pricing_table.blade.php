<table class="table table-responsive table-bordered">
    <thead>
    <tr>
        <th>Hotel Name</th>
        @for($i = 1; $i <= $column; $i++)
            <th data-status="count_{{$i}}">
                <button type="button"
                        class=" btn-danger pull-right delete-pricing"
                        data-target="count_{{$i}}">
                    <i class="fas fa-times"></i>
                </button>
                <input type="text"
                       class="form-control"
                       name="column[{{$i}}]"
                       placeholder="Enter Count Man">
                <input type="hidden" value="{{$i}}" name="test_column[{{$i}}]">
            </th>
        @endfor
    </tr>
    </thead>
    <tbody>
    @for($j = 0; $j < $row; $j++)
        <tr>
            <td data-change="{{$j}}">
                <div class="col-md-3">
                    <button type="button" class="btn btn-default change-hotel-name" data-target="{{$j}}">
                        <i class="fas fa-exchange-alt"></i>
                    </button>
                </div>
                <div class="col-md-9">
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="hotel_name_ru[{{$j}}]" placeholder="Ru Name" style="display: none" disabled>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="hotel_name_en[{{$j}}]" placeholder="En Name" style="display: none" disabled>
                    </div>
                    <input type="hidden" value="{{$j}}" name="row[{{$j}}]">
                    <select class="form-control flag" name="hotel_id[{{$j}}]">
                        <option value="">Select Hotel</option>
                        @foreach($hotels as $hotel)
                            @if (($hotel->city->count() && $hotel->city->capital == 1)))
                            <option value="{{$hotel->id}}">{{$hotel->translate()->name}}</option>
                            @else
                                @continue
                            @endif
                        @endforeach
                    </select>
                </div>

            </td>
            @for($i = 1; $i <= $column; $i++)
                <td data-status="count_{{$i}}">
                    <input type="text"
                           class="form-control"
                           placeholder="Enter Price" name="individual_price[{{$j}}][{{$i}}]">
                </td>
            @endfor
            <td>
                <button type="button" class="btn-danger delete-row"
                        data-td="row_{{$j}}">
                    <i class="fas fa-times"></i>
                </button>
            </td>
        </tr>
    @endfor
    </tbody>
</table>