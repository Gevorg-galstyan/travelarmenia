<?php

namespace App\Http\Controllers;

use App\Mail\OrderExcursion;
use App\Models\Excursion;
use App\Models\ExcursionOrder;
use App\Models\PageSeoImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ExcursionController extends Controller
{
    public function index(Request $request, $slug = false)
    {

        $search_text = $request->excursion;
        if ($slug) {
            $excursions = false;
            $excursion = Excursion::where('slug', $slug)->firstOrFail();
        } else {
            $excursion = false;
            if ($request->excursion) {
                if (app()->getLocale() == 'ru') {
                    $excursions = Excursion::where('title', 'like', '%' . $request->excursion . '%')->paginate(10);
                } elseif (app()->getLocale() == 'en') {
                    $result_translates = DB::table('translations')
                        ->select('foreign_key')
                        ->where([
                            'table_name' => 'excursions',
                            'column_name' => 'title',
                            'locale' => 'en'
                        ])
                        ->where('value', 'like', '%' . $request->excursion . '%')->get();
                    $ids = [];
                    foreach ($result_translates as $result_translate) {
                        $ids[] = $result_translate->foreign_key;
                    }
                    $excursions = Excursion::whereIn('id', $ids)->paginate(10);
                }

            } else {
                $excursions = Excursion::orderBy('sort', 'asc')->paginate(10);
            }
        }


        $coverImage = PageSeoImage::where('page_name', 'excursions')->first();
        $excursions->appends(['excursion' => $request->excursion]);
        return view('excursions.index', compact('excursions', 'excursion', 'search_text', 'coverImage', 'slug'));
    }

    public function search(Request $request)
    {
        $results = [];
        if (app()->getLocale() == 'ru') {
            $results = Excursion::where('title', 'like', '%' . $request->excursions . '%')->get();
        } elseif (app()->getLocale() == 'en') {
            $result_translates = DB::table('translations')
                ->select('foreign_key')
                ->where([
                    'table_name' => 'excursions',
                    'column_name' => 'title',
                    'locale' => 'en'
                ])
                ->where('value', 'like', '%' . $request->excursions . '%')->get();
            $ids = [];
            foreach ($result_translates as $result_translate) {
                $ids[] = $result_translate->foreign_key;
            }
            $results = Excursion::whereIn('id', $ids)->get();
        }
        return View::make('excursions.results', compact('results'));

    }

    public function get_book($slug)
    {
        $excursion = Excursion::where('slug', $slug)->firstOrFail();
        return View::make('excursions.book_form', compact('excursion'));
    }

    public function get_book_total(Request $request, $slug)
    {

        $excursion = Excursion::where('slug', $slug)->firstOrFail();

        return $this->total_price($request, $excursion);

    }

    public function total_price(Request $request, $excursion)
    {
        $abult = $request->adult;
        $child = $request->child_age;
        $no_price = 0;
        $half = 0;
        $price = $excursion->fuel;
        if (isset($child[0])) {
            foreach ($child as $item) {
                if ($item > 0) {
                    if ($item < 6) {
                        $no_price = $no_price + 1;
                    } elseif ($item < 12) {
                        $half = $half + 1;
                    } else {
                        $abult = $abult + 1;
                    }
                }
            }
        }
        if ($half > 0) {
            $abult = $abult + ($half / 2);
        }
        if ($abult > 5) {
            $price = $price + $excursion->additional_fuel;
        }
        $total = ($price + $excursion->git) + ($excursion->ticket * $abult) + ($excursion->surcharge_per_person * $abult);
        if ($excursion->surcharge_percentage > 0) {
            $total = (($total * $excursion->surcharge_percentage) / 100) + $total;
        }
        $origin_price_per_person = $total / $abult;
        $price_per_person  = round(($price_per_person = $total / $abult) / (session('valuta_val') ? session('valuta_val') : 1));
        $origin_total = $total;
        $total = round(($origin_total) / (session('valuta_val') ? session('valuta_val') : 1));
        return response()->json([
            'success'=>true,
            'origin_total' => $origin_total,
            'total' => $total,
            'price_per_person' => $price_per_person,
            'origin_price_per_person' => $origin_price_per_person,
        ]);

    }
    public function book(Request $request, $slug){
        $validator = Validator::make($request->all(), [
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
//            'g-recaptcha-response' => 'required|captcha',
        ]);

        if ($validator->fails()) {
            return View::make('includes.error_make', [
                'errors' => $validator->errors()
            ]);
        }
        $captcha = app('captcha')->verifyResponse($_POST['g-recaptcha-response']);
//        if (!$captcha) {
//            return View::make('includes.error_make', [
//                'captcha_errors' => 'required'
//            ]);
//        }


//        try{
            $data_price = $this->get_book_total($request, $slug);



            $excursion = Excursion::where('slug', $slug)->firstOrFail();

        Mail::send(new OrderExcursion($data_price,$excursion, $request->all()));

            $order = ExcursionOrder::create([
                'excursion__id' => $excursion->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'abult' => $request->abuld,
                'child' => $request->child,
                'child_age' => isset($request->child_age[0])? implode(' , ',$request->child_age) : '',
                'note' => $request->message,
                'change_total' =>json_decode( $data_price)['total'],
                'original_total' => json_decode( $data_price)['origin_total'],
                'selected_currency' => session('valuta_marka'),
                'price_per_person' => json_decode( $data_price)['price_per_person'],
                'original_price_per_person' => json_decode( $data_price)['original_price_per_person'],
            ]);


            if ($order){
                return response()->json(['success' => true, 'message' => 'Order Successfully']);
            }else{
                return 'произошла ошибка. пожалуйста попробуйте еще раз';
            }
//        }catch (\Exception $exception){
//            return 'произошла ошибка. пожалуйста попробуйте еще раз';
//        }
    }
}
