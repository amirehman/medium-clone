<?php

namespace App\Http\Controllers;

use App\Article;
use App\Thumbnail;
use Illuminate\Http\Request;
use Auth;
use App\Http\Resources\AdminAllArticles;

class ArticleController extends Controller
{


    public function __construct()
    {
      $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $articles = AdminAllArticles::collection(Article::latest()->paginate(15));
        return view('admin.layouts.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.layouts.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(request(),[
            "title" => "required",
            "body" => "required",
            "tags" => "required"
        ]);


        $article = new Article;
        $slug =  str_slug($request->title);


        //Checking for slug if already availble
        $articles = Article::where('slug', '=', $slug)->get();
        if($articles->count() == 0)
        {
          $article->slug = $slug;
        }else{
          //Making slug unique
          $count = Article::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
          $slug = $article->slug = $count ? "{$slug}-{$count}" : $slug;
        }


        $article->title = $request->title;
        $article->slug = $slug;
        $article->body = $request->body;
        $article->status = 1;
        $article->user_id = auth()->id();   
        $article->save();

        //syncing tags
        $article->tags()->sync($request->tags);  


        //compressing images
        if(count($request->thumbnails) != 0){

            foreach($request->thumbnails as $thumbnail){

                $image_blur = 'blur-'.time().'.' . explode('/', explode(':', substr($thumbnail, 0, strpos($thumbnail, ';')))[1])[1];
                \Image::make($thumbnail)->blur(50)->resize(250, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('images/').$image_blur);

                $image_small = 'small-'.time().'.' . explode('/', explode(':', substr($thumbnail, 0, strpos($thumbnail, ';')))[1])[1];
                \Image::make($thumbnail)->resize(250, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('images/').$image_small);

                $image_medium = 'medium-'.time().'.' . explode('/', explode(':', substr($thumbnail, 0, strpos($thumbnail, ';')))[1])[1];
                \Image::make($thumbnail)->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('images/').$image_medium);

                $image_large = 'large-'.time().'.' . explode('/', explode(':', substr($thumbnail, 0, strpos($thumbnail, ';')))[1])[1];
                \Image::make($thumbnail)->resize(720, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('images/').$image_large);


                $thumbnail = new Thumbnail();

                $thumbnail->blur = $image_blur;
                $thumbnail->small = $image_small;
                $thumbnail->medium = $image_medium;
                $thumbnail->large = $image_large;
                $thumbnail->article_id = $article->id;
                $thumbnail->article_type = 'post';
                $thumbnail->save();
            }
        }

        return response()->json([
            "message" => "Article submitted!",
            "aid" => $article->id
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        if ($article->user_id != Auth::id()) {
            return back();
        }else{
            return view('admin.layouts.articles.show', compact('article'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        
        $this->validate(request(),[
            "title" => "required",
            "body" => "required",
            "tags" => "required"
        ]);

        $article->title = $request->title;
        $article->body = $request->body;
        $article->status = $request->status;
        $article->save();

        //syncing tags
        $article->tags()->sync($request->tags);  


        //compressing images
        if(count($request->thumbnails) != 0){

            foreach($request->thumbnails as $thumbnail){

                $image_blur = 'blur-'.time().'.' . explode('/', explode(':', substr($thumbnail, 0, strpos($thumbnail, ';')))[1])[1];
                \Image::make($thumbnail)->blur(50)->resize(250, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('images/').$image_blur);

                $image_small = 'small-'.time().'.' . explode('/', explode(':', substr($thumbnail, 0, strpos($thumbnail, ';')))[1])[1];
                \Image::make($thumbnail)->resize(250, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('images/').$image_small);

                $image_medium = 'medium-'.time().'.' . explode('/', explode(':', substr($thumbnail, 0, strpos($thumbnail, ';')))[1])[1];
                \Image::make($thumbnail)->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('images/').$image_medium);

                $image_large = 'large-'.time().'.' . explode('/', explode(':', substr($thumbnail, 0, strpos($thumbnail, ';')))[1])[1];
                \Image::make($thumbnail)->resize(720, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('images/').$image_large);


                $thumbnail = new Thumbnail();

                $thumbnail->blur = $image_blur;
                $thumbnail->small = $image_small;
                $thumbnail->medium = $image_medium;
                $thumbnail->large = $image_large;
                $thumbnail->article_id = $article->id;
                $thumbnail->article_type = 'post';
                $thumbnail->save();
            }
        }

        return response()->json([
            "message" => "Article updated!"
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect('/articles');
    }

 

    public function myArticles()
    {
        $articles = AdminAllArticles::collection(Article::where('user_id', auth()->id())->latest()->paginate(15));
        return view('admin.layouts.articles.myarticles', compact('articles'));
    }

}
