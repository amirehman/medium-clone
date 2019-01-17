
    @extends('admin.app')

    @section('content')
    
    @include('admin.templates.topnavbar')


    <div class="flex bg-grey-lighter">

            @include('admin.templates.sidebar')

        
        <div class="main-content flex-1 bg-grey-lightest mt-12 md:mt-2 pb-24 md:pb-5">

            <div class="bg-grey-lighter p-2 shadow text-xl text-grey-dark">
                <h3 class="pl-2">{{$article->title}}</h3>
            </div>
            
            <div class="app">
                <single-article aid="{{$article->id}}"></single-article>
            </div>

        </div>

    </div>




