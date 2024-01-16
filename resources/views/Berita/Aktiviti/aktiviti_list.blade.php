<li class="py-4">
    <div class="flex space-x-4">
        <div class="text-sm text-gray-500">{{ $aktiviti->tarikh_aktiviti->format('d F y') }}</div>
        <div class="text-sm font-bold text-gray-900">
            <a href="{{ route('aktiviti.show', $aktiviti) }}">
                {{ $aktiviti->tajuk_aktiviti }}
            </a>
        </div>
    </div>
    <div class="text-sm text-gray-500">{{ $aktiviti->tempat_aktiviti }}</div>
    <a href="{{ route('aktiviti.show', $aktiviti) }}">
        <img src="/img/aktiviti/{{ $aktiviti->gambar_aktiviti }}" width="400px" alt="{{ $aktiviti->tajuk_aktiviti }}">
    </a>
    <div class="mt-2 text-sm text-gray-500">{{ $aktiviti->deskripsi_aktiviti }}</div>

    <!-- Buttons for Admins -->
    @can('admin')
        <div class="flex justify-end">
            <a href="{{ route('aktiviti.show', $aktiviti->id) }}" class="mr-2">
                <x-secondary-button>
                    {{ __('Show') }}
                </x-secondary-button>
            </a>
            <a href="{{ route('aktiviti.edit', $aktiviti->id) }}" class="mr-1">
                <x-secondary-button>
                    {{ __('Edit') }}
                </x-secondary-button>
            </a>
            <form action="{{ route('aktiviti.destroy', $aktiviti->id) }}" method="POST" class="ml-1">
                @csrf
                @method('DELETE')
                <x-danger-button>
                    {{ __('Delete') }}
                </x-danger-button>
            </form>
        </div>
    @endcan
</li>
