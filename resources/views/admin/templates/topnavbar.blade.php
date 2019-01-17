<nav class="flex items-center justify-between flex-wrap bg-grey-dark p-4">
        <div class="flex items-center flex-no-shrink text-white mr-6">
            <span class="text-xl ">Admin Panel</span>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow">
            </div>
            <div>
                <a href="/" class="block lg:inline-block no-underline text-white text-sm mr-4">
                    Visit Site
                </a>
                <span class="block lg:inline-block no-underline text-white text-sm mr-4">
                    {{Auth::user()->name}}
                </span>
                <a href="/logout" class="inline-block text-sm leading-none text-white border-white no-underline">Logout</a>
            </div>
        </div>
    </nav>