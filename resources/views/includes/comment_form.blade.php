<form id="comment-form" class="contact-form"
      action="{{route('save_comment', ['tour_slug' => (isset($tour->slug)?$tour->slug:'')])}}"
      method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" name="tour_id" value="{{isset($tour->id)?$tour->id:0}}">
    <input type="text"
           placeholder="@lang('review.your_name') *"
           name="user_name"
           class="form-control form-input {{ $errors->has('user_name') ? ' has-error' : '' }}"
           value="{{old('user_name')}}" required>
    @if ($errors->has('user_name'))
        <span class="help-block">
            <strong class="error">{{ $errors->first('user_name') }}</strong>
        </span>
    @endif
    <input type="email" placeholder="@lang('review.your_email') *"
           name="user_email"
           class="form-control form-input {{ $errors->has('user_email') ? ' has-error' : '' }}"
           value="{{old('user_email')}}">
    @if ($errors->has('user_email'))
        <span class="help-block">
            <strong class="error">{{ $errors->first('user_email') }}</strong>
        </span>
    @endif
    <input type="text" placeholder="@lang('review.country')"
           name="user_country"
           class="form-control form-input {{ $errors->has('user_country') ? ' has-error' : '' }}"
           value="{{old('user_country')}}">
    @if ($errors->has('user_country'))
        <span class="help-block">
            <strong class="error">{{ $errors->first('user_country') }}</strong>
        </span>
    @endif
    <textarea placeholder="@lang('review.your_message') *"
              name="text"
              class="form-control form-input
                                                        {{ $errors->has('message') ? ' has-error' : '' }}"
              required>{{old('text')}}</textarea>
    @if ($errors->has('text'))
        <span class="help-block">
            <strong class="error">{{ $errors->first('text') }}</strong>
        </span>
    @endif

    <div class="margin-bottom70 {{ $errors->has('images.*') ? ' has-error' : '' }}">
        <label class="btn btn-default btn-file">
            @lang('review.choose_images')
            <input type="file" name="images[]" class="display_none"
                   multiple>
        </label>
        @if ($errors->has('images.*'))
            <span class="help-block">
                <strong class="error">{{ $errors->first('images.*') }}</strong>
            </span>
        @endif
    </div>
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
    <button type="submit" data-hover="@lang('review.send_now')" class="btn btn-slide">
        <span class="text">
        @lang('review.send_message')
        </span>
        <span class="icons fa fa-long-arrow-right"></span>
    </button>
</form>