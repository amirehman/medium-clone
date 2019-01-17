<?php

namespace App\Http\Controllers;

use App\Thumbnail;
use App\Article;
use File;
use Illuminate\Http\Request;

class ThumbnailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            "blur" => "required",
            "small" => "required",
            "medium" => "required",
            "large" => "required",
            "article_id" => "required",
            "article_type" => "required"
        ]);

        $thumbnail = new Thumbnail;
        $thumbnail->blur = $request->blur;
        $thumbnail->small = $request->small;
        $thumbnail->medium = $request->medium;
        $thumbnail->large = $request->large;
        $thumbnail->article_id = $request->article_id;
        $thumbnail->article_type = $request->article_type;
        $thumbnail->save();

        return response()->json([
            'message' => 'Thumbnail submitted!',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thumbnail  $thumbnail
     * @return \Illuminate\Http\Response
     */
    public function show(Thumbnail $thumbnail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thumbnail  $thumbnail
     * @return \Illuminate\Http\Response
     */
    public function edit(Thumbnail $thumbnail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thumbnail  $thumbnail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thumbnail $thumbnail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thumbnail  $thumbnail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article, Thumbnail $thumbnail)
    {

        File::delete(public_path('images/'. $thumbnail->blur));
        File::delete(public_path('images/'. $thumbnail->medium));
        File::delete(public_path('images/'. $thumbnail->small));
        File::delete(public_path('images/'. $thumbnail->large));
        $thumbnail->delete();

        return response()->json([
            "message" => "Image Deleted"
        ]);
    }
}
