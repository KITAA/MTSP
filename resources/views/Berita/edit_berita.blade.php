<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Ubah Berita') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 px-4 mb-4">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form action="{{ route('update.berita', $berita->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                  

                    <div class="mb-3">
                        <label for="beritaumum" class="form-label">Gambar</label> <br> <br>
                        <img src="{{ asset('content/img/'. $berita->image) }}" style="width: " alt="">
                        <input type="file" name="image" class="form-control" placeholder="Berita Image">
                    </div>
                    <div class="mb-3">
                        <label for="beritaumum" class="form-label">Nama Berita</label> <br> <br>
                        <input type="text" name="name" class="form-control" placeholder="Nama Berita" value="{{ $berita->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="beritaumum" class="form-label">Deskripsi</label> <br> <br>
                        <textarea class="form-control" name="description" placeholder="tulis berkenaan berita">{{ $berita->description }}</textarea>
                    </div>
                    <x-primary-button class="mt-4" type="submit">
                        {{ __('Update') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
