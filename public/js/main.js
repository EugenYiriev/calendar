$(document).ready(function () {
    let SITEURL = window.location.href;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let calendar = $('#full_calendar_events').fullCalendar({
        editable: true,
        editable: true,
        events: SITEURL + "calendar-event",
        displayEventTime: true,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,
        select: function (start_event, end_event, allDay) {

            let event_name = document.getElementById("name").value;
            let start_time = document.getElementById("appt").value;

            //consultation time 1 hour and 30 minutes relax
            function parseDate(start_time) {
                return start_time.split(':')
            }

            function addHour(start_time) {
                let [hours, minutes] = parseDate(start_time)

                hours++

                minutes = Number(minutes) + 30

                if (hours > 24 || hours == 24 && minutes > 0) {
                    hours = 0
                }

                if (minutes > 60 || minutes == 60 && minutes > 0) {
                    minutes = minutes - 60
                    hours++
                }

                return `${hours}:${minutes}`;
            }

            let end_time = addHour(start_time);
            

            //Checking if the time is correct
            let min_time = document.getElementById("appt").min;
            let max_time = document.getElementById("appt").max;

            if (start_time < min_time || start_time > max_time) {

                alert ('The time is not correct. Please check the work schedule');

            } else {

                if('13:00' < start_time && '15:30' > start_time){

                    alert('Time for a bite');

                } else {

                    if (event_name) {
                        let event_start = $.fullCalendar.formatDate(start_event, "Y-MM-DD HH:mm:ss");
                        let event_end = $.fullCalendar.formatDate(end_event, "Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url: SITEURL + "calendar-crud-ajax",
                            data: {
                                event_name: event_name,
                                event_start: event_start,
                                event_start_time: start_time,
                                event_end_time: end_time,
                                event_end: event_end,
                                type: 'create'
                            },
                            type: "POST",
                            success: function (data) {
                                displayMessage("Event created.");
                                calendar.fullCalendar('renderEvent', {
                                    id: data.id,
                                    title: event_name,
                                    start: event_start,
                                    event_start_time: start_time,
                                    event_end_time: end_time,
                                    end: event_end,
                                    allDay: allDay
                                }, true);
                                calendar.fullCalendar('unselect');
                            }
                        }).fail(function(){

                            alert("Choose another time");
                         
                         });
                        
                    }
                    
                    
                }

            }

            document.getElementById("name").value = "";
            document.getElementById("appt").value = "";
        },
        
        eventClick: function (event) {
            let eventDelete = confirm("Are you sure?");
            if (eventDelete) {
                $.ajax({
                    type: "POST",
                    url: SITEURL + 'calendar-crud-ajax',
                    data: {
                        id: event.id,
                        type: 'delete'
                    },
                    success: function (response) {
                        calendar.fullCalendar('removeEvents', event.id);
                        displayMessage("Event removed");
                    }
                });
            }
        }
    });
});
function displayMessage(message) {
    toastr.success(message, 'Event');            
}

