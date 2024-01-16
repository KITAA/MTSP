<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(Route::currentRouteName() == 'aktiviti.create')
                {{ __('Aktiviti') }}
            @elseif(Route::currentRouteName() == 'aktiviti.edit')
                {{ __('Edit Aktiviti') }}
            @endif
        </h2>
        <p class="mt-2">{{ __('Aktiviti yang dijalankan oleh Masjid Taman Sri Pulai') }}</p>
    </x-slot>

    <div class="py-12">
    @if (Route::currentRouteName() == 'aktiviti.create')
        <form action="{{ route('aktiviti.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
    @elseif (Route::currentRouteName() == 'aktiviti.edit')
        <form action="{{ route('aktiviti.update', $aktiviti->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    @endif
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
                                    name="tajuk_aktiviti"
                                    :value="old('tajuk_aktiviti') ?? ($aktiviti->tajuk_aktiviti ?? '')"
                                    required/>
                                <x-input-error class="mt-2" :messages="$errors->get('tajuk_aktiviti')" />
                            </div>

                            <div>
                                <x-input-label for="gambar_aktiviti" :value="__('Gambar')" />
                                <input id="gambar_aktiviti" class="form-input mt-1 block w-full" type="file"
                                    name="gambar_aktiviti" required>
                                <x-input-error class="mt-2" :messages="$errors->get('gambar_aktiviti')" />
                            </div>
                            
                            <div>
                                <x-input-label for="tarikh_aktiviti" :value="__('Tarikh')" />
                                <x-text-input id="tarikh_aktiviti" class="form-input mt-1 block w-full" type="date"
                                    name="tarikh_aktiviti"
                                    :value="old('tarikh_aktiviti') ?? ($aktiviti->tarikh_aktiviti->format('Y-m-d') ?? '')"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('tarikh_aktiviti')" />
                            </div>

                            <div class="flex flex-wrap -mx-4 mb-4">
                                <div class="w-full md:w-1/2 px-4 mb-4 md:mb-0">
                                    <x-input-label for="masa_mula" :value="__('Masa Mula')" />
                                    <x-text-input id="masa_mula" class="form-input mt-1 block w-full" type="time"
                                        name="masa_mula"
                                        :value="old('masa_mula') ?? ($aktiviti->masa_mula ?? '')"
                                        required />
                                    <x-input-error class="mt-2" :messages="$errors->get('masa_mula')" />
                                </div>
                                <div class="w-full md:w-1/2 px-4">
                                    <x-input-label for="masa_tamat" :value="__('Masa Tamat')" />
                                    <x-text-input id="masa_tamat" class="form-input mt-1 block w-full" type="time"
                                        name="masa_tamat"
                                        :value="old('masa_tamat') ?? ($aktiviti->masa_tamat ?? '')"
                                        required />
                                    <x-input-error class="mt-2" :messages="$errors->get('masa_tamat')" />
                                </div>
                            </div>

                            <div class="mb-4">
                                <x-input-label for="tempat_aktiviti" :value="__('Tempat')" />
                                <x-text-input id="tempat_aktiviti" class="block mt-1 w-full" type="text"
                                    name="tempat_aktiviti"
                                    :value="old('tempat_aktiviti') ?? ($aktiviti->tempat_aktiviti ?? '')"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('tempat_aktiviti')" />
                            </div>
    
                            <div class="mb-4">
                                <x-input-label for="deskripsi_aktiviti" :value="__('Penerangan')" />
                                <textarea id="deskripsi_aktiviti" class="form-input mt-1 block w-full" rows="5"
                                    name="deskripsi_aktiviti"
                                    required>{{ old('deskripsi_aktiviti') ?? ($aktiviti->deskripsi_aktiviti ?? '') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('deskripsi_aktiviti')" />
                            </div>

                        </div>
                    </div>
                </div>

                <x-primary-button class="mt-4" type="submit">
                    @if (Route::currentRouteName() == 'aktiviti.create')
                        {{ __('Tambah Aktiviti') }}
                    
                    @elseif (Route::currentRouteName() == 'aktiviti.edit')
                        {{ __('Update Aktiviti') }}
                    @endif
                </x-primary-button>

                <x-secondary-button class="mt-8">
                    <a href="{{ route('aktiviti.index') }}">{{ __('Kembali') }}</a>
                </x-secondary-button>

            </div>
        </form>
    </div>
</x-app-layout>
