<?php

namespace App\Http\Controllers;

use App\Models\Condition;
use App\Models\PageSeoImage;
use App\Models\Transport;
use App\Models\TransportAttribute;
use App\Models\TransportModel;
use App\Models\TransportOrder;
use App\Models\TransportType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class TransportController extends Controller
{
    public function index(Request $request)
    {
        $types = TransportType::get();
        $marks = TransportModel::get();
        $coverImage = PageSeoImage::where('page_name', 'transport')->first();
        $this->validate($request, [
            'type' => 'sometimes|nullable|integer|numeric|min:1',
            'mark' => 'sometimes|nullable|integer|numeric|min:1',
            'min_price' => 'sometimes|nullable|integer|numeric|min:1',
            'max_price' => 'sometimes|nullable|integer|numeric|min:1',
        ]);

        $validator = Validator::make($request->all(), [
            'car_type' => 'sometimes|nullable|integer|numeric|min:1',
            'car_mark' => 'sometimes|nullable|integer|numeric|min:1',
            'price_min' => 'sometimes|nullable|integer|numeric|min:0',
            'price_max' => 'sometimes|nullable|integer|numeric|min:0',
            'page' => 'sometimes|nullable|integer|numeric|min:0',
        ]);
        if ($validator->fails()) {
            return abort(404);
        }
        $data = [];
        $append = [];
        $scrol = false;
        $min_price = true;
        $max_price = true;
        if ($request->page) {
            $scrol = true;
        }
        if ($request->car_type) {
            $data['car_type_id'] = $request->car_type;
            $append['car_type'] = $request->car_type;
            $scrol = true;
        }
        if ($request->car_mark) {
            $data['car_mark_id'] = $request->car_mark;
            $append['car_mark'] = $request->car_mark;
            $scrol = true;
        }
        if ($request->type) {
            $data['car_type_id'] = $request->type;
            $scrol = true;
        }
        if ($request->mark) {
            $data['car_mark_id'] = $request->mark;
            $scrol = true;
        }


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
        if ($request->min_price) {
            $min_price = '`price` >= "' . $request->min_price * session('valuta_val') . '"';
            $scrol = true;
        }

        if ($request->max_price) {
            $max_price = '`price` <= "' . $request->max_price * session('valuta_val'). '"';
            $scrol = true;
        }


        $cars = Transport::orderBy('id', 'desc')->where($data)->whereRaw($min_price)->whereRaw($max_price)->paginate(1);
        $cars->appends($append);
        $maximal_price = Transport::max('price');
        return view('transports.index', [
            'cars' => $cars,
            'coverImage' => $coverImage,
            'types' => $types,
            'marks' => $marks,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'price_min' => $request->price_min,
            'price_max' => $request->price_max,
            'car_type' => $request->car_type,
            'car_mark' => $request->car_mark,
            'scrol' => $scrol,
            'maximal_price' => $maximal_price,
        ], $data);
    }

    public function show(Request $request, $slug)
    {
        $attributes = TransportAttribute::get();
        $car = Transport::where('slug', $slug)->firstOrFail();
        $similarCars = Transport::inRandomOrder()
            ->where('id', '!=', $car->id)
            ->where('car_mark_id', $car->car_mark_id)
            ->orWhere('car_type_id', $car->car_type_id)
            ->limit(20)->get();
        $condition = Condition::where('page_name', 'tour')->first();
        return view('transports.transport', [
            'car' => $car,
            'attributes' => $attributes,
            'similarCars' => $similarCars,
            'condition' => $condition,
        ]);
    }

    public function get_book_total(Request $request, $slug)
    {
        if (!isset($slug)) {
            return abort(404);
        }

        $car = Transport::where('slug', $slug)->firstOrFail();
        $total = 0;
        if (isset($request->attribute)) {
            foreach ($request->attribute as $attribute) {
                $attrPrice = TransportAttribute::select('price')->where('id', $attribute)->firstOrFail();
                $total = $total + $attrPrice->price;

            }
        }
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
            'attribute.*' => 'sometimes|nullable|integer|numeric|min:0',
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
        try {
            $car = Transport::where('slug', $slug)->firstOrFail();
            $total = 0;
            if (isset($request->attribute)) {
                foreach ($request->attribute as $attribute) {
                    $attrPrice = TransportAttribute::select('price')->where('id', $attribute)->firstOrFail();
                    $total = $total + $attrPrice->price;

                }
            }
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


//        Mail::send(new OrderHotel($data, $request->all()));


            $order = TransportOrder::create([
                'transport_id' => $car->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'attributes' => implode(',', $request->attribute),
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
        } catch (\Exception $exception) {
            return 'произошла ошибка. пожалуйста попробуйте еще раз';
        }
    }
}
