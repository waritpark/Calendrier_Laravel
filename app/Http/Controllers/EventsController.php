<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function store(Request $request) {
        //dd($request);
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'description' => 'max:255',
            'start' => 'required|max:100',
            'end' => 'required|max:100',
        ]);
        $event = new Events();
        $name = $request->input('name');
        $description = $request->input('description');
        $date = $request->input('date');
        $start = $request->input('start');
        $start = date_create_from_format('Y-m-d H:i', $date. ' ' .$start)->format('Y-m-d H:i:s');
        $end = $request->input('end');
        $end = date_create_from_format('Y-m-d H:i', $date. ' ' .$end)->format('Y-m-d H:i:s');
        $user_id = $request->session()->get('id_user');

        $event->name = $name;
        $event->description = $description;
        $event->start = $start;
        $event->end = $end;
        $event->user_id=$user_id;
        $event->save();
        return redirect()->route('accueil.dashboard');
    }

    public function create()
    {
        return view('create-evenement');
    }

    public function viewDay(Request $request) 
    {
        //dd($request);
        $years = $request->years;
        $months = $request->months;
        $days = $request->days;
        $request->attributes->add(['years' => $years, 'months'=>$months, 'days'=>$days]);
        return view('day-evenement', ['request'=>$request, 'years'=>$years, 'months'=>$months, 'days'=>$days]);
    }

    public function edit($id) 
    {
        $event=Events::find($id);
        return view('edit-evenement', ['event'=>$event]);
    }

    public function update(Request $request, $id) {
        // dd($id, $request);

        $event=Events::find($id);
        $name = $request->input('name');
        $description = $request->input('description');
        $date = $request->input('date');
        $start = $request->input('start');
        $start = date_create_from_format('Y-m-d H:i', $date. ' ' .$start)->format('Y-m-d H:i:s');
        $end = $request->input('end');
        $end = date_create_from_format('Y-m-d H:i', $date. ' ' .$end)->format('Y-m-d H:i:s');

        $event->name = $name;
        $event->description = $description;
        $event->start = $start;
        $event->end = $end;
        $event->save();
        return redirect()->route('accueil.dashboard');
    }

    public function delete(Request $request) {
        $id = $request->id;
        $request->attributes->add(['id' => $id]);
        return view('delete-evenement', ['request'=>$request, 'id'=>$id]);
    }
}
