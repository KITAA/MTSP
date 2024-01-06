<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Aktiviti') }}
        </h2>
        <p class="mt-2">{{ __('Aktiviti yang dijalankan oleh Masjid Taman Sri Pulai') }}</p>
    </x-slot>

    <div class="py-12">
        <form action="{{ route('berita.storeAktiviti') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Maklumat Aktiviti') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Sila masukkan maklumat aktiviti') }}
                        </p>

                        <div class="mt-6 space-y-6">

                            <div>
                                <x-input-label for="tajuk_aktiviti" :value="__('Tajuk')" />
                                <x-text-input id="tajuk_aktiviti" class="block mt-1 w-full" type="text"
                                    name="tajuk_aktiviti" required/>
                                <x-input-error class="mt-2" :messages="$errors->get('tajuk_aktiviti')" />
                            </div>

                            {{-- <div class="mb-4">
                                <label for="tajuk_aktiviti" class="block font-medium text-gray-700">Tajuk</label>
                                <input type="text" name="tajuk_aktiviti" id="tajuk_aktiviti" class="form-input mt-1 block w-full"
                                    required autofocus>
                            </div> --}}

                            <div>
                                <x-input-label for="gambar_aktiviti" :value="__('Gambar')" />
                                <input type="file" name="gambar_aktiviti" id="gambar_aktiviti"
                                    class="form-input mt-1 block w-full" required>
                                <x-input-error class="mt-2" :messages="$errors->get('gambar_aktiviti')" />
                            </div>

                            {{-- <div class="mb-4">
                                <label for="gambar_aktiviti" class="block font-medium text-gray-700">Gambar</label>
                                <input type="file" name="gambar_aktiviti" id="gambar_aktiviti" class="form-input mt-1 block w-full"
                                    required>
                            </div> --}}

                            <div class="flex flex-wrap -mx-4 mb-4">
                                <div class="w-full md:w-1/2 px-4 mb-4 md:mb-0">
                                    <x-input-label for="tarikh_aktiviti" :value="__('Tarikh')" />
                                    <input id="tarikh_aktiviti" class="form-input mt-1 block w-full" type="date"
                                        name="tarikh_aktiviti" required />
                                </div>
                                <div class="w-full md:w-1/2 px-4">
                                    <x-input-label for="masa_aktiviti" :value="__('Masa')" />
                                    <input id="masa_aktiviti" class="form-input mt-1 block w-full" type="time"
                                        name="masa_aktiviti" required />
                                </div>
                            </div>

                            {{-- <div class="mb-4">
                                <label for="tempat_aktiviti" class="block font-medium text-gray-700">Tempat</label>
                                <input type="text" name="tempat_aktiviti" id="tempat_aktiviti"
                                    class="form-input mt-1 block w-full" required>
                            </div>

                            <div class="mb-4">
                                <label for="deskripsi_aktiviti"
                                    class="block font-medium text-gray-700">Penerangan</label>
                                <textarea name="deskripsi_aktiviti" id="deskripsi_aktiviti" rows="4" class="form-textarea mt-1 block w-full"
                                    required></textarea>
                            </div> --}}

                            <div class="mb-4">
                                <x-input-label for="tempat_aktiviti" :value="__('Tempat')" />
                                <x-text-input id="tempat_aktiviti" class="block mt-1 w-full" type="text"
                                    name="tempat_aktiviti" required />
                            </div>
    
                            <div class="mb-4">
                                <x-input-label for="deskripsi_aktiviti" :value="__('Penerangan')" />
                                <textarea name="deskripsi_aktiviti" id="deskripsi_aktiviti" class="form-input mt-1 block w-full" rows="5"
                                    required></textarea>
                            </div>

                        </div>
                    </div>
                </div>

                <x-primary-button class="mt-4" type="submit">
                    {{ __('Tambah Aktiviti') }}
                </x-primary-button>
                <x-secondary-button class="mt-8">
                    <a href="{{ route('berita.aktiviti') }}">{{ __('Kembali') }}</a>
                </x-secondary-button>

            </div>
        </form>
    </div>
</x-app-layout>
