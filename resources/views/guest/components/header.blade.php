<div class="header-wrapper bg-white">
    <nav class="container px-0 mx-auto flex items-center justify-between flex-wrap bg-white py-6">
        <div class="flex items-center flex-no-shrink text-white mr-6">
            <a href="/" class="font-semibold no-underline text-xl text-black tracking-tight">Medium Clone {{ $slot }}</a>
        </div>
        <!--header-wrapper-left-->

        <div class="w-full block mt-0 flex-grow lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow">
            </div>
            <div class="float-right">
                @auth
                <a href="/manage/articles/create" class="inline-block text-xs px-4 py-2 leading-none no-underline text-teal hover:text-black mt-4 lg:mt-0">Add New Article</a>
                <a href="/manage" class="inline-block text-xs px-4 py-2 leading-none border no-underline rounded text-teal border-teal hover:text-white hover:bg-teal-dark mt-4 lg:mt-0">Dashboard</a>
            @endauth
                @guest
                    <a href="/login" class="inline-block text-xs px-4 py-2 leading-none no-underline text-teal hover:text-black mt-4 lg:mt-0">Become a member</a>
                    <a href="/register" class="inline-block text-xs px-4 py-2 leading-none border no-underline rounded text-teal border-teal hover:text-black hover:bg-grey-lighter mt-4 lg:mt-0">Get Started</a>
                @endguest
            </div>
        </div>
        <!--header-nav-right-->
    </nav>
    <!--header-nav-->
</div>
<!--header-wrapper-->