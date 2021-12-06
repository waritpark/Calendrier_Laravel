<?php
use Illuminate\Support\Facades\DB;

function reqListEvents($id_user, $date) {
    $events = DB::table('events')
    ->where('user_id', "=", $id_user)
    ->whereBetween('start', [$date->format('Y-m-d 00:00:00'),$date->format('Y-m-d 23:59:59')])
    ->get();
    return $events;
}
