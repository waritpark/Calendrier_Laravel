<?php

// namespace Tests\Feature;

// use Carbon\Carbon;
// use Tests\TestCase;
// use App\Models\Events;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithoutMiddleware;
// use Illuminate\Foundation\Testing\DatabaseMigrations;

// class EventsControllerTest extends TestCase
// {
//     use WithoutMiddleware;
//     use RefreshDatabase;
//     use DatabaseMigrations;
//     public function test_store()
//     {
//         $event = $this->post('calendar/dashboard/store-evenement',[
//             'name' => 'name_test',
//             'description' =>'description_test',
//             'date' => Carbon::today(),
//             'start' => '2022-02-09 12:00:00',
//             'end' => '2022-02-09 14:00:00',
//             'user_id' => '1'
//         ]);
//         $event->assertStatus(200);
//     }
// }
