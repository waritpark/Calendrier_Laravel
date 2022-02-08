<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class IdentificationPostControllerTest extends TestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;
    // use DatabaseMigrations;

    // test des routes POST
    public function test_create_user() 
    {
        $user = $this->post('calendar/inscription',[
            'email' => 'tests@tests.fr',
            'name' =>'testname',
            'prenom' => 'testnickname',
            'email_verified_at' => '',
            'password' => 'aaaaaa',
            'password2' => 'aaaaaa',
            'role_user'=>'2'
        ]);
        $user->assertStatus(302);
    }

    public function test_connexion_user() 
    {
        $user = $this->post('calendar/connexion',[
            'email' => 'tests@tests.fr',
            'password2' => 'aaaaaa'
        ]);
        $user->assertStatus(302);
    }


}
