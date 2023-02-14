<?php 
use App\Http\Controllers\CalenderController;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Fullcalender CRUD Events in Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
</head>

<body>
     <div class="form-block">
        <h2 class="h2 text-center mb-5 border-bottom pb-3">Welcome</h2>
        <p>Schedule</p>
        <p>Monday to Friday from 9:00 to 13:00 from 15:30 to 21:00</p>
        <p><span>Event name</span>
        <input type="text" id="name" name="name" required minlength="4" maxlength="12" size="10" placeholder="Name">
        <span>Event time</span>
        <input type="time" id="appt" name="appt" min="09:00" max="20:59" required></p>
        <p>Date picker</p>
     </div>

    <div class="container mt-5" style="max-width: 700px">
        <h2 class="h2 text-center mb-5 border-bottom pb-3">Calendar</h2>
        <div id='full_calendar_events'></div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>


    <div class="container">
        <h1>Appointments</h1>
        <table>
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Start Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>End Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>{{ $event->event_name }}</td>
                    <td>{{ $event->event_start }}</td>
                    <td>{{ $event->event_start_time }}</td>
                    <td>{{ $event->event_end_time }}</td>
                    <td>{{ $event->event_end }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    

</body>
</html>