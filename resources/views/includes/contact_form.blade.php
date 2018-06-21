<section class="contact style-1 page-contact-form padding-top padding-bottom scroll-to">
    <div class="container">
        <div class="wrapper-contact-form">
            <div data-wow-delay="0.5s" class="contact-wrapper wow fadeInLeft">
                <div class="contact-box">
                    <h5 class="title">@lang('contact.contact_form')</h5>
                    <form class="contact-form" action="{{route('contact')}}" method="post">
                        {{csrf_field()}}
                        <input type="text" placeholder="@lang('contact.your_name')"
                               name="name"
                               value="{{old('name')}}"
                               class="form-control form-input {{ $errors->has('name') ? ' has-error' : '' }}"
                               required>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                                    <strong class="error">{{ $errors->first('name') }}</strong>
                                                </span>
                        @endif
                    <!--label.control-label.form-label.warning-label(for="") Warning for the above !-->
                        <input type="email" placeholder="@lang('contact.your_email')"
                               name="email"
                               value="{{old('email')}}"
                               class="form-control form-input {{ $errors->has('email') ? ' has-error' : '' }}"
                               required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                                    <strong class="error">{{ $errors->first('email') }}</strong>
                                                </span>
                        @endif
                    <!--label.control-label.form-label.warning-label(for="") Warning for the above !-->
                        <textarea placeholder="@lang('contact.your_message')"
                                  name="message"
                                  class="form-control form-input
                                          {{ $errors->has('message') ? ' has-error' : '' }}"
                                  required>{{old('message')}}</textarea>
                        @if ($errors->has('message'))
                            <span class="help-block">
                                                    <strong class="error">{{ $errors->first('message') }}</strong>
                                                </span>
                        @endif
                        <div class="{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">

                            {!! app('captcha')->display() !!}
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                                <strong class="error">
                                                    {{ $errors->first('g-recaptcha-response') }}
                                                </strong>
                                            </span>
                            @endif
                            @if(session('captcha_errors'))
                                <span class="help-block">
                                                <strong class="error"> {{ session('captcha_errors')}}</strong>
                                            </span>
                            @endif
                        </div>
                        <div class="contact-submit">
                            <button type="submit" data-hover="@lang('contact.send_now')" class="btn btn-slide">
                                <span class="text">@lang('contact.send_message')</span>
                                <span class="icons fa fa-long-arrow-right"></span></button>
                        </div>
                    </form>
                </div>
            </div>
            <div data-wow-delay="0.5s" class="wrapper-form-images wow fadeInRight"><img
                        src="{{asset('storage/'.setting('site.contact_image'))}}" alt=""
                        class="img-responsive"></div>
        </div>
    </div>
</section>