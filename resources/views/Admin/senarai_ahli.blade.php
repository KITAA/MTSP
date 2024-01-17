<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Senarai Ahli E-Khairat') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="mb-4 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Search:</span>
                    <form method="get" action="{{ route('membership.search') }}">
                        <input type="search" name="query" placeholder="Search by name"
                            class="border border-solid border-gray-300 rounded-md py-2 px-3" value= "{{$search ?? '' }}"  >
                        <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded">Search</button>
                    </form>
                </div>
            </div>
            
                <table class="min-w-full bg-white shadow overflow-hidden sm:rounded-lg divide-y divide-gray-200">
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
                                    <span class="bg-green-500 text-white px-11 py-1 rounded">Aktif</span>
                                @elseif ($membership['status'] === 'Dalam proses')
                                    <span class="bg-yellow-500 text-white px-3 py-1 rounded">Dalam proses</span>
                                @elseif ($membership['status'] === 'Tamat tempoh')
                                    <span class="bg-red-500 text-white px-2 py-1 rounded">Tamat tempoh</span>
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
    </x-slot>
</x-app-layout>