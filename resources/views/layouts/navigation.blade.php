<nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 bg-indigo-800">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
        <a href="{{route('home')}}" class="flex items-center text-white">
            <svg class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z" />
            </svg>
            <span class="self-center text-xl font-semibold whitespace-nowrap text-white">{{env('APP_NAME')}}</span>
        </a>

        <!-- Hamburger Button -->
        <button type="button" class="inline-flex items-center p-2 ml-3 text-white rounded-lg md:hidden hover:bg-indigo-700 focus:outline-none focus:ring-2" aria-controls="mobile-menu" aria-expanded="false" id="nav-button">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>

        <!-- Navbar links -->
        <div class="hidden w-full md:block md:w-auto" id="nav-menu">
            <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-md">
                <li>
                    <x-general.nav.link :href="route('home')" :active="request()->routeIs('home')">
                        {{__('Home')}}
                    </x-general.nav.link>
                </li>
                <li>
                    <x-general.nav.link :href="route('home')">
                        {{__('About')}}
                    </x-general.nav.link>
                </li>
                <li>
                    <x-general.nav.link :href="route('home')">
                        {{__('Services')}}
                    </x-general.nav.link>
                </li>
                <li>
                    <x-general.nav.link :href="route('home')">
                        {{__('Pricing')}}
                    </x-general.nav.link>
                </li>
            </ul>
        </div>
    </div>
</nav>
