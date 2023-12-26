<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Berita Umum') }}
        </h2>
    </x-slot>

    <style>
        .flex-container {
            display: grid;
            gap: 50px;
            max-width: 1200px; /* Set your desired max width */
            margin: 0 auto; /* Center the container */
            padding: 10px;
        }

        .flex-item {
            border: 1px solid rgba(0, 0, 0, 0.8);
            max-width: 1000px;
            margin: 0 auto;
            overflow: hidden;
            word-wrap: break-word;
        }

        .flex-container h2 {
            font-size: 30px;
        }
    </style>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex items-center justify-center">
        <div class="space-y-6">
            <div class="flex-container">
                <div class="flex-item">
                    <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 px-4 mb-4">
                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ $berita->name }}
                            </h2>
                            <p class="mt-4"><img src="{{ asset('content/img/'. $berita->image) }}" style="width: 450px;" alt=""></p>
                            <p class="mt-4">{{ $berita->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
