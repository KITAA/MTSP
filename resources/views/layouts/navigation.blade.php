<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 h-58">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    @if (Route::has('login'))
    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
    @auth
    <div id="notification-icon" class="cursor-pointer">
        <x-zondicon-notification class="w-6 h-6 text-gray-600 hover:text-blue-900 dark:text-black dark:hover:text-gray-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" />
    </div>
    @if(auth()->user()->unreadNotifications->count() > 0)
        <div class="absolute top-5 right-3 bg-red-500 text-white rounded-full px-2 text-xs font-bold">{{ auth()->user()->unreadNotifications->count() }}</div>
    @endif
    <div id="notification-container" class="hidden fixed top-15 right-5 pr-6 pb-6 pl-6 text-gray-900 bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-lg">
        @if(auth()->user()->notifications->count() > 0)
        @foreach(auth()->user()->notifications as $notification)
            <div class="py-4 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                <div class="flex items-center">
                    <div>
                        <p class="text-lg font-semibold text-left">{{ $notification->data['title'] }}</p>
                        <p class="text-gray-600 font-medium text-left">{{ $notification->data['name'] }}</p>
                        <p class="text-gray-600 text-left">{{ $notification->data['data'] }}</p>
                        <p class="text-gray-600 text-left font-extralight">{{ $notification->data['created'] }}</p>
                    </div>
                    <div>
                        <a href="{{ route('removeNotif', $notification->id) }}">
                            <x-bi-x class="w-6 h-6 text-end ml-5 text-gray-600 hover:text-red-600" />
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        @else
        <div class="py-4 border-b border-gray-200 dark:border-gray-700 last:border-b-0">Tiada notifikasi</div>
        @endif

    </div>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-black dark:hover:text-gray-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-black dark:hover:text-gray-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col justify-center items-center"> 
            <!-- Logo and Title -->
            <div class="flex items-center justify-center">
                <!-- Logo -->
                <div class="shrink-0">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('img/MTSP.png') }}" class="block w-28 h-auto pt-4 mb-4" /> 
                    </a>
                </div>

                <!-- Title -->
                <div class="ml-2 font-bold text-xl drop-shadow-lg pt-6">
                    MASJID TAMAN SRI PULAI
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:flex sm: justify-center sm:items-center pb-3"> 
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{ __('Utama') }}
                </x-nav-link>

                <!-- Dropdown for Informasi -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="left">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ __('Informasi') }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('visi misi')">
                                {{ __('Visi dan Misi') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('carta organisasi')">
                                {{ __('Carta Organisasi') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="left">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ __('Berita Masjid') }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('berita umum')">
                                {{ __('Berita umum') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('aktiviti.index')">
                                {{ __('Aktiviti') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>

                <x-nav-link :href="route('infaq.derma')" :active="request()->routeIs('infaq.derma')">
                    {{ __('Infaq') }}
                </x-nav-link>

                <!-- Dropdown for E-Khairat -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="left">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 ">
                                <div>{{ __('E-Khairat') }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('membership.index')">
                                {{ __('Keahlian') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('membership.latarBelakang')">
                                {{ __('Latar Belakang') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('membership.polisi')">
                                {{ __('Polisi dan Prosedur') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>

                <x-nav-link :href="route('hubungi.kami')">
                    {{ __('Hubungi Kami') }}
                </x-nav-link>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    @auth
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                        @php
                            $nameParts = explode(' ', Auth::user()->name);
                            $firstName = $nameParts[0];
                        @endphp
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ $firstName }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                    @endauth
                </div>
            </div>


            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#notification-icon").click(function () {
                $("#notification-container").toggle();
            });

            $(document).on("click", function (event) {
                if (!$(event.target).closest("#notification-icon, #notification-container").length) {
                    $("#notification-container").hide();
                }
            });
        });
    </script>

</nav>