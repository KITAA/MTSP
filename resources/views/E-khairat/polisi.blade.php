<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Polisi dan Prosedur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900">{{ __('PENDAHULUAN') }}</h3>
                <h3 class="text-md font-medium text-gray-800 mt-2">{{ __("1.0 Pendahuluan") }}</h3>
                <p class="mt-2 text-justify">{{ __("Tabung Khairat Kematian Masjid Taman Sri Pulai, Skudai, Johor (TKKMTSP) adalah satu tabung kebajikan yang ditubuhkan oleh Ahli Jawatan Kuasa dan Pegawai Masjid, Masjid Taman Sri Pulai (MTSP) (sebelum ini Masjid Intan Abu Bakar, Taman Sri Pulai, MIAB) pada tahun 2000. TKKMTSP diamanahkan kepada Biro Kebajikan, Sosial dan Kebudayaan, MTSP untuk diuruskan dengan lebih teratur dan berkesan mulai tahun 2006.") }}</p>


                <h3 class="text-md font-medium text-gray-800 mt-4">{{ __('2.0 Objektif Penubuhan TKKMTSP') }}</h3>
                <ul class="list-disc list-inside mt-2">
                    <li>{{ __('Menyediakan kos perbelanjaan pengurusan jenazah dengan kadar segera kepada waris atau ahli apabila berlaku musibah kematian kepada ahli atau tanggungan ahli masing-masing.') }}</li>
                    <li>{{ __('Mengurus dan mengumpul wang TKKTSP dengan teratur dan bertanggungjawab.') }}</li>
                    <li>{{ __('Menyediakan peluang kepada ahli kariah untuk sama-sama menyumbang sebagai amalan kebajikan (infaq) dengan cara membantu ahli atau tanggungannya yang memerlukan bantuan apabila ditimpa musibah kematian.') }}</li>
                </ul>

                <h2 class="text-lg font-medium text-gray-900 mt-4">{{ __('PERATURAN TABUNG KHAIRAT KEMATIAN') }}</h2>
                <h3 class="text-md font-medium text-gray-800 mt-2">{{ __('3.0 Undang-Undang Kecil / Peraturan Tabung Khairat Kematian MTSP') }}</h3>
                <!-- Add more sections and components for the subsequent content -->

                <h2 class="text-lg font-medium text-gray-900 mt-4">{{ __('Manfaat Ahli') }}</h2>
                <h3 class="text-md font-medium text-gray-800 mt-2">{{ __('4.0 Manfaat Kepada Ahli Atau Waris Apabila Berlaku Kematian') }}</h3>
                <!-- Add more sections and components for the subsequent content -->
            </div>
        </div>
    </div>
</x-app-layout>
