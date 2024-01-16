<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="flex justify-center">
                    <!-- Pengguna Box -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mx-4 w-80">
                        <div class="flex justify-start">
                            <div>
                                <x-fas-user class="w-10 h-10 text-yellow-600"/>
                            </div>
                            <div class="ml-6">
                                <h3 class="text-lg font-semibold">Jumlah Pengguna</h3>
                                <p >{{ $totalUser }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Ahli Box -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mx-4  w-80">
                        <div class="flex justify-start">
                            <div>
                                <x-clarity-users-solid class="w-12 h-12 text-blue-500"/>
                            </div>
                            <div class="ml-6">
                                <h3 class="text-lg font-semibold">Jumlah Ahli</h3>
                                <p >{{ $totalMembership }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tabung Box -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mx-4 w-80">
                        <div class="flex justify-start">
                            <div>
                                <x-fas-money-bill-alt class="w-12 h-12 text-green-500"/>
                            </div>
                            <div class="ml-6">
                                <h3 class="text-lg font-semibold">Tabung E-Khairat</h3>
                                <p class="ml-1">RM {{ $totalMoney }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
