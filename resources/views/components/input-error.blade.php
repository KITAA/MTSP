@props(['messages'])

@if ($messages)

    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>

        @foreach ((array) $messages as $message)

            @if(is_array($message))
                {{-- Handle array of messages --}}
                @foreach($message as $subMessage)
                    <li>{{ $subMessage }}</li>
                @endforeach
            @else
                {{-- Handle single message --}}
                <li>{{ $message }}</li>
            @endif

        @endforeach

    </ul>

@endif

