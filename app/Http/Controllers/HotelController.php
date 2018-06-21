<?php

namespace App\Http\Controllers;

use App\Mail\OrderHotel;
use App\Models\City;
use App\Models\Condition;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\HotelOrder;
use App\Models\PageSeoImage;
use App\Models\Room;
use App\Models\RoomSeasin;
use App\Models\Season;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class HotelController extends Controller
{
    public function index(Request $request, $country, $city = false)
    {


        $data = [];
        $append = [];
        $result = [];
        $scrol = false;


        $country = Country::where('slug', $country)->firstOrFail();
        $data['country_id'] = $country->id;
        if ($city) {
            $city = City::where('slug', $city)->where('country_id', $country->id)->firstOrFail();
            $data['city_id'] = $city->id;
        }
        if ($request->star) {
            $data['star'] = $request->star;
            $append['star'] = $request->star;
            $scrol = true;
        }

        if ($request->type) {
            $data['type'] = $request->type;
            $append['type'] = $request->type;
            $scrol = true;
        }
        if ($request->page) {
            $scrol = true;
        }

        $hotels = Hotel::orderBy('id', 'desc')->where($data)->paginate(10);
        $seasons = Season::select('id')->where('start', '<=', Carbon::now())->where('end', '>=', Carbon::now())->get();
        foreach ($seasons as $season) {
            $result [] = $season->id;
        }


        $coverImage = PageSeoImage::where('page_name', 'hotel')->first();


        return view('hotels.index', [
            'hotels' => $hotels,
            'seasons' => $result,
            'get_type' => $request->type,
            'get_star' => $request->star,
            'get_city' => $request->city,
            'coverImage' => $coverImage,
            'scrol' => $scrol,
            'country' => $country,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
        ]);

    }

    public function show($slug)
    {

        if (!$slug) {
            return abort(404);
        } else {
            $hotel = Hotel::where('slug', $slug)->firstOrFail();
            $seasons = Season::select('id')->where('start', '<=', Carbon::now())->where('end', '>=', Carbon::now())->get();
            $similarHotels = Hotel::inRandomOrder()->where('id', '!=', $hotel->id)->limit(10)->get();
            foreach ($seasons as $season) {
                $result [] = $season->id;
            }
            $room_id = [];
            foreach ($hotel->rooms as $room) {
                $room_id [] = $room->id;
            }

            $condition = Condition::where('page_name', 'hotel')->first();
            $room_season = RoomSeasin::whereIn('room_id', $room_id)->get();
            return view('hotels.single_hotel', [
                'hotel' => $hotel,
                'seasons' => $result,
                'similarHotels' => $similarHotels,
                'room_season' => $room_season,
                'condition' => $condition,
            ]);

        }
    }

    public function get_hotel_book_total(Request $request)
    {
        $this->validate($request, [
            'room' => 'required',
        ]);
        $check_in = false;
        $check_out = false;
        $total = 0;
        $test_day = 0;
        if ($request->check_in) {
            if (!strtotime($request->check_in)) {
                return abort(404);
            } else {
                $check_in = $request->check_in;
            }
        }

        if ($request->check_out) {
            if (!strtotime($request->check_out)) {
                return abort(404);
            } else {
                $check_out = $request->check_out;
            }
        }

        $quantity = $request->room_count;

        $room = Room::where('id', $request->room)->firstOrFail();

        $room_season = $room->seasons()->whereHas('season', function ($q) use ($check_in, $check_out) {
            $q->where('start', '<=', $check_in)->where('end', '>=', $check_out);
        })->first();

        $sale = $room->hotel->sale;
        if ($room_season) {
            $check_in = Carbon::parse($check_in);
            $day = $check_in->diffInDays(Carbon::parse($check_out));
            $price = $room_season->price;

            if ($sale) {
                $price = $price - (($price / 100) * $sale);
            }
            $total = $total + ($price * $quantity);
            $test_day = $test_day + $day;
            $total = $total * $day;
        } else {
            if (isset($check_in)) {
                $test_start = $room->seasons()->whereHas('season', function ($q) use ($check_in) {
                    $q->where('start', '<=', $check_in)->where('end', '>=', $check_in);
                })->first();
                if ($test_start) {
                    $check_in = Carbon::parse($check_in);
                    $day = $check_in->diffInDays(Carbon::parse($test_start->season->end));
                    $price = $test_start->price;
                    $sale = $test_start->sell;
                    if ($sale) {
                        $price = $price - (($price / 100) * $sale);
                    }
                    $total = $total + ($price * $quantity);
                    $test_day = $test_day + $day;
                    $total = $total * $day;
                }
            }
            if ($check_out) {
                $test_end = $room->seasons()->whereHas('season', function ($q) use ($check_out) {
                    $q->where('start', '<=', $check_out)->where('end', '>=', $check_out);
                })->first();

                if ($test_end) {
                    $check_out = Carbon::parse($check_out);
                    $day = Carbon::parse($test_end->season->start)->diffInDays($check_out);
                    $price = $test_end->price;
                    $sale = $test_end->sell;
                    if ($sale) {
                        $price = $price - (($price / 100) * $sale);
                    }
                    $total = $total + ($price * $quantity);
                    $test_day = $test_day + $day;
                    $total = $total * $day;
                }
            }
        }

        if ($total < 1) {
            $check_in = Carbon::parse($check_in);
            $day = $check_in->diffInDays(Carbon::parse($check_out));
            $price = $room->price;
            $sale = $room->sell;
            if ($sale) {
                $price = $price - (($price / 100) * $sale);
            }
            $total = $total + ($price * $quantity);

            $total = $total * $day;
        }

        if ($test_day > 0) {
            $check_in = Carbon::parse($check_in);
            if ($test_day != $check_in->diffInDays(Carbon::parse($check_out))) {
                return response()->json([
                    'error' => true,
                    'success' => false,
                    'message' => '<a href="' . route('contact') . '" target="_blank" class="btn">please contact us</a>'
                ]);
            }
        }
        $origin_price = $total;
        $total = round(($total) / (session('valuta_val') ? session('valuta_val') : 1));
        return response()->json([
            'success' => true,
            'error' => false,
            'origin_price' => $origin_price,
            'total' => $total,
            'night' => $test_day,
            'day' => $test_day + 1,
        ]);
    }


    public function get_book(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'room' => 'required',
            'room_count' => 'required|integer|numeric|min:1',
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


        try{
            $hotel = Hotel::where('slug', $request->slug)->firstOrFail();
            $check_in = false;
            $check_out = false;
            $total = 0;
            $test_day = 0;
            if ($request->check_in) {
                if (!strtotime($request->check_in)) {
                    return abort(404);
                } else {
                    $check_in = $request->check_in;
                }
            }

            if ($request->check_out) {
                if (!strtotime($request->check_out)) {
                    return abort(404);
                } else {
                    $check_out = $request->check_out;
                }
            }

            $quantity = $request->room_count;

            $room = Room::where('id', $request->room)->firstOrFail();

            $room_season = $room->seasons()->whereHas('season', function ($q) use ($check_in, $check_out) {
                $q->where('start', '<=', $check_in)->where('end', '>=', $check_out);
            })->first();

            if ($room_season) {
                $check_in = Carbon::parse($check_in);
                $day = $check_in->diffInDays(Carbon::parse($check_out));
                $price = $room_season->price;
                $sale = $room_season->sell;
                if ($sale) {
                    $price = $price - (($price / 100) * $sale);
                }
                $total = $total + ($price * $quantity);
                $test_day = $test_day + $day;
                $total = $total * $day;
            } else {
                if (isset($check_in)) {
                    $test_start = $room->seasons()->whereHas('season', function ($q) use ($check_in) {
                        $q->where('start', '<=', $check_in)->where('end', '>=', $check_in);
                    })->first();
                    if ($test_start) {
                        $check_in = Carbon::parse($check_in);
                        $day = $check_in->diffInDays(Carbon::parse($test_start->season->end));
                        $price = $test_start->price;
                        $sale = $test_start->sell;
                        if ($sale) {
                            $price = $price - (($price / 100) * $sale);
                        }
                        $total = $total + ($price * $quantity);
                        $test_day = $test_day + $day;
                        $total = $total * $day;
                    }
                }
                if ($check_out) {
                    $test_end = $room->seasons()->whereHas('season', function ($q) use ($check_out) {
                        $q->where('start', '<=', $check_out)->where('end', '>=', $check_out);
                    })->first();

                    if ($test_end) {
                        $check_out = Carbon::parse($check_out);
                        $day = Carbon::parse($test_end->season->start)->diffInDays($check_out);
                        $price = $test_end->price;
                        $sale = $test_end->sell;
                        if ($sale) {
                            $price = $price - (($price / 100) * $sale);
                        }
                        $total = $total + ($price * $quantity);
                        $test_day = $test_day + $day;
                        $total = $total * $day;
                    }
                }
            }

            if ($total < 1) {
                $check_in = Carbon::parse($check_in);
                $day = $check_in->diffInDays(Carbon::parse($check_out));
                $price = $room->price;
                $sale = $room->sell;
                if ($sale) {
                    $price = $price - (($price / 100) * $sale);
                }
                $total = $total + ($price * $quantity);

                $total = $total * $day;
            }


            $origin_price = $total;
            $total = round(($total) / (session('valuta_val') ? session('valuta_val') : 1));
            $data['request'] = $request->all();
            $data['total'] = $total;
            $data['origin_price'] = $origin_price;

            $order = HotelOrder::create([
                'hotel_id' => $hotel->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'room_count' => $request->room_count,
                'abult' => $request->adult,
                'child' => $request->child,
                'child_age' => isset($request->child_age[0]) ? implode(',', $request->child_age) : '',
                'note' => $request->message,
                'room_name' => $room->name,
                'selected_currency' => session('valuta_marka'),
                'change_total' => $data['total'],
                'original_total' => $data['origin_price'],
            ]);

//        Mail::send(new OrderHotel($data, $request->all()));
            if ($order) {
                return response()->json(['success' => true, 'message' => 'Order Successfully']);
            } else {
                return 'произошла ошибка. пожалуйста попробуйте еще раз';
            }
        }catch (\Exception $exception){
            return 'произошла ошибка. пожалуйста попробуйте еще раз';
        }


    }


}
