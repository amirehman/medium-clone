
@extends('guest.app')

@section('content')
        

    <div class="site-wrapper single-article">

        @component('guest.components.header')
        @endcomponent

        <top-navbar></top-navbar>




        <section class="single-article mt-10">
            <div class="container mx-auto">

            <h1 class="text-lg font-normal"> <b>{{$user->name}}</b> does not have any articles!</h1>

            </div>
            <!--container-->
        </section>
        <!--single-article-->






    </div>
    <!--site-wrapper-->

        @endsection

