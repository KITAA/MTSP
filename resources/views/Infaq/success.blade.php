<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Infaq untuk masjid') }}
        </h2>
    </x-slot>

    <form action="{{ route('infaq.derma') }}" method="GET">
        @csrf
        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <x-primary-button class="mt-4" type="submit">
                    {{ __('Infaq lagi') }}
                </x-primary-button>
            </div>
        </div>
    </form>
</x-app-layout>