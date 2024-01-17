<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Aktiviti') }}
        </h2>
        <p class="mt-2">{{ __('Jadual Program & Aktiviti yang dijalankan oleh Masjid Taman Sri Pulai') }}</p>
    </x-slot>

    <div class="container mt-8 mx-auto md:px-6 bg-white shadow-lg rounded-lg">
        <div class="max-w-7xl mx-auto my-auto sm:px-6 lg:px-8 space-y-6">
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900">{{ $aktiviti->tajuk_aktiviti }}</h3>
                <p class="text-sm text-gray-500">{{ $aktiviti->tarikh_aktiviti->format('d F y') }}</p>
                <p class="text-sm text-gray-500">{{ $aktiviti->tempat_aktiviti }}</p>
                <img src="/img/aktiviti/{{ $aktiviti->gambar_aktiviti }}" alt="Poster Aktiviti">
                <p class="mt-2 text-sm text-gray-500">{{ $aktiviti->deskripsi_aktiviti }}</p>
            </div> --}}

            <section class="mb-32">
                <img src="/img/aktiviti/{{ $aktiviti->gambar_aktiviti }}"
                  class="mb-6 w-full rounded-lg shadow-lg dark:shadow-black/20" alt="Poster Aktiviti" />
            
                <div class="mb-6 flex items-center">
                    <div>
                        <span>{{ $aktiviti->tarikh_aktiviti->format('d F y') }}</span>
                    </div>
                </div>
            
                <h1 class="mb-6 text-3xl font-bold">
                    {{ $aktiviti->tajuk_aktiviti }}
                </h1>
            
                <p>
                    {{ $aktiviti->deskripsi_aktiviti }}
                </p>
            </section>
        </div>
    </div>
</x-app-layout>
