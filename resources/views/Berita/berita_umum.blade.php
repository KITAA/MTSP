<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Berita Umum') }}
        </h2>
    </x-slot>

    <style>
        .flex-container {
            border: 1px solid rgba(255, 0, 0, 0.8) ;
            display: grid;
            gap: 50px;
            grid-template-columns: auto auto auto;
            max-width: 1200px; /* Set your desired max width */
            margin: 0 auto; /* Center the container */
            padding: 10px;
           
        }

        .flex-item {
           
         border: 1px solid rgba(0, 0, 0, 0.8);
            max-width: 350px;
            overflow: hidden;
            word-wrap: break-word;
            
        }
        .flex-container h2 {
            
            font-size: 30px;
        }

        .custom-image {
            width: 300px;
            height: 250px;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex items-center justify-center">
            <div class="space-y-6">
                @if (!empty($berita))
                    <div class="flex-container">
                        @foreach($berita as $key)
                        <div class = "flex-item">
                            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 px-4 mb-4">
                                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ $key->name }}
                                    </h2>
                                    <p class="mt-4"><img src="{{ asset('content/img/'. $key->image) }}" class="custom-image" alt=""></p>
                                    <p class="mt-4">{{ $key->description }}

                                    <a href="{{ route('details.berita', $key->id) }}" class="text-green-500">Lanjut</a>

                                    </p>
                                    <p>


                                        <a href="{{ route('edit.berita', $key->id) }}" class="text-green-500">
                                            <x-secondary-button>
                                                {{ __('Edit') }}
                                            </x-secondary-button>
                                        </a>

                                        <a href="{{ route('delete.berita', $key->id) }}" class="text-green-500">
                                            <x-danger-button>
                                                {{ __('Delete') }}
                                            </x-danger-button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p>No berita available.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="flex justify-center items-center">
        <a href="{{ route('create.berita') }}" class="text-green-500">
            <x-primary-button>
                {{ __('Create new Berita') }}
            </x-primary-button>
        </a>
    </div>
</x-app-layout>
