<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Heightag;
use App\Models\PageSeoImage;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::get();
        $tags = Heightag::get();
        $date['status'] = 'PUBLISHED';
        if($request->category && $request->category != 'all'){
            $category = Category::where('slug', $request->category)->firstOrFail();
            $date['category_id'] = $category->id;
            $category_active_slug = $category->slug;
        }else{
            $category_active_slug = null;
        }
        $posts = Post::where($date)->orderBy('created_at', 'desc')->paginate(10);


        if($request->tag){
            if ($request->date){
                if (is_numeric(strtotime($request->date))) {
                    $array_date = explode('-', $request->date);
                    $year = $array_date[0];
                    $month = $array_date[1];
                    $day = $array_date[2];
                    $tag_active_slug = Heightag::where('slug', $request->tag)->firstOrFail();
                    $tag_active_slug = $tag_active_slug->slug;
                    $posts = Post::where($date)->orderBy('created_at', 'desc')->whereHas('heightags',function ($q) use ($request){
                        $q->where('slug', $request->tag);
                    })
                        ->whereYear('created_at', '=', $year)
                        ->whereMonth('created_at', '=', $month)
                        ->whereDay('created_at', '=', $day)
                        ->paginate(10);
                    $posts->appends(['date' => $request->date]);

            }else{
                    return redirect()->route('home');
                }
            }else{
                $tag_active_slug = Heightag::where('slug', $request->tag)->firstOrFail();
                $tag_active_slug = $tag_active_slug->slug;
                $posts = Post::where($date)->orderBy('created_at', 'desc')->whereHas('heightags',function ($q) use ($request){
                    $q->where('slug', $request->tag);
                })->paginate(10);
            }

        }else{
            $tag_active_slug = null;
            if ($request->date){
                if (is_numeric(strtotime($request->date))) {
                    $array_date = explode('-', $request->date);
                    $year = $array_date[0];
                    $month = $array_date[1];
                    $day = $array_date[2];
                    $posts = Post::where($date)->orderBy('created_at', 'desc')
                        ->whereYear('created_at', '=', $year)
                        ->whereMonth('created_at', '=', $month)
                        ->whereDay('created_at', '=', $day)
                        ->paginate(10);
                    $posts->appends(['date' => $request->date]);
            }else{
                    return redirect()->route('home');
                }
            }else{
                $posts = Post::where($date)->orderBy('created_at', 'desc')->paginate(10);
            }
        }


        $recomendit_posts = Post::where('status', 'PUBLISHED')->orderBy('created_at', 'desc')->inRandomOrder()->limit(5)->get();
        $coverImage = PageSeoImage::where('page_name', 'blog')->first();
        return view('posts.index',
            compact('categories', 'tags',
                'posts','coverImage', 'recomendit_posts',
                'category_active_slug', 'tag_active_slug'
            ));
    }

    public function show($slug)
    {
        if (!$slug) {
            return abort(404);
        } else {
            $blog = Post::where('slug', $slug)->firstOrFail();
            $recomendit_posts = Post::where('status', 'PUBLISHED')->orderBy('created_at', 'desc')->inRandomOrder()->limit(5)->get();
            $categories = Category::get();
            $coverImage = PageSeoImage::where('page_name', 'blog')->first();
            $tags = Heightag::get();

            return view('posts.single_post', [
                'blog' => $blog,
                'tags' => $tags,
                'coverImage' => $coverImage,
                'recomendit_posts' => $recomendit_posts,
                'categories' => $categories,
            ]);
        }
    }
}
