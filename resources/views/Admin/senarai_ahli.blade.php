<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Senarai Ahli E-Khairat') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <table class="min-w-full bg-white shadow overflow-hidden sm:rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Penuh</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($memberships as $membership)
                    <tr class="bg-white">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $membership['fullname'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $membership['email'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($membership['status'] === 'Aktif')
                                <span class="bg-green-500 text-black px-2 py-1 rounded">Aktif</span>
                            @elseif ($membership['status'] === 'Dalam proses')
                                <span class="bg-yellow-500 text-yellow px-2 py-1 rounded">Dalam proses</span>
                            @elseif ($membership['status'] === 'Tamat tempoh')
                                <span class="bg-red-500 text-black px-2 py-1 rounded">Tamat tempoh</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('membership.semak', $membership) }}" class="text-blue-500 underline">
                                <x-primary-button>
                                    {{ __('Lihat') }}
                                </x-primary-button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>




</x-app-layout>