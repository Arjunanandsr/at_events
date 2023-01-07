<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use DB;

class EventListController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index(Request $request)
    {
        // \DB::enableQueryLog(); // Enable query log

        $filter = $request->query('filter');
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $event = Event::latest();
        if (!empty($filter))
        {
            $event = Event::where('events.event_name', 'like', '%'.$filter.'%');              
        }      
        if (!empty($start_date) && !empty($end_date)){
            $event = $event->whereBetween('events.start_date', [$start_date, $end_date]);
        }       
        if (!empty($start_date)){
            $event = $event->where('events.start_date', '>=', $start_date);
        }
        if (!empty($end_date)){
            $event = $event->where('events.end_date', '<=', $end_date);
        }
        // $event = $event->paginate();   
        $event = $event->orderBy('start_date','desc')->paginate(15);
                           
        //  dd(\DB::getQueryLog()); // Show results of log
        return view('events/list', compact('event','filter','start_date','end_date'));
    }


    public function status(Request $request)
    {
        // \DB::enableQueryLog(); // Enable query log        
        $userEvent = User::select('users.id','users.email', DB::raw('count( events.user_id ) as cnt'))
            ->leftJoin('events', 'users.id', '=', 'events.user_id')
            ->groupBy('users.id')
            ->get();
    
        //  dd(\DB::getQueryLog()); // Show results of log
        return view('events/status', compact('userEvent') );
    }
}
