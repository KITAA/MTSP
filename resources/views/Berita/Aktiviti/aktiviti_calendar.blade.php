<x-app-layout>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Aktiviti') }}
                </h2>
                <p class="mt-2">{{ __('Jadual Program & Aktiviti yang dijalankan oleh Masjid Taman Sri Pulai') }}</p>
            </div>

            <!-- Add Aktiviti Button for Admins -->
            @can('admin')
                <a href="{{ route('aktiviti.create') }}" class="text-green-500">
                    <x-primary-button>
                        {{ __('Tambah Aktiviti') }}
                    </x-primary-button>
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div id="calendar" style="width: 100%">
                    <!-- Calendar will be rendered here -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        console.log('Calendar Script Loaded'); // to check in console

        var calendarEl = document.getElementById('calendar');
        var events = [];
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'dayGridMonth',
            timeZone: 'UTC',
            events: '{{ route('aktiviti.getEvents') }}',
            editable: true,
        });

        console.log('Events:', calendar.getEvents()); // to check in console
        calendar.render();
    </script>

</x-app-layout>
