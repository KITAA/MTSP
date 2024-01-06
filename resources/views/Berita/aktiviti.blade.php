<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Aktiviti') }}
        </h2>
        <p class="mt-2">{{ __('Jadual Program & Aktiviti yang dijalankan oleh Masjid Taman Sri Pulai') }}</p>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success>
            <p class="text-center">{{ session('success') }}</p>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Search Box -->
            <div class="mt-4">
                <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-md"
                    placeholder="Cari program">
            </div>
            
            <!-- Buttons for Admins -->
            @auth
                <x-primary-button class="mt-8">
                    <a href="{{ route('berita.createAktiviti') }}">{{ __('Tambah Aktiviti') }}</a>
                </x-primary-button>
            @endauth
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <!-- Try Try -->
                {{-- <h3 class="mt-8 text-lg font-medium text-gray-900">
                    {{ __('Semua Aktiviti') }}
                </h3>
                <div class="mt-4">
                    <ul class="divide-y divide-gray-200">
                        @foreach ($aktivitis as $aktiviti)
                            @include('Berita.aktiviti_list', ['aktiviti' => $aktiviti])
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
                            @include('Berita.aktiviti_list', ['aktiviti' => $aktiviti])
                        @empty
                            <p>{{ __('Tiada aktiviti akan datang.') }}</p>
                        @endforelse
                    </ul>
                </div>

                <!-- Latest/Past Events -->
                <h3 class="mt-8 text-lg font-medium text-gray-900">
                    {{ __('Latest/Past Events') }}
                </h3>
                <div class="mt-4">
                    <ul class="divide-y divide-gray-200">
                        @foreach ($pastAktivitis as $aktiviti)
                            @include('Berita.aktiviti_list', ['aktiviti' => $aktiviti])
                        @endforeach
                    </ul>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
