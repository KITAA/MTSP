<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pelan dan Harga') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center items-center space-x-6">
            <form action="{{ route('membership.bayar') }}" method="post">
                @csrf
                @method('post')
                <input type="hidden" name="membership_type" value="Bulanan">
                <input type="hidden" name="price" value="15">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h2 class="text-2xl font-bold mb-6">Bulanan</h2>
                    <p class="mb-6">All the basics for starting a new business</p>
                    <h3 class="text-xl font-semibold mb-2">RM15/bulan</h3>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Subscribe</button>
                </div>
            </form>

            <form action="{{ route('membership.bayar') }}" method="post">
                @csrf
                @method('post')
                <input type="hidden" name="membership_type" value="6 Bulan">
                <input type="hidden" name="price" value="30">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h2 class="text-2xl font-bold mb-6">6 Bulan</h2>
                    <p class="mb-6">All the basics for starting a new business</p>
                    <h3 class="text-xl font-semibold mb-2">RM30/6bulan</h3>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Subscribe</button>
                </div>
            </form>

            <form action="{{ route('membership.bayar') }}" method="post">
                @csrf
                @method('post')
                <input type="hidden" name="membership_type" value="Tahunan">
                <input type="hidden" name="price" value="50">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h2 class="text-2xl font-bold mb-6">Tahunan</h2>
                    <p class="mb-6">All the basics for starting a new business</p>
                    <h3 class="text-xl font-semibold mb-2">RM50/tahun</h3>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Subscribe</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
