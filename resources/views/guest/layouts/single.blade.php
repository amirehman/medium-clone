
@extends('guest.app')

@section('content')
        

    <div class="site-wrapper single-article">

        @component('guest.components.header')
            <span class="text-grey font-normal text-lg">| {{$article->tags->first()->name}}</span>
        @endcomponent

        <top-navbar></top-navbar>




        <section class="single-article mt-10">
            <div class="container mx-auto">

                <div class="flex mb-4">
                    <div class="w-full lg:w-2/3 sm:w-full p-3 mx-auto">

                        <div class="single-article-title">
                            <h1 class="text-3xl font-normal font-serif">{{$article->title}}</h1>
                        </div>

                        <div class="user-info mt-8">
                            <div class="flex mb-4">
                                <div class="w-12 bg-grey h-12 rounded-full bg-cover" style="background-image: url('https://cdn-images-1.medium.com/fit/c/50/50/1*6AyRVItGpuWAKUvyJA0Wdw@2x.jpeg')">
                                </div>
                                <div class="w-48 mx-2 p-1">
                                    <div class="username"><a class="text-grey-darkest hover:underline font-semibold text-xs no-underline" href="#"> {{$article->user->name}} </a></div>
                                    <div class="info text-grey-darker font-normal mt-1 text-xs"><span>{{date('M d', strtotime($article->created_at))}}</span><span class="inline-block mx-1">-</span><span>{{$article->readtime()}} read</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="app">
                        <single-post-slider :images="{{$article->images}}"></single-post-slider>
                        </div>
                        <div class="single-article-content font-serif text-base text-grey-darkest leading-tight">

                            <p>{{$article->body}}</p>

                        </div>

                    </div>
                </div>

            </div>
            <!--container-->
        </section>
        <!--single-article-->






    </div>
    <!--site-wrapper-->

        @endsection

