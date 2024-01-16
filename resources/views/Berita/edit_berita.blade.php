<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ubah Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <form action="{{ route('update.berita', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                    <div class="max-w-xl">

                        <div class="mt-6 space-y-6">

                        <div>
                        <x-input-label for="image" :value="__('Gambar')" />
                            <img src="{{ asset('/images/' . $berita->image) }}" alt="">
                            <input type="file" name="image" class="block mt-1 w-full form-control">
                        </div>
                        <div>
                            <x-input-label for="name" :value="__('Tajuk Berita')" />
                            <input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$berita->name}}">
                        </div>
                        <div>
                            <x-input-label for="description" :value="__('Penerangan')" />
                            <textarea id="description" rows="4" class="block mt-1 w-full" name="description">{{ $berita->description }}</textarea>
                        </div>
                        <x-primary-button class="mt-4" type="submit">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
