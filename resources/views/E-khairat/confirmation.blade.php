<!-- confirmation.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pendaftaran Ahli E-Khairat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Pengesahan Maklumat') }}
                </h2>

                <!-- Display the main member data -->
                <ul class="list-inside mt-6 space-y-6">
                    <li><strong>Nama Penuh:</strong> {{ $ahli['fullname'] }}</li>
                    <li><strong>Email:</strong> {{ $ahli['email'] }}</li>
                    <li><strong>NRIC:</strong> {{ $ahli['ic'] }}</li>
                    <li><strong>Alamat:</strong> {{ $ahli['address'] }}</li>
                    <li><strong>No H/P:</strong> {{ $ahli['phone'] }}</li>
                    <li><strong>No Kecemasan:</strong> {{ $ahli['emergency_no'] }}</li>
                </ul>

                @if (!empty($tanggungans))
                    
                    @foreach ($tanggungans as $index => $tanggungan)
                        <div class="mt-6 pt-6 space-y-6 border-1">
                            <h2 class="text-lg font-medium text-gray-900 mt-8">
                                Tanggungan {{ $index + 1 }}:
                            </h2>
                            <p><strong>Nama Penuh:</strong> {{ $tanggungan['fullname'] }}</p>
                            <p><strong>IC:</strong> {{ $tanggungan['ic'] }}</p>
                            <p><strong>Hubungan:</strong> {{ $tanggungan['relationship'] }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="mt-4">Tiada Tanggungan</p>
                @endif

                <div class="mt-6 pt-4 space-x-4">
                    <a href="{{ route('membership.editConfirmation') }}" class="text-blue-500">
                        <x-secondary-button>
                            Edit
                        </x-secondary-button>
                    </a>

                    <a href="{{ route('membership.store') }}" class="text-green-500">
                        <x-primary-button>
                            Confirm
                        </x-primary-button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
