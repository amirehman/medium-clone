<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use App\Article;
use App\Http\Resources\SingeArticleRecource;

class GuestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('guest.layouts.home');
    }

    public function singlePost ($user, $article) {

        $user =  preg_replace('/[^A-Za-z0-9\-]/', '', $user);

        $user = User::where('username', $user)->first();

        if($user){
            if($user->articles->where('slug', $article)->count() != 0){

                $article = new SingeArticleRecource($user->articles->where('slug', $article)->first());
                return view('guest.layouts.single', compact('article'));

            }else{

                return view('guest.layouts.noarticles', compact('user'));

            }
        }else{
            return redirect('/');
        }



    }

}
