<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Infaq untuk masjid') }}
        </h2>
    </x-slot>

    <form action="{{ route('infaq.bayar') }}" method="POST">
        @csrf
        <div class="py-12">

            @if (!Auth::check())
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div>
                        <x-input-label for="email" :value="__('Email anda')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :required="true" />
                    </div>
                </div>
            @endif
            
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div>
                    <x-input-label for="donationAmount" :value="__('Jumlah Infaq')" />
                    <x-text-input id="donationAmount" class="block mt-1 w-full" type="text" name="donationAmount" :required="true" />
                </div>
                <x-primary-button class="mt-4" type="submit">
                    {{ __('Infaq') }}
                </x-primary-button>
            </div>

            @if (Auth::check() && count($infaqHistory) > 0)
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div>
                       <h1><b> Sejarah Infaq </b></h1>
                    </div>

                    <table class="table-auto">
                        <thead>
                            <tr class="bg-gray-500">
                                <th class="px-6 py-4">Bilangan</th>
                                <th class="px-6 py-4">Jumlah Infaq</th>
                                <th class="px-6 py-4">Tarikh Infaq</th>
                                <th class="px-6 py-4">Status Infaq</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $count = 1;
                            @endphp
                            @foreach ($infaqHistory as $infaq)
                                <tr>
                                    <td class="px-6 py-4">{{$count++}}</td>
                                    <td class="px-6 py-4">{{$infaq->donationAmount}}</td>
                                    <td class="px-6 py-4">{{$infaq->created_at->format('m-d-Y')}}</td>
                                    <td class="px-6 py-4">{{$infaq->status}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </form>
</x-app-layout>