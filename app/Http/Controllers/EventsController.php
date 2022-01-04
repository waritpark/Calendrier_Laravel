<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Support\Facades\Auth;
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
            'date' => 'required|max:255',
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
                return redirect()->route('accueil.dashboard')->with("create", "L'événement à bien été enregistré");
            }
            else {
                return redirect()->back()->with("error", "L'heure de départ de l'événement doit être inférieur à celle de fin !");
            }
        }
    }

    public function viewDay(Request $request)
    {
        $years = $request->years;
        $months = $request->months;
        $days = $request->days;
        $newDate = $request->newDate;
        $newDate1 = $request->newDate1;
        $newDate2 = $request->newDate2;
        $newDate3 = $request->newDate3;

        $today = date('Y-m-d');
        $newDate = new DateTime($today);
        $tomorrow1 = date('Y-m-d', strtotime('+1 day'));
        $newDate1 = new DateTime($tomorrow1);
        $tomorrow2 = date('Y-m-d', strtotime('+2 day'));
        $newDate2 = new DateTime($tomorrow2);
        $tomorrow3 = date('Y-m-d', strtotime('+3 day'));
        $newDate3 = new DateTime($tomorrow3);

        // concaténation pour recréer la date
        $date1 = ''.$years.'-'.$months.'-'.$days.'';
        $date = date_create($date1);

        // recuperer le jour actuel et l'insérer dans le formulaire
        $dataDate = [
            'date' =>$date1 ?? date('Y-m-d')
        ];

        // requete pour afficher les events du jour de l'utilisateur
        $id_user =  $request->session()->get('id_user');
        $events = DB::table('events')
        ->where('user_id', "=", $id_user)
        ->whereBetween('start', [$date->format('Y-m-d 00:00:00'),$date->format('Y-m-d 23:59:59')])
        ->get();

        return view('day-evenement', [
            'request'=>$request,
            'years'=>$years,
            'months'=>$months,
            'days'=>$days,
            'date'=>$date,
            'date1'=>$date1,
            'dataDate'=>$dataDate,
            'events'=>$events,
            'newDate'=>$newDate,
            'newDate1'=>$newDate1,
            'newDate2'=>$newDate2,
            'newDate3'=>$newDate3
        ]);
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

        // condition isset et empty avec description
        if ($request->filled('name') && $request->filled('description') && $request->filled('date') && $request->filled('start') && $request->filled('end')) {
            if ($request->input('start') < $request->input('end')) {
                $event->name = $name;
                $event->description = $description;
                $event->start = $start;
                $event->end = $end;
                $event->save();
                return redirect()->route('accueil.dashboard')->with("update", "L'événement à bien été modifié");
            }
            else {
                return redirect()->back()->with("error", "L'heure de départ de l'événement doit être inférieur à celle de fin !");
            }
        }
        else {
            return redirect()->back()->with("error", "Pour modifier un événement vous devez remplir tous les champs !");
        }
    }

    public function destroy($id)
    {
        $event=Events::find($id);
        $event->delete();
        return redirect()->back()->with("destroy", "L'événement à bien été supprimé");
    }
}
