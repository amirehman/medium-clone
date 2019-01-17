
    @extends('admin.app')

    @section('content')
    <!--Nav-->
    @include('admin.templates.topnavbar')


    <div class="flex bg-grey-lighter">

            @include('admin.templates.sidebar')

        
        <div class="main-content flex-1 bg-grey-lightest mt-12 md:mt-2 pb-24 md:pb-5">

            <div class="bg-grey-lighter p-2 shadow text-xl text-grey-dark">
                <h3 class="pl-2">All Articles</h3>
            </div>

               <div class="table w-full p-4">
                   <div class="table-row bg-grey-lighter p-5">
                       <div class="table-cell border p-3 font-semibold">#</div>
                       <div class="table-cell border p-3 font-semibold">Title</div>
                       <div class="table-cell border p-3 font-semibold">Status</div>
                       <div class="table-cell border p-3 font-semibold">Action</div>
                   </div>
                   @foreach ($articles as $article)
                   <div class="table-row p-5">
                       <div class="table-cell border p-3">#</div>
                       <div class="table-cell border p-3">{{$article->title}}</div>
                       <div class="table-cell border p-3 text-center">
                           @if ($article->status == 1)
                           <i class="inline-block bg-green w-3 rounded-full h-3"></i>
                           @else
                            <i class="inline-block bg-red w-3 rounded-full h-3"></i>
                           @endif
                       </div>
                       <div class="table-cell border p-3">
                           <a href="/manage/articles/{{$article->id}}" class="text-sm border px-3 p-1 no-underline text-blue-dark rounded"> Edit / View</a>
                       </div>
                   </div>
                   @endforeach
               </div>

               @if ($articles->hasPages())                  
               <ul class="flex list-reset  mx-auto w-1/6 inline-block m-4">
                @if($articles->previousPageUrl())
                <li><a class="mx-auto block border border-grey-light hover:text-white hover:bg-grey-darker no-underline text-grey-darker no-underline  border-r-0  px-3 py-2" href="{{$articles->previousPageUrl()}}">Previous</a></li>
                @else
                <li><a disabled class="mx-auto border border-grey-light block no-underline text-grey-darker no-underline  border-r-0 px-3 py-2">Previous</a></li>
                @endif                
                @if($articles->nextPageUrl())
                <li><a class="mx-auto block border border-grey-light hover:text-white hover:bg-grey-darker no-underline text-grey-darker no-underline px-3 py-2" href="{{$articles->nextPageUrl()}}">Next</a></li>
                @else
                <li><a class="mx-auto block border border-grey-light no-underline text-grey-darker no-underline px-3 py-2" >Next </a></li>
                @endif                
              </ul>
              @endif  
        </div>

    </div>




