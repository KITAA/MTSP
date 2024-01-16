<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Berita Umum') }}
            </h2>
            @if (Auth::check())
                @if (Auth::user()->usertype == 'admin')
                    <a href="{{ route('create.berita') }}" class="text-green-500">
                        <x-primary-button>
                            {{ __('Create new Berita') }}
                        </x-primary-button>
                    </a>
                @endif
            @endif
        </div>
    </x-slot>

    <style>
        .berita-content {

            padding: 1rem;



        }

        .berita-description {

            margin-bottom: 0rem;
            padding-top: 4rem;
            padding-bottom: 1rem;
        }
    </style>

    <div class="py-12">
        <div class="flex flex-1 justify-center">
            @if (!empty($berita))
                <div class="w-2/5 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="col-span-3">
                            <img src="{{ asset('/img/mtsp.jpg') }}" alt="" class="w-full pb-2">
                            <h2 style="font-size: 24px; font-weight: bold;">Berita Umum</h2>
                        </div>
                        @foreach ($berita as $key)
                            <div
                                class=" relative overflow-hidden break-words bg-white shadow rounded transition-transform duration-300 transform hover:shadow-2xl">

                                <p><a href="{{ route('details.berita', $key->id) }}"><img
                                            src="{{ asset('/images/' . $key->image) }}"
                                            class="object-cover w-[300px] h-[150px]" alt=""></a></p>

                                <div class="berita-content">
                                    <a href="{{ route('details.berita', $key->id) }}"
                                        class="block p-2 sm:p-4 text-xl font-bold text-blue-900 text-left">
                                        {{ $key->name }}
                                    </a>
                                    <div class="berita-description">
                                        <p class=" text-gray-600 text-sm">
                                            {!! Str::limit($key->description, 100, '...') !!}
                                        </p>

                                        @if (Auth::check() && Auth::user()->usertype == 'admin')
                                            <div class="p-2">
                                                <a href="{{ route('edit.berita', $key->id) }}" class="mr-1">
                                                    <x-secondary-button>
                                                        {{ __('Edit') }}
                                                    </x-secondary-button>
                                                </a>

                                                <a href="{{ route('delete.berita', $key->id) }}" class="m-auto">
                                                    <x-danger-button>
                                                        {{ __('Delete') }}
                                                    </x-danger-button>
                                                </a>
                                            </div>
                                        @endif


                                    </div>

                                </div>

                            
                                <div class="absolute bottom-0 left-0 right-0 p-2">
                                    <p class=" text-gray-400 text-xs text-center">
                                        {{ date('F j, Y') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <p class="p-2 text-gray-600 text-sm">
                    No berita available.
                </p>
            @endif

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
                        </form>

                    </div>
                </div>
            </div>



        </div>


    </div>

</x-app-layout>
