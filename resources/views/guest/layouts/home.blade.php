@extends('guest.app')

@section('content')
        <div class="app">

    <div class="site-wrapper sm:px-5 ">

            @component('guest.components.header')
            @endcomponent



            <top-navbar></top-navbar> 

            <section class="front-featured">
                <featured-articles></featured-articles> 
            </section>
        <!--front-featured-->
        


        <section class="latest-articles mt-10">
           <latest-articles header="Latest Articles" page="home"></latest-articles>
        </section>
        <!--latest-articles-->






    </div>
    <!--site-wrapper-->

</div>
@endsection
