<!DOCTYPE html>
<html>
<head>
    <title>Appointments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <style>
        .container {
            margin: 50px auto;
            width: 80%;
            text-align: center;
        }
        table {
            width: 100%;
            text-align: left;
            margin-top: 50px;
        }
        th, td {
            padding: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Appointments</h1>
        <table>
            <tr>
                <th>Event Name</th>
                <th>Start Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>End Date</th>
            </tr>
            @foreach($data as $event)
                <tr>
                    <td>{{ $event->event_name }}</td>
                    <td>{{ $event->event_start }}</td>
                    <td>{{ $event->event_start_time }}</td>
                    <td>{{ $event->event_end_time }}</td>
                    <td>{{ $event->event_end }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
