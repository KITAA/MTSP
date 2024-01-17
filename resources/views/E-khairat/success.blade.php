<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembayaran Berjaya') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <div class="container mx-auto p-12">
        <div class="bg-white rounded-lg shadow p-6 md:p-12 text-center">
            <svg class="mx-auto mb-4 w-16 h-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <h2 class="text-2xl mb-4 font-bold text-gray-800">Pembayaran Berjaya!</h2>
            <p class="text-gray-600 mb-8">Pendaftaran Ahli anda sudah berjaya dan akan diluluskan.</p>
            <a href="{{ route('home') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Kembali ke Utama
            </a>
        </div>
    </div>

</x-app-layout>