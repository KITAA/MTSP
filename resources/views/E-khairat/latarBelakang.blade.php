<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Latar Belakang') }}
    </h2>
</x-slot>
<div class="container mx-auto mt-8">
    <div class="max-w-2xl mx-auto my-auto p-8 bg-white shadow-lg rounded-lg">
        <img src="{{ asset('img/PosterKhairat.jpg') }}" alt="Masjid Image" class="w-full mb-4 rounded">

        <h2 class="text-2xl font-semibold mb-4">Tabung Khairat Kematian Masjid Taman Sri Pulai, Skudai, Johor (TKKMTSP)</h2>

        <p class="mb-4 text-justify">
            Tabung Khairat Kematian Masjid Taman Sri Pulai, Skudai, Johor (TKKMTSP) adalah satu tabung kebajikan yang ditubuhkan oleh Ahli Jawatan Kuasa dan Pegawai Masjid, Masjid Taman Sri Pulai (MTSP) (sebelum ini Masjid Intan Abu Bakar, Taman Sri Pulai, MIAB) pada tahun 2000.
        </p>

        <p class="mb-4 text-justify">
            TKKMTSP diamanahkan kepada Biro Kebajikan, Sosial dan Kebudayaan, MTSP untuk diuruskan dengan lebih teratur dan berkesan mulai tahun 2006.
        </p>

        <h3 class="text-xl font-semibold mb-4 text-justify">Ingat mati sedara, </h3>

        <p class="mb-4 text-justify">
            Kepada Warga Taman Sri Pulai & Jalan Kabung, yang masih belum menyertai Khairat Kematian, Masjid Taman Sri Pulai, Tuan/Puan adalah di pelawa untuk menjadi ahli.
        </p>

        <p class="mb-4 text-justify">
            Faedah utama program ini adalah :
        </p>

        <ol class="list-decimal pl-8 mb-4 text-justify">
            <li>Bagi kemudahan pengurusan andai berlaku kematian, semua diuruskan oleh pihak Masjid dan waris tidak perlu risau tentang bayaran dan urusan pengembumian</li>
            <li>Jika pun kita masih dipanjang umur untuk tahun itu, insya Allah duit yuran kita dapat kita infakkan pada yang meninggal dan menjadi saham kita di akhirat, insya Allah</li>
        </ol>

        <p class="mb-4 text-justify">
            Difahamkan kos terkini pengurusan jenazah dengan vannya 🚐, upah urus, korek kubur, permit dll adalah sebanyak RM860 dan meningkat setiap tahun.
        </p>

        <p class="mb-4 text-justify">
            Dengan hanya RM10 untuk sekali Pendaftaran, Yuran RM5/sebulan atau hanya RM50 setahun, insya Allah jom kita sertai Khairat Kematian Masjid kita ini.
        </p>

        <a href="{{route('membership.create')}}" class="mt-4">
            <x-primary-button>
                Daftar Sekarang
            </x-primary-button>
        </a>
    </div>
</div>

</x-app-layout>