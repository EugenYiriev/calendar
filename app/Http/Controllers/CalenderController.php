<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CrudEvents;
use Illuminate\Support\Facades\DB;
class CalenderController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {  
            $data = CrudEvents::whereDate('event_start', '>=', $request->start)
                ->whereDate('event_end',   '<=', $request->end)
                ->get(['id', 'event_name', 'event_start', 'event_start_time', 'event_end_time', 'event_end']);
            return response()->json($data);
        }
        return view('welcome');
    }

    public function calendarEvents(Request $request)
    {
        switch ($request->type) {
            case 'create':

                $existingEvents = CrudEvents::where(function ($query) use ($request) {
                    // Check if the new event overlaps with any existing events
                    $query->where('event_start', '<=', $request->event_end)
                        ->where('event_end', '>=', $request->event_start)
                        ->where('event_start_time', '<=', $request->event_end_time)
                        ->where('event_end_time', '>=', $request->event_start_time);
                })->get();
                
                $eventStartDayOfWeek = date('w', strtotime($request->event_start));
                $eventEndDayOfWeek = date('w', strtotime($request->event_end));
                
                if ($existingEvents->isNotEmpty() || $eventStartDayOfWeek === '0' || $eventStartDayOfWeek === '6') {
                    dd($eventStartDayOfWeek);
                    header("Refresh:0");
                } else {
                    $events = CrudEvents::create([
                        'event_name' => $request->event_name,
                        'event_start' => $request->event_start,
                        'event_start_time' => $request->event_start_time,
                        'event_end_time' => $request->event_end_time,
                        'event_end' => $request->event_end,
                    ]);
                }
                
             break;
             
             case 'delete':
                $events = CrudEvents::find($request->id);
                if ($events) {
                    $events->delete();
                }
                break;
               
             default:
               $events = new CrudEvents();
               break;
        }
                
        return response()->json($events);
    } 

    public function view()
    {
        $events = CrudEvents::all();
        return view('welcome', compact('events'));
    }


}