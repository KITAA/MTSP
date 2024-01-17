@php
    use Carbon\Carbon;
@endphp


<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Keahlian E-Khairat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div x-data="{ tab: 'maklumat-ahli', rejectReasonVisible: false, rejectionReason: '' }" class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex space-x-4 ml-3">
                <button :class="{ 'bg-white shadow': tab === 'maklumat-ahli', 'border border-black': tab !== 'maklumat-ahli' }" class="text-lg font-medium text-gray-900 cursor-pointer p-2 rounded" @click="tab = 'maklumat-ahli'">
                    {{ __('Maklumat Ahli') }}
                </button>

                <button :class="{ 'bg-white shadow': tab === 'maklumat-tanggungan', 'border border-black': tab !== 'maklumat-tanggungan' }" class="text-lg font-medium text-gray-900 cursor-pointer p-2 rounded" @click="tab = 'maklumat-tanggungan'">
                    {{ __('Maklumat Tanggungan') }}
                </button>
            </div>

            <div x-show="tab === 'maklumat-ahli'" class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <ul class="list-inside space-y-6">
                        <li><strong>Nama Penuh :</strong> {{ $membership['fullname'] }}</li>
                        <li><strong>Email :</strong> {{ $membership['email'] }}</li>
                        <li><strong>NRIC :</strong> {{ $membership['ic'] }}</li>
                        <li><strong>Alamat :</strong> {{ $membership['address'] }}</li>
                        <li><strong>No H/P :</strong> {{ $membership['phone'] }}</li>
                        <li><strong>No Kecemasan :</strong> {{ $membership['emergency_no'] }}</li>
                        <li><strong>Status Keahlian :</strong>
                            @if ($membership['status'] === 'Aktif')
                                <span class="bg-green-500 text-white px-11 py-1 rounded">Aktif</span>
                            @elseif ($membership['status']  === 'Dalam proses')
                                <span class="bg-yellow-500 text-white px-3 py-1 rounded">Dalam proses</span>
                            @elseif ($membership['status']  === 'Tamat tempoh')
                                <span class="bg-red-500 text-white px-2 py-1 rounded">Tamat tempoh</span>
                            @elseif ($membership['status']  === 'Dilucutkan')
                                <span class="bg-red-900 text-white px-3 py-1 rounded">Dilucutkan</span>
                            @endif
                        </li>

                        @if($membership['status'] === 'Aktif')
                        <li><strong>Tempoh Tamat :</strong> 
                            {{ Carbon::parse($membership['created_at'])->addMonths($membership['duration'])->format('d/m/Y') }}
                        </li>
                        @endif

                    </ul>
                </div>
            </div>

            <div x-show="tab === 'maklumat-tanggungan'" class="p-4 sm:p-8 bg-white shadow sm:rounded-lg space-y-6">
                @if ($membership->tanggungan->isNotEmpty())
                    @foreach ($membership->tanggungan as $index => $tanggungan)
                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg space-y-6">
                            <h2 class="text-lg font-medium text-black-900">
                                TANGGUNGAN {{ $index + 1 }}
                            </h2>
                            <p><strong>Nama Penuh :</strong> {{ $tanggungan['fullname'] }}</p>
                            <p><strong>NRIC :</strong> {{ $tanggungan['ic'] }}</p>
                            <p><strong>Hubungan :</strong> {{ $tanggungan['relationship'] }}</p>
                        </div>
                    @endforeach
                @else
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg space-y-6">
                        <p>Tiada Tanggungan</p>
                    </div>
                @endif
            </div>

            <div class="flex justify-between mt-4">
                <div>
                    <a href="{{ route('membership.edit', $membership) }}" class="text-blue-500 underline">
                        <x-primary-button class="mr-4">
                            {{ __('Edit') }}
                        </x-primary-button>
                    </a>
                </div>

                @if(Auth::user()->usertype === 'user')
                    @if($membership->status === 'Tamat tempoh')
                    <div>
                        <a href="{{ route('membership.pelan', $membership) }}">
                            <x-secondary-button>
                                {{ __('Perbaharui Keahlian') }}
                            </x-secondary-button>
                        </a>
                    </div>
                    @endif
                @endif

                @if(Auth::user()->usertype === 'admin')
                    @if($membership->status === 'Dalam proses')
                    <div class="flex flex-row">
                        <div>
                            <form method="POST" action="{{ route('membership.approve', $membership) }}">
                                @csrf
                                @method('post')
                                <button type="submit" class="bg-green-500 text-white px-4 py-1.5 rounded mr-2">
                                    {{ __('Lulus') }}
                                </button>
                            </form>
                        </div>
                        <div>
                            <button @click="rejectReasonVisible = true" class="bg-red-500 text-white px-4 py-1.5 rounded">
                                {{ __('Perlu Dibaiki') }}
                            </button>
                        </div>
                    </div>
                    @endif
                @endif
            </div>
            <template x-if="rejectReasonVisible">
                <div class="mt-2">
                    <form method="POST" action="{{ route('membership.reject', $membership) }}">
                        @csrf
                        @method('post')
                        <label for="reject_reason" class="block text-sm font-medium text-gray-700">Alasan:</label>
                        <textarea id="reject_reason" name="reject_reason" x-model="rejectionReason" rows="3" class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:outline-none focus:border-blue-500" placeholder="Berikan sebab mengapa permohonan perlu dibaiki" required></textarea>
                        <button type="submit" class="bg-red-500 text-white px-4 py-1.5 rounded mt-2">
                            {{ __('Submit') }}
                        </button>
                    </form>
                </div>
            </template>
        </div>
    </div>

</x-app-layout>
