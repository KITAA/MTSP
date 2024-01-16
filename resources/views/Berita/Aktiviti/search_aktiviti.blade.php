<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Carian Aktiviti') }}
        </h2>
    </x-slot>

    <div class="container mt-8 mx-auto md:px-6 bg-white shadow-lg rounded-lg">
        <div class="max-w-7xl mx-auto my-auto sm:px-6 lg:px-8 space-y-6">

            @forelse($results as $aktiviti)
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
            @empty
                <p>No results found for '{{ $searchQuery }}'</p>
            @endforelse

        </div>
    </div>
</x-app-layout>
