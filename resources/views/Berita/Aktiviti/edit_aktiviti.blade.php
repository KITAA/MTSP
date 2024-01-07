<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Aktiviti') }}
        </h2>
    </x-slot>

    @if ($errors->any())
        <div class="alert alert-danger">
            <p class="text-center font-bold">{{ __('Sila betulkan ralat berikut:') }}</p>
            <ul class="list-disc">
                @foreach ($errors->all() as $error)
                    <li class="ml-8">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="py-12">
        <form action="{{ route('aktiviti.update', $aktiviti->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">

                        <div class="mb-4">
                            <x-input-label for="tajuk_aktiviti" :value="__('Tajuk')" />
                            <x-text-input id="tajuk_aktiviti" class="block mt-1 w-full" type="text"
                                name="tajuk_aktiviti" :value="$aktiviti->tajuk_aktiviti" required autofocus />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="gambar_aktiviti" :value="__('Gambar')" />
                            <input type="file" name="gambar_aktiviti" id="gambar_aktiviti"
                                class="form-input mt-1 block w-full" :value="$aktiviti->gambar_aktiviti" required>
                            <img src="/img/aktiviti/{{ $aktiviti->gambar_aktiviti }}" alt="Poster Aktiviti"
                                class="mt-2 w-1/4">
                        </div>

                        {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="tarikh_aktiviti" :value="__('Tarikh')" />
                                <x-text-input id="tarikh_aktiviti" class="block mt-1 w-full" type="date" name="tarikh_aktiviti" :value="$aktiviti->tarikh_aktiviti" required />
                            </div>
                            <div>
                                <x-input-label for="masa_aktiviti" :value="__('Masa')" />
                                <x-text-input id="masa_aktiviti" class="block mt-1 w-full" type="time" name="masa_aktiviti" :value="$aktiviti->masa_aktiviti" required />
                            </div>
                        </div> --}}

                        <div class="flex flex-wrap -mx-4 mb-4">
                            <div class="w-full md:w-1/2 px-4 mb-4 md:mb-0">
                                <x-input-label for="tarikh_aktiviti" :value="__('Tarikh')" />
                                <input id="tarikh_aktiviti" class="form-input mt-1 block w-full" type="date"
                                    name="tarikh_aktiviti"
                                    value="{{ old('tarikh_aktiviti', $aktiviti->tarikh_aktiviti->format('Y-m-d')) }}"
                                    required />
                            </div>
                            <div class="w-full md:w-1/2 px-4">
                                <x-input-label for="masa_aktiviti" :value="__('Masa')" />
                                <input id="masa_aktiviti" class="form-input mt-1 block w-full" type="time"
                                    name="masa_aktiviti" value="{{ old('masa_aktiviti', $aktiviti->masa_aktiviti) }}"
                                    required />
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="tempat_aktiviti" :value="__('Tempat')" />
                            <x-text-input id="tempat_aktiviti" class="block mt-1 w-full" type="text"
                                name="tempat_aktiviti" :value="$aktiviti->tempat_aktiviti" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="deskripsi_aktiviti" :value="__('Penerangan')" />
                            <textarea name="deskripsi_aktiviti" id="deskripsi_aktiviti" class="form-input mt-1 block w-full" rows="5"
                                required>{{ $aktiviti->deskripsi_aktiviti }}</textarea>
                        </div>

                    </div>
                </div>

                <x-primary-button class="mt-4" type="submit">
                    {{ __('Update Aktiviti') }}
                </x-primary-button>
                <x-secondary-button class="mt-8">
                    <a href="{{ route('aktiviti.index') }}">{{ __('Kembali') }}</a>
                </x-secondary-button>

            </div>
        </form>
    </div>
</x-app-layout>
