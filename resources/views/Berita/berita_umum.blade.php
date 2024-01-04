<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Berita Umum') }}
            </h2>

            <a href="{{ route('create.berita') }}" class="text-green-500">
                <x-primary-button>
                    {{ __('Create new Berita') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>

    <style>

        .custom-image {
            width: 300px;
            height: 150px;

        }
    </style>

    <div class="py-12 border border-solid border-green-500 border-opacity-80">

        <div class="flex flex-1  justify-center">
            @if (!empty($berita))
                <div class="w-2/5 grid sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-4 ">
                    <div class="col-span-3">
                        <img src="{{ asset('/img/mtsp.jpg') }}" alt="" class="w-full pb-2">

                        <h2 style="font-size: 24px; font-weight: bold;">Berita Umum</h2>
                    </div>
                    @foreach ($berita as $key)
                    <div class="m-0 overflow-hidden break-words bg-white shadow rounded transition-transform duration-300 transform hover:shadow-2xl">

                            <p><img src="{{ asset('/images/' . $key->image) }}" class="custom-image" alt="">
                            </p>

                            <a href="{{ route('details.berita', $key->id) }}"
                                class="block p-2 sm:p-8 text-xl font-bold text-blue-900 ">
                                {{ $key->name }}

                            </a>

                            <p class="p-2 sm:p-8 text-gray-600">
                                {{ Str::limit($key->description, 100, '...') }}
                            </p>


                            <div class="p-2 sm:p-8">
                                <a href="{{ route('edit.berita', $key->id) }}" class="mr-1">
                                    <x-secondary-button>
                                        {{ __('Edit') }}
                                    </x-secondary-button>
                                </a>

                                <a href="{{ route('delete.berita', $key->id) }}" class="ml-1">
                                    <x-danger-button>
                                        {{ __('Delete') }}
                                    </x-danger-button>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No berita available.</p>
            @endif


            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 px-4 mb-4">
                <div class=" p-7 sm:p-8 bg-white shadow border border-solid border-black border-opacity-80">

                    <form method="get" action="{{ route('search.berita') }}">
                        <div class="flex items-center justify-center">
                            <input type="search" name="query" placeholder="Search...                "
                                class="w-full border border-solid border-gray-300 rounded-md py-2 px-3"
                                value="{{ isset($search) ? $search : '' }}">

                        </div>
                    </form>

                </div>
            </div>
        </div>



    </div>

</x-app-layout>
