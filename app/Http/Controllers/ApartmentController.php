<?php

namespace App\Http\Controllers;

use App\Models\Apaerment;
use App\Models\ApartmentOrder;
use App\Models\Condition;
use App\Models\PageSeoImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {

        $search_text = $request->apartment;
        if ($request->type) {
            $date['type'] = $request->type;
        } else {
            $data = [];
        }
        $scrol = false;
        $min_price = true;
        $max_price = true;
        if ($request->apartment) {
            if (app()->getLocale() == 'ru') {
                $apartments = Apaerment::where($data)->where('title', 'like', '%' . $request->apartment . '%')->paginate(10);
            } elseif (app()->getLocale() == 'en') {
                $result_translates = DB::table('translations')
                    ->select('foreign_key')
                    ->where([
                        'table_name' => 'apaerments',
                        'column_name' => 'title',
                        'locale' => 'en'
                    ])
                    ->where('value', 'like', '%' . $request->apartment . '%')->get();
                $ids = [];
                foreach ($result_translates as $result_translate) {
                    $ids[] = $result_translate->foreign_key;
                }
                $apartments = Apaerment::where($data)->whereIn('id', $ids)->paginate(10);
            }

        } else {
            if ($request->price_min) {
                $min_price = '`price` >= "' . $request->price_min * session('valuta_val') . '"';
                $append['price_min'] = $request->price_min;
                $scrol = true;
            }
            if ($request->price_max) {
                $max_price = '`price` <= "' . $request->price_max * session('valuta_val') . '"';
                $append['price_max'] = $request->price_max;
                $scrol = true;
            }
            $apartments = Apaerment::whereRaw($min_price)->whereRaw($max_price)->paginate(10);
        }
        $coverImage = PageSeoImage::where('page_name', 'apartment')->first();
        $type = $request->type;
        $apartment_count = Apaerment::where('type', 'apartment')->count();
        $house_count = Apaerment::where('type', 'house')->count();
        $price_min = $request->price_min;
        $price_max = $request->price_max;
        $apartments->appends(['apartment' => $request->apartment]);
        $maximal_price = Apaerment::max('price');
        return view('apartments.index',
            compact('apartments', 'coverImage',
                'type', 'apartment_count', 'house_count',
                'search_text', 'maximal_price', 'scrol',
                'price_min', 'price_max'
            ));

    }

    public function search(Request $request)
    {
        $results = [];
        if (app()->getLocale() == 'ru') {
            $results = Apaerment::where('title', 'like', '%' . $request->excursions . '%')->get();
        } elseif (app()->getLocale() == 'en') {
            $result_translates = DB::table('translations')
                ->select('foreign_key')
                ->where([
                    'table_name' => 'apaerments',
                    'column_name' => 'title',
                    'locale' => 'en'
                ])
                ->where('value', 'like', '%' . $request->excursions . '%')->get();
            $ids = [];
            foreach ($result_translates as $result_translate) {
                $ids[] = $result_translate->foreign_key;
            }
            $results = Apaerment::whereIn('id', $ids)->get();
        }
        return View::make('apartments.results', compact('results'));
    }

    public function show($slug)
    {
        $apartment = Apaerment::where('slug', $slug)->firstOrFail();
        $similarApartment = Apaerment::inRandomOrder()
            ->where('id', '!=', $apartment->id)
            ->where('type', $apartment->type)
            ->limit(20)->get();
        $condition = Condition::where('page_name', 'apartment')->first();
        return view('apartments.apartment', [
            'apartment' => $apartment,
            'similarApartment' => $similarApartment,
            'condition' => $condition,
        ]);
    }

    public function get_book_total(Request $request, $slug)
    {
        if (!isset($slug)) {
            return abort(404);
        }

        $car = Apaerment::where('slug', $slug)->firstOrFail();
        $total = 0;
        $difference = false;
        if ($request->check_in && $request->check_ouy) {

            $check_in = new Carbon($request->check_in);
            $check_ouy = new Carbon($request->check_ouy);
            $difference = $check_in->diff($check_ouy)->days;
        }
        if ($difference) {
            $price = $car->price;
            foreach ($car->pricing as $pricing) {
                $day = $pricing->day;
                $p = explode('-', $day);
                if (isset($p[1])) {
                    settype($p[0], 'int');
                    settype($p[1], 'int');
                    if ($difference >= $p[0] && $difference <= $p[1]) {
                        $price = $pricing->price;
                        break;
                    }
                } else {
                    settype($p[0], 'int');
                    if ($difference == $p[0]) {
                        $price = $pricing->price;
                        break;
                    }
                }
            }

            $price = $price * $difference;
        } else {
            $price = $car->price;
        }


        $total = $total + $price;


        $origin_price = $total;
        $total = round(($total) / (session('valuta_val') ? session('valuta_val') : 1));
        return response()->json([
            'success' => true,
            'error' => false,
            'origin_price' => $origin_price,
            'total' => $total,
        ]);
    }

    public function get_book(Request $request, $slug)
    {
        $validator = Validator::make($request->all(), [
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        if ($validator->fails()) {
            return View::make('includes.error_make', [
                'errors' => $validator->errors()
            ]);
        }
        $captcha = app('captcha')->verifyResponse($_POST['g-recaptcha-response']);
        if (!$captcha) {
            return View::make('includes.error_make', [
                'captcha_errors' => 'required'
            ]);
        }
//        try {
        $car = Apaerment::where('slug', $slug)->firstOrFail();
        $total = 0;
        $difference = false;
        if ($request->check_in && $request->check_ouy) {

            $check_in = new Carbon($request->check_in);
            $check_ouy = new Carbon($request->check_ouy);
            $difference = $check_in->diff($check_ouy)->days;
        }
        if ($difference) {
            $price = $car->price;
            foreach ($car->pricing as $pricing) {
                $day = $pricing->day;
                $p = explode('-', $day);
                if (isset($p[1])) {
                    settype($p[0], 'int');
                    settype($p[1], 'int');
                    if ($difference >= $p[0] && $difference <= $p[1]) {
                        $price = $pricing->price;
                        break;
                    }
                } else {
                    settype($p[0], 'int');
                    if ($difference == $p[0]) {
                        $price = $pricing->price;
                        break;
                    }
                }
            }
            $price = $price * $difference;
        } else {
            $price = $car->price;
        }
        $total = $total + $price;
        $origin_price = $total;
        $total = round(($total) / (session('valuta_val') ? session('valuta_val') : 1));


//        Mail::send(new OrderApartment($data, $request->all()));


        $order = ApartmentOrder::create([
            'apartment_id' => $car->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'note' => $request->note,
            'selected_currency' => session('valuta_marka'),
            'original_total' => $origin_price,
            'change_total' => $total,
        ]);
        if ($order) {
            return response()->json(['success' => true, 'message' => 'Order Successfully']);
        } else {
            return 'произошла ошибка. пожалуйста попробуйте еще раз';
        }
//        } catch (\Exception $exception) {
//            return 'произошла ошибка. пожалуйста попробуйте еще раз';
//        }
    }


}
