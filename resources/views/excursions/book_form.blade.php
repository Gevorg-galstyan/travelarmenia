
        <div class="find-widget find-hotel-widget widget new-style">
            <h4 class="title-widgets"> @lang('book_form.BOOK ROOM')</h4>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-12 text-center">
                        <div class="col-md-2 col-md-offset-8">
                            @include('includes.change_currency')
                        </div>
                    </div>
                    <div>
                        <div>
                            per person:
                            <span class="excursion-book-per-person" data-name="price" >
                                <input type="hidden" data-name="origin_price"
                                       value="{{$excursion->price}}">
                                <span>
                                    {{round(($excursion->price) / (session('valuta_val') ? session('valuta_val') : 1))}}
                                </span>
                            </span>
                            <sup class="unit valuta_sinvol">{!! session('valuta_sinvol') !!}</sup>
                        </div>
                        <div>
                            @lang('book_form.Total') :
                           <span class="excursion-book-total" data-name="price">
                                <input type="hidden" data-name="origin_price"
                                       value="{{$excursion->price}}">
                                <span>
                                      {{round(($excursion->price) / (session('valuta_val') ? session('valuta_val') : 1))}}
                                </span>
                            </span>
                            <sup class="unit valuta_sinvol">{!! session('valuta_sinvol') !!}</sup>
                        </div>

                        <div class="msg-container">

                        </div>

                    </div>
                </div>
            </div>
            {{--<div class="row">--}}
            {{--<p class="text-center" id="server_error"></p>--}}
            {{--</div>--}}
            <form class="content-widget book-excursion" action="{{route('excursion_book',$excursion->slug)}}" method="post">
                {{csrf_field()}}
                <div class="text-input small-margin-top">
                    <div class="input-daterange">
                        <div class="text-box-wrapper half" >
                            <label class="tb-label" id="check_in">@lang('book_form.Check in')</label>
                            <div class="input-group">
                                <input type="text"
                                       placeholder="@lang('book_form.YY/MM/DD')"
                                       name="check_in"
                                       value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                                       class="tb-input book_data" required>
                                <i class="tb-icon fa fa-calendar input-group-addon"></i>
                            </div>
                        </div>
                        <div class="text-box-wrapper half" >
                            <label class="tb-label" id="check_out">@lang('book_form.Check out')</label>
                            <div class="input-group">
                                <input type="text"
                                       placeholder="@lang('book_form.YY/MM/DD')"
                                       name="check_out"
                                       value="{{\Carbon\Carbon::now()->addDay(1)->format('Y-m-d')}}"
                                       class="tb-input book_data" required>
                                <i class="tb-icon fa fa-calendar input-group-addon"></i>
                            </div>
                        </div>
                    </div>

                    <div class="first-name text-box-wrapper" >
                        <label class="tb-label" id="first_name">@lang('book_form.Your First Name')</label>
                        <div class="input-group">
                            <input type="text"
                                   placeholder="@lang('book_form.Your First Name')"
                                   name="first_name"
                                   class="tb-input" required>
                        </div>
                    </div>
                    <div class="last-name text-box-wrapper" >
                        <label class="tb-label" id="last_name">@lang('book_form.Your Last Name')</label>
                        <div class="input-group">
                            <input type="text"
                                   name="last_name"
                                   placeholder="@lang('book_form.Your Last Name')"
                                   class="tb-input" required>
                        </div>
                    </div>
                    <div class="email text-box-wrapper" >
                        <label class="tb-label" id="email">@lang('book_form.Your Email')</label>
                        <div class="input-group">
                            <input type="email"
                                   placeholder="@lang('book_form.Your Email')"
                                   name="email"
                                   class="tb-input" required>
                        </div>
                    </div>
                    <div class="phone text-box-wrapper" >
                        <label class="tb-label" id="phone">@lang('book_form.Your Number Phone')</label>
                        <div class="input-group">
                            <input type="text"
                                   placeholder="@lang('book_form.Your Number Phone')"
                                   name="phone"
                                   class="tb-input">
                        </div>
                    </div>


                    <div class="count adult-count text-box-wrapper">
                        <label class="tb-label" id="adult">@lang('book_form.Adult')</label>
                        <div class="select-wrapper">
                            <!--i.fa.fa-chevron-down-->
                            <select name="adult"
                                    class="form-control custom-select adult change-total"
                                    required>
                                @for($i = 1; $i <= 15; $i++)
                                    <option value="{{$i}}">
                                        {{$i}}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="count child-count text-box-wrapper" >
                        <label class="tb-label" id="child">@lang('book_form.Child')</label>
                        <div class="select-wrapper">
                            <!--i.fa.fa-chevron-down-->
                            <select name="child"
                                    class="form-control custom-select child">
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

                    <div class="note text-box-wrapper" >
                        <label class="tb-label" id="content">@lang('book_form.Note'):</label>
                        <div class="input-group" >
                            <textarea placeholder="@lang('book_form.Write your note')"
                                      rows="3" name="message"
                                      class="tb-input"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="checkbox" >
                            <label id="conditions">
                                <input type="checkbox" name="conditions"  class="btn-lg" required>
                                @lang('book_form.Yes, I agree with the terms') *
                            </label>
                            <div class="">
                                <div class="" id="conditions"></div>
                            </div>
                            <button  type="button" data-toggle="modal" data-target="#customer_conditions" href=""
                                     class="btn">
                                @lang('book_form.Conditions')
                            </button>
                        </div>
                        <div class="{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                            <div>
                                <label id="g-recaptcha-response" class="pull-left"></label>
                                {!! app('captcha')->display() !!}
                                {!! app('captcha')->renderJs(app()->getLocale()) !!}
                            </div>
                        </div>
                        <button type="submit" data-hover="@lang('book_form.SEND REQUEST')"
                                class="btn btn-slide">
                            <span class="text">@lang('book_form.BOOK NOW')</span>
                            <span class="icons fa fa-long-arrow-right"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <script>
            change_total_url = "{{route('get_excursion_book_total',$excursion->slug)}}"
        </script>