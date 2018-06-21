<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Mail\Question;
use App\Models\AboutImage;
use App\Models\AboutItem;
use App\Models\AboutText;
use App\Models\City;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Expert;
use App\Models\Faq;
use App\Models\Hotel;
use App\Models\PageSeoImage;
use App\Models\Subscriber;
use App\Models\Tour;
use App\Models\TourType;
use App\Models\TransportModel;
use App\Models\TransportType;
use App\Models\Type;
use App\Models\UserQuestion;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use TCG\Voyager\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $video = Video::find(1);
        $tours = Tour::where('home_slider', 1)->get();
        $hotels = Hotel::where('home_slider', 1)->get();
        $tour_types = Type::get();
        $posts = Post::orderBy('id', 'desc')->limit(3)->get();
        $about_text = AboutText::first();
        $about_images = AboutImage::first();
        $catTypes = Type::get();
        $car_types = TransportType::get();
        $car_models = TransportModel::get();
        $reviews = Comment::limit(10)->get();
        return view('home', compact(
            'video', 'tours',
            'hotels', 'tour_types',
            'posts', 'about_images', 'about_text',
            'catTypes', 'car_models', 'car_types',
            'reviews'
        ));
    }

    public function change_currency(Request $request)
    {
        $array = ['amd', 'usd', 'eur', 'rub'];
        if ($request->from_currency && !in_array($request->from_currency, $array)) {
            return abort(404);
        }

        $from_currency = session('valuta_marka');

        $from_currency = $request->from_currency;

        if (!in_array($request->to_currency, $array)) {
            return abort(404);
        }
        $valuta = Currency::find(1);
        $to_currency = $request->to_currency;

        session(['valuta_marka' => $to_currency]);
        session(['valuta_val' => $valuta->$to_currency]);
        $sinvol = $to_currency . '_sinvol';
        session(['valuta_sinvol' => $valuta->$sinvol]);
        Cookie::queue('valuta_marka', $to_currency, 525600);
        if ($request->method() == 'POST') {
            return response()->json([
                'success' => true,
                'marak' => $to_currency,
                'value' => session('valuta_val'),
                'sinvol' => session('valuta_sinvol'),
            ]);
        } else {
            $url = explode('?', url()->previous());
            return redirect($url[0]);
        }

    }

    public function contact(Request $request)
    {

        if ($request->method() == 'GET') {
            $experts = Expert::get();
            $coverImage = PageSeoImage::where('page_name', 'contact')->first();
            return view('contact', compact('coverImage', 'experts'));
        } elseif ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:30',
                'email' => 'required|email|max:40',
                'message' => 'required|string',
                'g-recaptcha-response' => 'required|captcha',
            ]);
            if ($validator->fails()) {
                return back()->with(['alert-type' => 'error', 'message' => 'Error'])
                    ->withErrors($validator->errors())
                    ->withInput();
            }

            $captcha = app('captcha')->verifyResponse($_POST['g-recaptcha-response']);
            if (!$captcha) {

                return back()->with(['alert-type' => 'error', 'message' => 'Error'])
                    ->withErrors($validator->errors())
                    ->withInput();
            }

//        Mail::send(new Contact( $request->all()));
            return back()->with(['alert-type' => 'success', 'message' => 'Successfully']);
        }
    }

    public function faq(Request $request)
    {
        if ($request->method() == 'GET') {
            $questions = Faq::get();
            $coverImage = PageSeoImage::where('page_name', 'f.a.q')->first();
            return view('faq', compact('coverImage', 'questions'));
        } elseif ($request->method() == 'POST') {
//            dd($request->all());
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:30',
                'email' => 'required|email|max:40',
                'question' => 'required|string',
                'g-recaptcha-response' => 'required|captcha',
            ]);
            if ($validator->fails()) {
                return back()->with(['alert-type' => 'error', 'message' => 'Error'])
                    ->withErrors($validator->errors())
                    ->withInput();
            }

            $captcha = app('captcha')->verifyResponse($_POST['g-recaptcha-response']);
            if (!$captcha) {

                return back()->with(['alert-type' => 'error', 'message' => 'Error'])
                    ->withErrors($validator->errors())
                    ->withInput();
            }

            $res = UserQuestion::create([
                'name' => $request->name,
                'email' => $request->email,
                'question' => $request->question,
            ]);

            if ($res) {
//        Mail::send(new Question( $request->all()));
                return back()->with(['alert-type' => 'success', 'message' => 'Successfully']);
            } else {
                return back()->with(['alert-type' => 'error', 'message' => 'Error'])
                    ->withErrors($validator->errors())
                    ->withInput();
            }
        }
    }


    public function about($country, $city = false)
    {
        if ($country && $country != 'us') {

            $country = Country::where('slug', $country)->firstOrFail();
            if ($city) {
                $test = City::where('slug', $city)->firstOrFail();
            }
            return view('about_country', [
                'country' => $country,
                'city_link' => $city,
            ]);
        } elseif ($country == 'us') {
            $abouts = AboutText::get();
            $coverImage = PageSeoImage::where('page_name', 'about-us')->first();
            $experts = Expert::get();
            $images = AboutImage::get();
            return view('about_us', [
                'abouts' => $abouts,
                'coverImage' => $coverImage,
                'experts' => $experts,
                'about_images' => $images
            ]);
        } else {
            abort(404);
        }
    }

    public function subscriber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribers'
        ]);
        if ($validator->fails()) {
            return View::make('includes.error_make', [
                'errors' => $validator->errors()
            ]);
        }

        $subscriber = Subscriber::create([
            'email' => $request->email,
            'location' => app()->getLocale()
        ]);
        if ($subscriber) {
            return response()->json(['success' => true, 'message' => 'you have successfully subscribed']);
        }


    }
}
