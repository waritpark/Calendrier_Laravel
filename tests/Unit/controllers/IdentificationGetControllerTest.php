<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;

class IdentificationGetControllerTest extends TestCase
{
    // tests des routes GET
    public function test_connexion()
    {
        $response = $this->get('calendar/connexion');
        $response->assertStatus(200);
    }
    public function test_inscription()
    {
        $response = $this->get('calendar/inscription');
        $response->assertStatus(200);
    }

}
