<nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 bg-indigo-800">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
        <a href="{{route('home')}}" class="flex items-center text-white">
            <svg class="h-8 w-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            <span class="self-center text-xl font-semibold whitespace-nowrap text-white">{{env('APP_NAME')}}</span>
        </a>

        <!-- Hamburger Button -->
        <button type="button" class="inline-flex items-center p-2 ml-3 text-white rounded-lg md:hidden hover:bg-indigo-700 focus:outline-none focus:ring-2" aria-controls="mobile-menu" aria-expanded="false" id="nav-button">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" id="nav-hamburger">
                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg>
            <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" id="nav-close">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>

        <!-- Navbar links -->
        <div class="hidden w-full md:block md:w-auto" id="nav-menu">
            <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-md">
                <li>
                    <x-general.nav.link :href="route('home')" :active="request()->routeIs('home')">
                        {{__('Home')}}
                    </x-general.nav.link>
                </li>
                @auth
                    <li>
                        <x-general.nav.link :href="route('doctors.schedules.all')" :active="request()->routeIs('doctors.schedules.all')">
                            {{__('Schedules')}}
                        </x-general.nav.link>
                    </li>
                    <li>
                        <x-general.nav.link :href="route('appointments.index')" :active="request()->routeIs('appointments.*')">
                            {{__('Appointments')}}
                        </x-general.nav.link>
                    </li>
                    <li>
                        <x-general.nav.link :href="route('home')">
                            {{__('View Profile')}}
                        </x-general.nav.link>
                    </li>
                    <li>
                        <x-general.nav.link :href="route('profile.edit')">
                            {{__('Edit Profile')}}
                        </x-general.nav.link>
                    </li>
                    <li>
                        <x-general.nav.link :href="route('logout')">
                            {{__('Logout')}}
                        </x-general.nav.link>
                    </li>
                @else
                    <li>
                        <x-general.nav.link :href="route('login')" :active="request()->routeIs('login')">
                            {{__('Login')}}
                        </x-general.nav.link>
                    </li>
                    <li>
                        <x-general.nav.link :href="route('patients.create')" :active="request()->routeIs('patients.create')">
                            {{__('Register')}}
                        </x-general.nav.link>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
