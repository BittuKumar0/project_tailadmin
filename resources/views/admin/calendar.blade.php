@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Calendar Page</h2>

<div class="bg-white p-6 rounded shadow">
    <div id="calendar"></div>
</div>

<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 650,

        events: [
            {
                title: 'Meeting',
                start: '2026-03-05'
            },
            {
                title: 'Project Deadline',
                start: '2026-03-10'
            }
        ]
    });

    calendar.render();

});
</script>

@endsection