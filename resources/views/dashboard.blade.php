<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Utama') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (!empty($berita))
            <div class="relative flex items-center">
                <div id="slider" class="flex w-full h-full overflow-x-scroll overflow-y-hidden whitespace-nowrap scroll-smooth scrollbar-hidden overflow-hidden">
                    @foreach($berita as $beritaa)
                        <a href="{{ route('details.berita', $beritaa->id) }}">
                            <div class="rounded-2xl w-52 h-52 m-2 cursor-pointer transition duration-300 ease-in-out bg-cover bg-center" style="background-image: url('{{ asset('/images/' . $beritaa->image) }}')">
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
    


</x-app-layout>