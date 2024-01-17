<x-app-layout>
    <title>Pembayaran Dibatalkan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <div class="container mx-auto p-12">
        <div class="bg-white rounded-lg shadow p-6 md:p-12 text-center">
            <svg class="mx-auto mb-4 w-16 h-16 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            <h2 class="text-2xl mb-4 font-bold text-gray-800">Pembayaran dibatalkan</h2>
            <p class="text-gray-600 mb-8">Your payment was not completed. If you encountered an issue, please try again.</p>
            <a href="{{ route('membership.create') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Daftar Semula
            </a>
        </div>
    </div>
</x-app-layout>
