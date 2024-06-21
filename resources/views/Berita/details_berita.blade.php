z<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Berita Umum') }}
        </h2>
    </x-slot>



    <div class="flex flex-1 justify-center min-h-screen py-12">


        <div class="w-1/2 sm:px-6 lg:px-8 bg-white shadow  p-4 sm:p-8">
            <div class="flex flex-col  overflow-hidden break-words  p-4 sm:p-8">
                    <img src="{{ asset('images/' . $berita->image) }}" alt="" class="">
                    <h2 class="text-4xl font-light text-blue-900 mt-4">
                        {{ $berita->name }}
                    </h2>
                    <p class="mt-12">
                        {!! $berita->description !!}
                    </p>

            </div>

            <div class="flex justify-between">
                <!-- Previous button -->
                <a href="{{ $previousBerita ? route('details.berita', $previousBerita->id) : '#' }}"
                    class="text-left @if (!$previousBerita) opacity-50 cursor-not-allowed @endif hover:text-gray-600"
                    @if (!$previousBerita) disabled @endif>
                    <div class="">
                        <p class="font-semibold text-base text-gray-800 leading-tight">
                            {{ __('<- Previous') }}
                        </p>
                    </div>
                </a>

                <!-- Next button -->
                <a href="{{ $nextBerita ? route('details.berita', $nextBerita->id) : '#' }}"
                    class="{{ !$nextBerita ? 'opacity-50 cursor-not-allowed' : '' }} text-right"
                    @if (!$nextBerita) disabled @endif>
                    <div class="">
                        <p class="font-semibold text-base text-gray-800 leading-tight">
                            {{ __('Next ->') }}
                        </p>
                    </div>
                </a>
            </div>


        </div>







        <div class="flex flex-col">
            <div class="w-full px-4 mb-4">
                <div class=" p-7 sm:p-8 bg-white shadow border ">

                    <form method="get" action="{{ route('search.berita') }}">
                        <div class="flex items-center justify-center">
                            <input type="search" name="query" placeholder="Search...                "
                                class="w-full border border-solid border-gray-300 rounded-md py-2 px-3"
                                value="{{ $search_text ?? '' }}">

                            <button type="submit" class=" ml-2 bg-blue-500 text-white py-2 px-4 rounded-md">

                                Search

                            </button>

                        </div>
                    </form>

                </div>
            </div>


            <div class="w-full px-4 mb-4">
                <div class=" p-7 sm:p-8 bg-white shadow border ">

                    <form method="get" action="{{ route('search.berita') }}">
                        <div class="flex items-center ">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('Kategori') }}
                            </h2>
                        </div>
                        <a href="{{ route('berita umum')}}">
                            <p class="mt-6 text-sm text-gray-600 hover:text-gray-800">
                                {{ __('Berita Umum') }}
                            </p>
                        </a>

                        <a href="{{ route('aktiviti.index')}}">
                            <p class="mt-6 text-sm text-gray-600 hover:text-gray-800">
                                {{ __('Aktiviti Masjid') }}
                            </p>
                        </a>
                    </form>

                </div>
            </div>




        </div>

    </div>
</x-app-layout>
