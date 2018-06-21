@if(isset($errors) && $errors)
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach

@endif
{{--@if(isset($captcha_errors) && $captcha_errors)--}}
    {{--captcha : {{$captcha_errors}}--}}
{{--@endif--}}