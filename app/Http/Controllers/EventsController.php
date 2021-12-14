<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    public function newEvent()
    {
        return view('new-evenement');
    }

    public function store(Request $request) {
        //dd($request); dd = dump and die
        $request->validate([
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
        // condition isset et empty
        if ($request->filled('name') && $request->filled('date') && $request->filled('start') && $request->filled('end')) {
            // condition de l'heure du début et de fin
            if ($request->input('start') < $request->input('end')) {
                $event->name = $name;
                $event->description = $description;
                $event->start = $start;
                $event->end = $end;
                $event->user_id=$user_id;
                $event->save();
                return redirect()->route('accueil.dashboard')->with("create", "l'événement à bien été enregistré");
            }
            else {
                return redirect()->back()->with("error", "l'heure de départ de l'événement doit être inférieur à celle de fin !");
            }
        }
    }

    public function viewDay(Request $request) 
    {
        $years = $request->years;
        $months = $request->months;
        $days = $request->days;

        // concaténation pour recréer la date
        $date1 = ''.$years.'-'.$months.'-'.$days.'';
        $date = date_create($date1);

        // recuperer le jour actuel et l'insérer dans le formulaire
        $data = [
            'date' =>$date1 ?? date('Y-m-d')
        ];

        // requete pour afficher les events du jour de l'utilisateur
        $id_user =  $request->session()->get('id_user');
        $events = DB::table('events')
        ->where('user_id', "=", $id_user)
        ->whereBetween('start', [$date->format('Y-m-d 00:00:00'),$date->format('Y-m-d 23:59:59')])
        ->get();

        return view('day-evenement', ['request'=>$request, 'years'=>$years, 'months'=>$months, 'days'=>$days, 'date'=>$date, 'date1'=>$date1, 'data'=>$data,'events'=>$events]);
    }

    public function edit($id) 
    {
        $event=Events::find($id);
        return view('update-evenement', ['event'=>$event]);
    }

    public function update(Request $request, $id) {
        // dd($id, $request);
        
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'max:255',
            'start' => 'required|max:100',
            'end' => 'required|max:100',
        ]);

        $event=Events::find($id);
        $name = $request->input('name');
        $description = $request->input('description');
        $date = $request->input('date');
        $start = $request->input('start');
        $start = date_create_from_format('Y-m-d H:i', $date. ' ' .$start)->format('Y-m-d H:i:s');
        $end = $request->input('end');
        $end = date_create_from_format('Y-m-d H:i', $date. ' ' .$end)->format('Y-m-d H:i:s');

        // condition isset et empty 
        if ($request->filled('name') && $request->filled('description') && $request->filled('date') && $request->filled('start') && $request->filled('end')) {
            $event->name = $name;
            $event->description = $description;
            $event->start = $start;
            $event->end = $end;
            $event->save();
            return redirect()->route('accueil.dashboard')->with("update", "l'événement à bien été modifié");
        }
    }

    public function destroy($id) 
    {
        $event=Events::find($id);
        $event->delete();
        return redirect()->back()->with("destroy", "l'événement à bien été supprimé");
    }
}
