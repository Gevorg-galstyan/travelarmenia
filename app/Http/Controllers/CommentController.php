<?php


namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\PageSeoImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Kamaln7\Toastr\Facades\Toastr;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use App\Http\Controllers\Admin\Controller;


class CommentController extends Controller
{
    use BreadRelationshipParser;

    public function index(){
        Carbon::setLocale(config('app.locale'));
        $coverImage = PageSeoImage::where('page_name', 'reviews')->first();
        $comments = Comment::where('public', 1)->orderBy('id', 'desc')->paginate(20);
        return view('reviews', [
            'coverImage' => $coverImage,
            'comments' => $comments,
        ]);
    }


    public function store(Request $request, $tour_slug = false)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:30',
            'user_email' => 'required|email|max:40',
            'user_country' => 'required|string',
            'text' => 'required|string',
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
        $slug = 'comments';

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows);

        if ($val->fails()) {
            return response()->json(['errors' => $val->messages()]);
        }

        if (!$request->ajax()) {
            $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

            event(new BreadDataAdded($dataType, $data));
            Toastr::success(__('voyager.generic.successfully_added_new') . " {$dataType->display_name_singular}", $title = 'success', $options = []);
            return redirect()
                ->back()
                ->with([
                    'message' => __('voyager.generic.successfully_added_new') . " {$dataType->display_name_singular}",
                    'alert-type' => 'success',
                ]);
        }
    }

}
