<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Aktiviti') }}
                </h2>
                <p class="mt-2">{{ __('Jadual Program & Aktiviti yang dijalankan oleh Masjid Taman Sri Pulai') }}</p>
            </div>
            

            <!-- Add Aktiviti Button for Admins -->
            @can('admin')
                <a href="{{ route('aktiviti.create') }}" class="text-green-500">
                    <x-primary-button>
                        {{ __('Tambah Aktiviti') }}
                    </x-primary-button>
                </a>
            @endcan
        </div>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success">
            <p class="text-center">{{ session('success') }}</p>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Search Box -->
            {{-- <div class="mt-4 flex items-center">
                <form action="{{ route('aktiviti.search') }}" method="GET">
                    <input type="text" name="search" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Cari program">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">{{ __('Cari') }}</button>
                </form>
            </div> --}}
            
            <div class="mb-3">
                <form action="{{ route('aktiviti.search') }}" method="GET">
                    <div class="relative mb-4 flex w-full flex-wrap items-stretch">
                        <input
                            type="search"
                            class="relative m-0 block min-w-0 flex-auto rounded-l border border-solid
                                border-gray-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6]
                                text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary
                                focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none
                                dark:border-neutral-600
                                dark:text-neutral-200
                                dark:placeholder:text-neutral-200 dark:focus:border-primary"
                            placeholder="Search"
                            aria-label="Search"
                            aria-describedby="button-addon3"
                        />
                        
                        <!-- Search button -->
                        <button
                            class="relative z-[2] rounded-r border-2 border-primary px-6 py-2 text-xs font-medium uppercase
                            bg-blue-500
                            text-white bg-primary transition duration-150 ease-in-out 
                            hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0"
                            type="submit"
                            id="button-addon3"
                            data-te-ripple-init
                        >
                            Search
                        </button>
                    </div>
                </form>
            </div>
            
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <!-- Try Try -->
                {{-- <h3 class="mt-8 text-lg font-medium text-gray-900">
                    {{ __('Semua Aktiviti') }}
                </h3>
                <div class="mt-4">
                    <ul class="divide-y divide-gray-200">
                        @foreach ($aktivitis as $aktiviti)
                            @include('Berita.Aktiviti.aktiviti_list', ['aktiviti' => $aktiviti])
                        @endforeach
                    </ul>
                </div> --}}

                <!-- Upcoming Events -->
                <h3 class="mt-8 text-lg font-medium text-gray-900">
                    {{ __('Upcoming Events') }}
                </h3>
                <div class="mt-4">
                    <ul class="divide-y divide-gray-200">
                        @forelse ($upcomingAktivitis as $aktiviti)
                            @include('Berita.Aktiviti.aktiviti_list', ['aktiviti' => $aktiviti])
                        @empty
                            <p>{{ __('Tiada aktiviti akan datang.') }}</p>
                        @endforelse
                    </ul>
                </div>

                <!-- Latest Past Events -->
                <h3 class="mt-8 text-lg font-medium text-gray-900">
                    {{ __('Latest Past Events') }}
                </h3>
                @can('admin')
                    <div class="mt-4">
                        <ul class="divide-y divide-gray-200">
                            @foreach ($pastAktivitis as $aktiviti)
                                @include('Berita.Aktiviti.aktiviti_list', ['aktiviti' => $aktiviti])
                            @endforeach
                        </ul>
                    </div>
                @else <!-- Non-admin users -->
                    <div class="mt-4">
                        <ul class="divide-y divide-gray-200">
                            @foreach ($latestAktivitis as $aktiviti)
                                @include('Berita.Aktiviti.aktiviti_list', ['aktiviti' => $aktiviti])
                            @endforeach
                        </ul>
                    </div>
                @endcan

            </div>

        </div>
    </div>
</x-app-layout>
