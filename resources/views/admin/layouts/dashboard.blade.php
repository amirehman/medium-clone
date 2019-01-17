
    @extends('admin.app')

    @section('content')

        @include('admin.templates.topnavbar')



    <div class="flex bg-grey-lighter">

        @include('admin.templates.sidebar')


        <div class="main-content flex-1 bg-grey-lightest mt-12 md:mt-2 pb-24 md:pb-5">

            <div class="bg-grey-lighter p-2 shadow text-xl text-grey-dark">
                <h3 class="pl-2">Dashboard</h3>
            </div>

            <div class="flex flex-wrap">

                <div class="w-full md:w-1/2 xl:w-1/5 p-3">
                    <div class="bg-grey-lightest border-b-4 border-teal-dark border p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-1 text-center">
                                <h5 class="uppercase text-grey-dark">Total Articles</h5>
                                <h3 class="text-3xl">{{$articles->count()}} <span class="text-green"></span></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-1/2 xl:w-1/5 p-3">
                    <div class="bg-grey-lightest border-b-4 border-orange-dark border p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-1 text-center">
                                <h5 class="uppercase text-grey-dark"> My Articles</h5>
                                <h3 class="text-3xl">{{$myarticles->count()}} <span class="text-green"></span></h3>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="w-full md:w-1/2 xl:w-1/5 p-3">
                    <div class="bg-grey-lightest border-b-4 border-red-dark border p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-1 text-center">
                                <h5 class="uppercase text-grey-dark">Total Tags</h5>
                                <h3 class="text-3xl">{{$tags->count()}} <span class="text-green"></span></h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




