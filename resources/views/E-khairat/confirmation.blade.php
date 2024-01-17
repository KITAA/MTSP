<!-- confirmation.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pendaftaran Ahli E-Khairat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Pengesahan Maklumat') }}
                </h2>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <!-- Display the main member data -->
                <ul class="list-inside space-y-6">
                    <li><strong>Nama Penuh:</strong> {{ $membership['fullname'] }}</li>
                    <li><strong>Email:</strong> {{ $membership['email'] }}</li>
                    <li><strong>NRIC:</strong> {{ $membership['ic'] }}</li>
                    <li><strong>Alamat:</strong> {{ $membership['address'] }}</li>
                    <li><strong>No H/P:</strong> {{ $membership['phone'] }}</li>
                    <li><strong>No Kecemasan:</strong> {{ $membership['emergency_no'] }}</li>
                </ul>
            </div>

                @if (!empty($tanggungans))
                    
                    @foreach ($tanggungans as $index => $tanggungan)
                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mt-6 space-y-6">
                            <h2 class="text-lg font-medium text-gray-900">
                                Tanggungan {{ $index + 1 }}
                            </h2>
                            <p><strong>Nama Penuh:</strong> {{ $tanggungan['fullname'] }}</p>
                            <p><strong>NRIC:</strong> {{ $tanggungan['ic'] }}</p>
                            <p><strong>Hubungan:</strong> {{ $tanggungan['relationship'] }}</p>
                        </div>
                    @endforeach
                @else
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mt-6 space-y-6">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Tiada Tanggungan') }}
                    </h2>
                </div>
                @endif

               
                <div class="mt-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="checkbox">
                        <span class="ml-2 text-gray-700">
                            Saya telah membaca dan bersetuju dengan
                            <a href="{{ route('membership.polisi') }}" target="_blank" class="text-blue-500 underline">
                                Polisi dan Prosedur E-Khairat
                            </a>.
                        </span>
                    </label>
                </div>

                <div class="mt-6 pt-4 space-x-4">
                    <a href="{{ route('membership.editConfirmation') }}" class="text-blue-500">
                        <x-secondary-button>
                            Edit
                        </x-secondary-button>
                    </a>

                    <x-primary-button onclick="confirmSubmission()">
                            Confirm
                        </x-primary-button>
                    </a>
                </div>
        </div>
    </div>

    <script>
        function confirmSubmission() {
            const checkbox = document.querySelector('input[name="checkbox"]');
            
            if (!checkbox.checked) {
                alert('Sila tandakan kotak persetujuan sebelum menghantar borang.');
            } else {
                window.location.href = "{{ route('membership.pelan') }}";
                }
            
        }
    </script>

</x-app-layout>
