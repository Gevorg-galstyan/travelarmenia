<div class="subscribe-email">
    <div class="container">
        <div class="subscribe-email-wrapper">
            <div class="subscribe-email-left">
                <p class="subscribe-email-title">@lang('subscriber_footer.1') <span class="logo-text">{{config('app.name')}}</span>&nbsp;@lang('subscriber_footer.2')</p>
                <p class="subscribe-email-text">@lang('subscriber_footer.3')</p>
            </div>
            <div class="subscribe-email-right">
                <form action="{{route('subscriber')}}" method="post" class="subscriber-form">
                    {{csrf_field()}}
                    <div class="input-group form-subscribe-email" id="subscriber_email">
                        <input type="email" name="email" placeholder="@lang('subscriber_footer.Write your email')"
                               value="{{old('email')}}"
                               class="form-control {{ $errors->has('email') ? ' has-error' : '' }}" required/>


                        <span class="input-group-btn">
                                <button type="submit" class="btn-email">&#8594;</button>
                            </span>
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong class="error">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                </form>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>