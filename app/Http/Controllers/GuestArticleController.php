<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Tag;
use App\Http\Resources\SingeArticleRecource;
use App\Http\Resources\TagsRecource;
use App\Http\Resources\GuestArticlesListRecource;

class GuestArticleController extends Controller
{
    public function getArticlesByTag($slug)
    {
        return response()->json([
            "articles" => GuestArticlesListRecource::collection(Article::with('tags')
            ->whereHas('tags', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->latest()->take(15)->get())
        ]);
        
    }    
    public function all()
    {
        return response()->json([
            "articles" => GuestArticlesListRecource::collection(Article::latest()->has('tags')->take(15)->get())
        ]);
        
    }    
    public function featured()
    {
        return response()->json([
            "articles" => GuestArticlesListRecource::collection(Article::has('tags')->get()->random(5))
        ]);
        
    }    
    public function single($article)
    {
        return response()->json([
            "article" => SingeArticleRecource::collection(Article::where('id', $article)->get())
        ]);
        
    }    
    public function tags()
    {
        return response()->json([
            "tags" => TagsRecource::collection(Tag::has('articles')->get())
        ]);        
    }    
}
