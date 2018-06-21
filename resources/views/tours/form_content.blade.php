<div class="text-input small-margin-top">
    <div class="first-name text-box-wrapper">
        <label class="tb-label"> @lang('book_form.Your First Name') *</label>
        <div class="input-group " id="first_name">
            <input name="first_name" type="text" placeholder="@lang('book_form.Your First Name')"
                   class="tb-input" value="" required>
        </div>
    </div>
    <div class="last-name text-box-wrapper">
        <label class="tb-label">@lang('book_form.Your Last Name') *</label>
        <div class="input-group" id="last_name">
            <input name="last_name" type="text" placeholder="@lang('book_form.Your Last Name')"
                   class="tb-input" required>
        </div>
    </div>
    <div class="email text-box-wrapper">
        <label class="tb-label">@lang('book_form.Your Email') *</label>
        <div class="input-group" id="email">
            <input type="email" name="email" placeholder="@lang('book_form.Your Email')"
                   class="tb-input" value="{{isset($data['email']) ? $data['email'] : ''}}" required>
        </div>
    </div>
    <div class="phone text-box-wrapper">
        <label class="tb-label">@lang('book_form.Your Number Phone') *</label>
        <div class="input-group" id="phone">
            <input type="text" name="phone"
                   placeholder="@lang('book_form.Your Number Phone')"
                   class="tb-input" value="" required>
        </div>
    </div>
    <div class="input-daterange">
        <div class="text-box-wrapper half">
            <label class="tb-label">
                @lang('book_form.Check in')
            </label>
            <div class="input-group">
                <input type="text" name="check_in" placeholder="@lang('book_form.YY/MM/DD')" class="tb-input"
                       value="" autocomplete>
                <i class="tb-icon fa fa-calendar input-group-addon"></i>
            </div>
        </div>
        <div class="text-box-wrapper half">
            <label class="tb-label">
                @lang('book_form.Check out')
            </label>
            <div class="input-group">
                <input type="text" name="check_out" placeholder="@lang('book_form.YY/MM/DD')" class="tb-input"
                       value="">
                <i class="tb-icon fa fa-calendar input-group-addon"></i>
            </div>
        </div>
    </div>
    <div class="count adult-count text-box-wrapper">
        <label class="tb-label">
            @lang('book_form.Adult')
        </label>
        <div class="select-wrapper" id="adult">
            <!--i.fa.fa-chevron-down-->
            <select name="adult" class="form-control custom-select adult total-send">
                @for($i = 1; $i <= 15; $i++)
                    <option value="{{$i}}">
                        {{$i}}
                    </option>
                @endfor
            </select>
        </div>
    </div>
    <div class="count child-count text-box-wrapper">
        <label class="tb-label">
            @lang('book_form.Child')
        </label>
        <div class="select-wrapper" id="child">
            <!--i.fa.fa-chevron-down-->
            <select name="child" class="form-control custom-select child">
                @for($i = 0; $i <= 15; $i++)
                    <option value="{{$i}}">
                        {{$i}}
                    </option>
                @endfor
            </select>
        </div>
    </div>
    <div class="child-content text-box-wrapper display_none">
        <p>@lang('book_form.Ages of children at check-out')</p>
        <div class="child-age">

        </div>
    </div>
    <div class="place text-box-wrapper">
        <label class="tb-label">@lang('book_form.if you have a promotional code, enter')</label>
        <div class="input-group">
            <input type="text" name="promo_code"
                   value=""
                   placeholder="@lang('book_form.Promo Kod')"
                   class="tb-input promo_code">
        </div>
    </div>
    <div class="note text-box-wrapper">
        <label class="tb-label">@lang('book_form.Note'):</label>
        <div class="input-group">
                        <textarea placeholder="@lang('book_form.Write your note')"
                                  rows="3"
                                  name="message" class="tb-input"></textarea>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-12">
            <div>
                @if($price)
                    <h4>Total :
                        <span class="number price" data-name="price">
                            <input type="hidden" data-name="origin_price"
                                   value="{{$price}}">
                            <span>
                                {{round($price / (session('valuta_val')
                ? session('valuta_val') : 1))}}
                            </span>

                            <sup class="unit valuta_sinvol">{!! session('valuta_sinvol') !!}</sup>
                        </span>
                    </h4>

                @endif
            </div>
        </div>
        <div class="checkbox pull-right">
            <label>
                <input type="checkbox" name="conditions" class="btn-lg" required>
                @lang('book_form.Yes, I agree with the terms') *
            </label>
            <div class="">
                <div class="" id="conditions"></div>
            </div>
            <button type="button" data-toggle="modal" data-target="#customer_conditions" href="" class="btn">
                @lang('book_form.Conditions')
            </button>
        </div>
        <div class="">

            {!! app('captcha')->display() !!}
        </div>
        <button type="submit" name="submit" data-hover="@lang('book_form.SEND REQUEST')"
                class="btn btn-slide">
            <span class="text">@lang('book_form.BOOK NOW')</span>
            <span class="icons fa fa-long-arrow-right"></span>
        </button>
    </div>
</div>
{!! app('captcha')->renderJs(session('locale')) !!}
