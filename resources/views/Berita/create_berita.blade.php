<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <div class="max-w-xl">

                    <div class="mt-6 space-y-6">
                        <div>
                                <x-input-label for="image" :value="__('Gambar')" />
    <input type="file" name="image" class="block mt-1 w-full border border-solid border-black border-opacity-80">
                        </div>                               
                        <div>
                            <x-input-label for="name" :value="__('Tajuk Berita')"/>
                            <input type="text" name="name" class="block mt-1 w-full">
                        </div>
                        <div>
                            <x-input-label for="description" :value="__('Penerangan')" />
                            <textarea rows="4" class="block mt-1 w-full" name="description" :required></textarea>
                        </div>


                            <x-primary-button class="mt-4" type="submit">
                            {{ __('Submit') }}
                            </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
               
        </form>
    </div>
</x-app-layout>


