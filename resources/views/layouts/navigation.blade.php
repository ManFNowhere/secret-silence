<nav class="z-50 relative">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/logo.jpeg') }}" class="h-8" alt="Secret Silence Logo" />
        </a>
        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 ">
                <li>
                    <a href="{{ route('released.index') }}" class="block py-2 px-3 {{ request()->routeIs('released.*') ? 'text-primary' : 'text-white' }} rounded-sm hover:text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-primary md:p-0">Released</a>
                </li>
                <li>
                    <a href="{{ route('tools.index') }}" class="block py-2 px-3 {{ request()->routeIs('tools.*') ? 'text-primary' : 'text-white' }} rounded-sm hover:text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-primary md:p-0">Tools</a>
                </li>
                <li>
                    <a href="{{ route('about') }}" class="block py-2 px-3 {{ request()->routeIs('about') ? 'text-primary' : 'text-white' }} rounded-sm hover:text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-primary md:p-0">About</a>
                </li>
                @if (auth()->check())
                    <li>
                        <a href="{{ route('users.index') }}" class="block py-2 px-3 {{ request()->routeIs('users.*') ? 'text-primary' : 'text-white' }} rounded-sm hover:text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-primary md:p-0">Users</a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" class="inline bg-red-500 p-2 text-white rounded-sm my-4" method="post">
                            @csrf
                            <button type="submit" >Logout</button>
                        </form>
                    </li>

                @endif
            </ul>
        </div>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleBtn = document.querySelector('[data-collapse-toggle="navbar-default"]');
        const navMenu = document.getElementById("navbar-default");

        toggleBtn.addEventListener("click", () => {
            navMenu.classList.toggle("hidden");
        });
    });
</script>
