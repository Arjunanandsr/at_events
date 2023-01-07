<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'event_name' => 'required',
            'body' => 'required',
            'start_date' => 'required|before:end_date',
            'end_date' => 'required',
            ]);

        $user_id = auth()->check() ? auth()->user()->id : 0;        
        $event = new Event();
        $event->event_name = $request->event_name;
        $event->body = $request->body;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->event_type = $request->event_type;
        $event->user_id = $user_id;
        

        $event->save();
        return redirect('/events')->with('success','Event created successfully!');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {        
        
        $request->validate([
            'event_name' => 'required',
            'start_date' => 'required|before:end_date',
            'end_date' => 'required',
            ]);
        $event = Event::find($id);        
        $event->event_name = $request->event_name;
        $event->body = $request->body;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->event_type = $request->event_type;        
        
        $event->user_id = $request->user_id;
        $event->save();        
        return redirect('/events')->with('success','Event updated successfully!');

    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect('/events')->with('success','Event deleted successfully!');
    }
}
