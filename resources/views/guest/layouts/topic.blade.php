@extends('guest.app')

@section('content')
        <div class="app">

    <div class="site-wrapper sm:px-5 ">



        @component('guest.components.header')
            <span class="text-grey font-normal text-lg">| {{$tag->name}}</span>
        @endcomponent

        <top-navbar></top-navbar>

        <section class="latest-articles mt-10">
            <latest-articles header="{{$tag->name}}" page="topic" tag="{{$tag->slug}}"></latest-articles>
        </section>
        <!--latest-articles-->






    </div>
    <!--site-wrapper-->

</div>
@endsection
