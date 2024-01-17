<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Infaq untuk masjid') }}
        </h2>
    </x-slot>

    <form action="{{ route('infaq.bayar') }}" method="POST">
        @csrf
        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h1 class="mb-4 text-lg mx-auto text-gray-600 dark:text-gray-300"><b> Butiran Infaq </b></h1>
                @if (!Auth::check())
                    <div class="pt-2 max-w mx-auto sm:px-6 lg:px-8 space-y-6">
                        <label class = "relative cursor-pointer">
                            <input type="text" placeholder="Email" name="email" :required="true" class="block mt-1 w-full px-6 bg-white border-2 rounded-lg border-gray-600 border-opacity-50 outline-none focus:border-blue-600 focus:text-blue-600 transition duration-200"/>
                            <span class = "bg-white opacity-0 absolute left-5 top-7 px-2 transition duration-200 input-text">Email</span>
                        </label>
                    </div>
                @endif
                
                <div>
                    <div class="pt-4 pb-6 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                        <label class = "relative cursor-pointer">
                            <input type="text" placeholder="Jumlah Infaq" name="donationAmount" :required="true" class="block mt-1 w-full px-6 bg-white border-2 rounded-lg border-gray-600 border-opacity-50 outline-none focus:border-blue-600 focus:text-blue-600 transition duration-200"/>
                            <span class = "bg-white opacity-0 absolute left-3 top-7 px-2 transition duration-200 input-text">Jumlah Infaq</span>
                        </label>
                    </div>
                    <div class="flex">
                        <button class="bg-teal-500 text-white hover:bg-rose-500 px-9 py-2 rounded-full ml-auto mr-9" type="submit">
                          {{ __('Infaq') }}
                        </button>
                      </div>
                      
                      
                </div>
            </div>

            @if (Auth::check() && count($infaqHistory) > 0)
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h1 class="mb-4 text-lg mx-auto text-gray-600 dark:text-gray-300"><b> Sejarah Infaq </b></h1>
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">                        
                            <thead>
                                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 dark:text-gray-400">
                                    <th class="text-center gap-1 px-4 py-3">Bilangan</th>
                                    <th class="text-center px-4 py-3">Jumlah Infaq</th>
                                    <th class="text-center px-4 py-3">Tarikh Infaq</th>
                                    <th class="text-center px-4 py-3">Status Infaq</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @php
                                    $count = 1;
                                @endphp
                                @foreach ($infaqHistory as $infaq)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="text-center px-4 py-3 text-sm hover:scale-105">{{$count++}}</td>
                                    <td class="text-center px-4 py-3 text-sm hover:scale-105">{{$infaq->donationAmount}}</td>
                                    <td class="text-center px-4 py-3 text-xs hover:scale-105">{{$infaq->created_at->format('d F Y')}}</td>
                                    @if($infaq->status == 'paid')
                                    <td class="text-center px-4 py-3 text-xs hover:scale-105">
                                      <span class="inline-block px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                        {{$infaq->status}}
                                      </span>
                                    </td>
                                    @else
                                    <td class="text-center px-4 py-3 text-xs hover:scale-105">
                                      <span class="inline-block px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                                        {{$infaq->status}}
                                      </span>
                                    </td>
                                    @endif
                                  </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </form>
</x-app-layout>