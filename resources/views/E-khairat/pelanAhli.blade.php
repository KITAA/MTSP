<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pelan dan Harga') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center items-center space-x-6">
        
            <div>
            <form action="{{ route('membership.bayar') }}" method="post">
                @csrf
                @method('post')
                <input type="hidden" name="membership_type" value="Bulanan">
                @if (auth()->user()->membership)
                <input type="hidden" name="price" value="5">
                @else
                <input type="hidden" name="price" value="15">
                @endif
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-64">
                    <h2 class="text-2xl font-bold mb-6">Bulanan</h2>
                    <p class="mb-6 max-w-full">Bayaran ansuran</p>
                    <h3 class="text-xl font-semibold mb-2">RM5/bulan</h3>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 mt-4 rounded">Bayar</button>
                </div>
            </form>
            </div>
            <div>
            <form action="{{ route('membership.bayar') }}" method="post">
                @csrf
                @method('post')
                <input type="hidden" name="membership_type" value="Tahunan">
                @if (auth()->user()->membership)
                <input type="hidden" name="price" value="50">
                @else
                <input type="hidden" name="price" value="60">
                @endif
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-64">
                    <h2 class="text-2xl font-bold mb-6">Tahunan</h2>
                    <p class="mb-6 max-w-full">Digalakkan</p>
                    <h3 class="text-xl font-semibold mb-2">RM50/tahun</h3>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 mt-4 rounded">Bayar</button>
                </div>
            </form>
        </div>
        </div>
        <p class="text-center pt-8">*Ahli baru akan dikenakan yuran pendaftaran sebanyak RM10 bagi satu keluarga</p>
    </div>
</x-app-layout>