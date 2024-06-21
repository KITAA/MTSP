<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col">
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

                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mx-4 w-80">
                            <div class="flex justify-start">
                                <div>
                                    <x-fas-donate class="w-12 h-12 text-red-300"/>
                                </div>
                                <div class="ml-6">
                                    <h3 class="text-lg font-semibold">Jumlah Infaq</h3>
                                    <p class="ml-1">RM {{ $totalInfaq }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <div class="mt-10">
                        <table class="w-96 mx-4 bg-white shadow overflow-hidden sm:rounded-lg divide-y divide-gray-200">
                            <caption class="font-medium uppercase tracking-wider bg-white shadow  rounded-full py-2 mb-2">Ahli Terkini</caption>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ahli E-Khairat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($membership->take(5) as $member)
                                    <tr class="bg-white">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $member['fullname'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($member['status'] === 'Dalam proses')
                                                <span class="bg-yellow-500 text-white px-3 py-1 rounded">Dalam proses</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($membership->count() <= 5)
                                    @for ($i = 0; $i < 5 - $membership->count(); $i++)
                                        <tr class="bg-white">
                                            <td class="px-6 py-6 whitespace-nowrap"></td>
                                            <td class="px-6 py-6 whitespace-nowrap"></td>
                                        </tr>
                                    @endfor
                                @endif
                            </tbody>
                        </table>
                        
                        <a href="{{ route('membership.index') }}" class="text-blue-500 ml-6">See All</a>
                        
                    </div>
                    <div class="mt-10">
                        <table class="w-96 mx-4 bg-white shadow overflow-hidden sm:rounded-lg divide-y divide-gray-200">
                            <caption class="font-medium uppercase tracking-wider bg-white shadow  rounded-full py-2 mb-2"">Infaq Terkini</caption>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Infaq</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($infaq->take(5) as $infaq)
                                    <tr class="bg-white">
                                        <td class="px-6 py-4 whitespace-nowrap">RM {{ $infaq['donationAmount'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($infaq['status'] === 'paid')
                                                <span class="bg-green-500 text-white px-11 py-1 rounded">Paid</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($infaq->count() <= 5)
                                    @for ($i = 0; $i < 5 - $infaq->count(); $i++)
                                        <tr class="bg-white">
                                            <td class="px-6 py-6 whitespace-nowrap"></td>
                                            <td class="px-6 py-6 whitespace-nowrap"></td>
                                        </tr>
                                    @endfor
                                @endif
                            </tbody>
                        </table>
                        
                        <a href="{{ route('infaq.derma') }}" class="text-blue-500 ml-6">See All</a>
                    </div>
                    
                
            </div>
        </div>
        </div>
    </x-slot>
</x-app-layout>
