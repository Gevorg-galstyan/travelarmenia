<?php

namespace App\Http\Controllers;

use App\Mail\OrderTour;
use App\Models\Condition;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\PageSeoImage;
use App\Models\Tour;
use App\Models\TourOrder;
use App\Models\TourPromoCode;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class TourController extends Controller
{
    public function index(Request $request, $country)
    {
        if (!$country) {
            return abort(404);
        }
        $validator = Validator::make($request->all(), [
            'page' => 'sometimes|nullable|integer|numeric|min:0',
        ]);
        if ($validator->fails()) {
            return abort(404);
        }
        $country = Country::where('slug', $country)->firstOrFail();
        $type = false;
        $check_in = false;
        $check_out = false;
        $scrol = false;
        $append = [];

        if ($request->page) {
            $scrol = true;
        }
        if ($request->type) {
            $type = Type::where('id', $request->type)->firstOrFail();
            $append['type'] = $request->type;
            $scrol = true;
        }


        if ($request->i_g) {
            $array = ['individual', 'groups'];
            if (!in_array($request->i_g, $array)) {
                return abort(404);
            } else {
                $data['type'] = $request->i_g;
            }
            $append['i_g'] = $request->i_g;
            $scrol = true;
        } else {
            $data['type'] = 'individual';
        }

        if ($request->check_in) {
            if (!strtotime($request->check_in)) {
                return abort(404);
            }
            $check_in = $request->check_in;
            $append['check_in'] = $check_in;
            $scrol = true;
        } else {
            $check_in = '';
        }


        if ($request->check_out) {
            if (!strtotime($request->check_out)) {
                return abort(404);
            }
            $check_out = $request->check_out;
            $append['check_out'] = $check_out;
            $scrol = true;
        } else {
            $check_out = '';
        }

        if ($type) {
            $tours = Tour::where($data)
                ->where('check_in', 'like', '%' . $check_in . '%')
                ->where('check_out', 'like', '%' . $check_out . '%')
                ->whereHas('types', function ($query) use ($type) {
                    $query->where('type_id', $type->id);
                })->orderBy('id', 'desc')->paginate(14);


        } else {
            $tours = Tour::where($data)
                ->where('check_in', 'like', '%' . $check_in . '%')
                ->where('check_out', 'like', '%' . $check_out . '%')
                ->orderBy('id', 'desc')->paginate(14);

        }
        $catTypes = Type::get();
        $tours->appends($append);
        $coverImage = PageSeoImage::where('page_name', 'tour')->first();
        return view('tours.index', [
            'tours' => $tours,
            'catTypes' => $catTypes,
            'type' => $request->type,
            'coverImage' => $coverImage,
            'scrol' => $scrol,
            'link' => $country->slug,
            'country_id' => $country->id,
            'i_g' => $data['type'],
        ]);


    }

    public function show(Request $request, $slug)
    {
        if (!$slug) {
            return abort(404);
        } else {
            $tour = Tour::where('slug', $slug)->firstOrFail();
//            $orederCount = $tour->orders->where('family', 0)->sum('count');
//            $available = $tour->available - $orederCount;
            $similarTours = Tour::inRandomOrder()->where('id', '!=', $tour->id)->where('country_id', '!=', $tour->country_id)->limit(20)->get();
            $test_pricing = [];
            if ($tour->pricing) {
                $data = json_decode($tour->pricing->details, true);
                foreach ($data as $item) {
                    if ($item['hotel_slug']) {
                        $test_pricing[] = $item['hotel_slug'];
                    }
                }
                $hotels = Hotel::where('country_id', $tour->country_id)->whereNotIn('slug', $test_pricing)->whereHas('city', function ($q) {
                    $q->where('capital', 1);
                })->get();
            } else {
                $hotels = false;
            }

            $condition = Condition::where('page_name', 'tour')->first();
            return view('tours.single_tour', [
                'tour' => $tour,
                'similarTours' => $similarTours,
//                'available' => $available,
//                'orederCount' => $orederCount,
                'hotels' => $hotels,
                'condition' => $condition,
            ]);
        }
    }

    public function get_book(Request $request, $slug)
    {
        $tour = Tour::where('slug', $slug)->firstOrFail();
        if ($tour->pricing) {
            $pricing = json_decode($tour->pricing->details, true);
        }

        if (!empty($pricing) && (!empty($request->column) || $request->column == 0 && $request->column != '') && (!empty($request->row) || $request->row == 0 && $request->row != '')) {
            $column = $request->column;
            $row = $request->row;
            $price = $pricing[$row]['column'][$column]['value'];
            $count = $pricing[$row]['column'][$column]['title'];
            $hotel_name = $pricing[$row]['hotel_' . app()->getLocale() . '_name'];
            $hotel_slug = $pricing[$row]['hotel_slug'];
        } elseif ($request->hotel || (!empty($request->column) || $request->column == 0 && $request->column != '')) {

            $hotel = Hotel::where('slug', $request->hotel)->firstOrFail();
            $hotel_name = $hotel->name;
            $hotel_slug = $request->hotel;
            $column = $request->column;
            $count = $pricing[0]['column'][$column]['title'];
            $price = '';
        } else {
            $price = $tour->price;
            $hotel_name = false;
            $hotel_slug = false;
            $count = false;
        }
        $data = $request->all();
        return View::make('tours.get_book', compact('tour', 'price', 'hotel_name', 'hotel_slug', 'count', 'data'));
    }

    public function get_book_total(Request $request, $slug)
    {
        $tour = Tour::where('slug', $slug)->firstOrFail();
        if ($tour->pricing) {
            $pricing = json_decode($tour->pricing->details, true);
        }
        if (!empty($pricing) && (!empty($request->column) || $request->column == 0 && $request->column != '') && (!empty($request->row) || $request->row == 0 && $request->row != '')) {
            $column = $request->column;
            $row = $request->row;
            $price = $pricing[$row]['column'][$column]['value'];
        } elseif ($request->hotel || (!empty($request->column) || $request->column == 0 && $request->column != '')) {
            $price = '';
        } else {
            $price = $tour->price;
        }
        $total = 0;
        $one_price = 0;
        $floor_price = 0;
        $promo_code = false;
        if (!empty($request->adult)) {
            $one_price = $request->adult;
        }
        if (isset($request->child_age[0])) {
            foreach ($request->child_age as $item) {
                if ($item < 6) {
                    continue;
                } elseif ($item < 12) {
                    $floor_price++;
                } elseif ($item >= 12) {
                    $one_price++;
                }
            }
        }
        if ($price) {
            if (!empty($request->promo_code)) {
                $promo_code = TourPromoCode::where('code', $request->promo_code)->first();
            }
            if ($promo_code) {
                $promo_percent = $promo_code->percent;
                $promo_price = $price - (($price / 100) * $promo_percent);
                $total = $total + ($promo_price * $one_price);
            } else {
                $total = $total + ($price * $one_price);
            }

            if ($floor_price > 0) {
                $total = $total + (($price * $floor_price) / 2);
            }

            if ($tour->sale) {
                $sale = $tour->sale;
                $total = $total - (($total / 100) * $sale);
            }
            $data['original_price'] = $total;

            $data['change_price'] = round($total / (session('valuta_val')
                    ? session('valuta_val') : 1));
            $data['no_price'] = false;

        }else{
            $data['no_price'] = true;
        }

        return $data;
    }

    public function get_tour_order(Request $request, $slug)
    {
        $validator = Validator::make($request->all(), [
            'adult' => 'required|integer',
            'first_name' => 'required',
            'last_name' => 'required',
            'conditions' => 'required',
            'email' => 'email',
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


        try{
            $data_price = $this->get_book_total($request, $slug);



            $tour = Tour::where('slug', $slug)->firstOrFail();
            if ($tour->pricing) {
                $pricing = json_decode($tour->pricing->details, true);
            }

            if (!empty($pricing) && (!empty($request->column) || $request->column == 0 && $request->column != '') && (!empty($request->row) || $request->row == 0 && $request->row != '')) {
                $column = $request->column;
                $row = $request->row;
                $data['price'] = $pricing[$row]['column'][$column]['value'];
                $data['count'] = $pricing[$row]['column'][$column]['title'];
                $data['hotel_name'] = $pricing[$row]['hotel_' . app()->getLocale() . '_name'];
                $data['hotel_slug'] = $pricing[$row]['hotel_slug'];
            } elseif ($request->hotel || (!empty($request->column) || $request->column == 0 && $request->column != '')) {
                $hotel = Hotel::where('slug', $request->hotel)->firstOrFail();
                $data['hotel_name'] = $hotel->name;
                $data['hotel_slug'] = $request->hotel;
                $column  = $request->column;
                $data['count'] = $pricing[0]['column'][$column]['title'];
                $data['price'] = '';
            } else {
                $data['price'] = $tour->price;
                $data['hotel_name'] = false;
                $data['hotel_slug'] = false;
                $data['count'] = false;
            }
//        Mail::send(new OrderTour($data_price, $data, $request->all()));

            $order = TourOrder::create([
                'tour_id' => $tour->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'abult' => $request->abuld,
                'child' => $request->child,
                'child_age' => isset($request->child_age[0])? implode(' , ',$request->child_age) : '',
                'promo_code' => $request->promo_code,
                'note' => $request->message,
                'hotel_name' => isset($data['hotel_name'])? $data['hotel_name'] : '',
                'hotel_slug' => isset($data['hotel_name'])? $data['hotel_slug'] : '',
                'people' => isset($data['count'])? $data['count'] : '',
                'change_total' => isset($data_price['change_price'])? $data_price['change_price'] : '',
                'original_total' => isset($data_price['original_price'])? $data_price['original_price'] : '',
                'selected_currency' => session('valuta_marka'),
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
            ]);


            if ($order){
                return response()->json(['success' => true, 'message' => 'Order Successfully']);
            }else{
                return 'произошла ошибка. пожалуйста попробуйте еще раз';
            }
        }catch (\Exception $exception){
            return 'произошла ошибка. пожалуйста попробуйте еще раз';
        }

    }
}
