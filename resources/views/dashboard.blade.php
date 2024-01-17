<x-app-layout>
    @if (!empty($berita))
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Utama') }}
            </h2>
        </x-slot>

        <script>
            function scrollToLeft() {
                const slider = document.getElementById('slider');
                slider.scrollLeft -= 300;
            }
        
            function scrollToRight() {
                const slider = document.getElementById('slider');
                slider.scrollLeft += 300;
            }
        </script>
        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="py-6 px-40 font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Berita Masjid') }}
                </h2>
                <div class="relative flex items-center">
                    <div id="slider" class="flex w-full h-full overflow-x-scroll overflow-y-hidden whitespace-nowrap scroll-smooth">
                        @foreach($berita as $beritaa)
                            <a href="{{ route('details.berita', $beritaa->id) }}">
                                <div class="rounded-2xl w-80 h-80 m-2 cursor-pointer transition duration-300 ease-in-out bg-cover bg-center" style="background-image: url('{{ asset('/images/' . $beritaa->image) }}')">
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="p-4 relative flex items-center">
                    <div onclick="scrollToRight()" class="w-12 h-12 absolute top-70 right-0">
                        <x-heroicon-o-arrow-right-circle/>
                    </div>
                    <div onclick="scrollToLeft()" class="w-12 h-12 absolute top-70 left-0">
                        <x-heroicon-o-arrow-left-circle/>
                    </div>
                </div> 
            </div>
        </div>
    @endif
    <div class="bg-white py-20 px-40">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('E-Khairat') }}
        </h2>
        <div class="p-4 relative flex items-center">
            <div class="m-3 w-full">
                <h1 class="font-bold text-3xl">PENDAFTARAN KHAIRAT<br>KEMATIAN TELAH DIBUKA</h1>

                <p class="p-5">
                    Tabung Khairat Kematian Masjid Taman Sri Pulai, Skudai, Johor (TKKMTSP) 
                    adalah satu tabung kebajikan yang ditubuhkan oleh Ahli Jawatan Kuasa dan Pegawai Masjid,
                    Masjid Taman Sri Pulai (MTSP) (sebelum ini Masjid Intan Abu Bakar, Taman Sri Pulai, MIAB) pada 
                    tahun 2000. TKKMTSP diamanahkan kepada Biro Kebajikan, Sosial dan Kebudayaan, MTSP untuk diuruskan dengan 
                    lebih teratur dan berkesan mulai tahun 2006.
                </p>
                <div class="flex justify-end px-5">
                    <a href="{{ route('membership.latarBelakang') }}">
                        <button class="bg-blue-800 text-blue-200 hover:bg-blue-200 hover:text-blue-800 px-9 py-2 rounded-full" type="submit">
                            {{ __('Info Lanjut') }}
                        </button>
                    </a>
                </div>
                
                
            </div>
            <div class="m-3 w-full relative flex justify-center">
                <img src="{{ asset('img/PosterKhairat.jpg') }}" alt="Masjid Image" class="w-2/3 h-auto mb-4 rounded">
            </div>
            
            @endif
        </div>
        
    </div>

    <div class="bg-white py-20 px-40">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('E-Khairat') }}
        </h2>
        <div class="p-4 relative flex items-center">
            <div class="m-3 w-full">
                <h1 class="font-bold text-3xl">PENDAFTARAN KHAIRAT<br>KEMATIAN TELAH DIBUKA</h1>

                <p class="p-5">
                    Tabung Khairat Kematian Masjid Taman Sri Pulai, Skudai, Johor (TKKMTSP) 
                    adalah satu tabung kebajikan yang ditubuhkan oleh Ahli Jawatan Kuasa dan Pegawai Masjid,
                    Masjid Taman Sri Pulai (MTSP) (sebelum ini Masjid Intan Abu Bakar, Taman Sri Pulai, MIAB) pada 
                    tahun 2000. TKKMTSP diamanahkan kepada Biro Kebajikan, Sosial dan Kebudayaan, MTSP untuk diuruskan dengan 
                    lebih teratur dan berkesan mulai tahun 2006.
                </p>
                <div class="flex justify-end px-5">
                    <a href="{{ route('membership.latarBelakang') }}">
                        <button class="bg-blue-800 text-blue-200 hover:bg-blue-200 hover:text-blue-800 px-9 py-2 rounded-full" type="submit">
                            {{ __('Info Lanjut') }}
                        </button>
                    </a>
                </div>
                
                
            </div>
            <div class="m-3 w-full relative flex justify-center">
                <img src="{{ asset('img/PosterKhairat.jpg') }}" alt="Masjid Image" class="w-2/3 h-auto mb-4 rounded">
            </div>
        </div>
        
    </div>
</x-app-layout>