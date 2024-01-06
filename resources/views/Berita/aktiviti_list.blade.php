<li class="py-4">
    <div class="flex space-x-4">
        <div class="text-sm text-gray-500">{{ $aktiviti->tarikh_aktiviti->format('d F y') }}</div>
        <div class="text-sm font-bold text-gray-900">
            <a href="{{ route('berita.showAktiviti', $aktiviti) }}">
                {{ $aktiviti->tajuk_aktiviti }}
            </a>
        </div>
    </div>
    <div class="text-sm text-gray-500">{{ $aktiviti->tempat_aktiviti }}</div>
    <a href="{{ route('berita.showAktiviti', $aktiviti) }}">
        <img src="/img/aktiviti/{{ $aktiviti->gambar_aktiviti }}" width="400px" alt="Poster Aktiviti">
    </a>
    <div class="mt-2 text-sm text-gray-500">{{ $aktiviti->deskripsi_aktiviti }}</div>

    <!-- Buttons for Admins -->
    <div class="flex justify-end">
        {{-- <a href="{{ route('berita.showAktiviti', $aktiviti['id']) }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Lihat</a> --}}
        <a href="{{ route('berita.editAktiviti', $aktiviti->id) }}"
            class="bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">Edit</a>
        <form action="{{ route('berita.destroyAktiviti', $aktiviti->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="bg-red-500 hover:bg-red-700 text-black font-bold py-2 px-4 rounded">Delete</button>
        </form>
    </div>
</li>
