<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="flex flex-row justify-content-center">
                    <!-- Pengguna Box -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 w-80">
                        <div class="flex justify-start">
                            <x-fas-user class="w-10 h-10"/>
                            <h3 class="text-lg font-semibold mb-4 ml-4">Jumlah Pengguna</h3>
                        </div>
                    </div>

                    <!-- Ahli Box -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 w-80">
                        <div class="flex justify-start">
                            <x-clarity-users-solid class="w-12 h-12"/>
                            <h3 class="text-lg font-semibold mb-4 ml-4">Jumlah Ahli</h3>
                        </div>
                    </div>

                    <!-- Tabung Box -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 w-80">
                        <div class="flex justify-start">
                            <x-fas-money-bill-alt class="w-12 h-12"/>
                            <h3 class="text-lg font-semibold mb-4 ml-4">Tabung E-Khairat</h3>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </x-slot>
</x-app-layout>
