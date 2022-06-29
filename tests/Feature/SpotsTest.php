<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SpotsTest extends TestCase
{
    use DatabaseMigrations;

    public function setup(){
        parent::setUp();
        $this->spot = factory('App\Spot')->create();
    }
    /** @test */
    public function a_user_can_see_all_the_spots()
    {
        $response = $this->get('/api/spots');        
        $response->assertStatus(200)
                ->assertSee($this->spot->name)
                ->assertSee($this->spot->address)
                ->assertSee($this->spot->phone_no);
    }

    /** @test */
    public function a_user_can_see_a_single_spot(){
        $this->get('/api/spot/'.$this->spot->id)
            ->assertStatus(200)
            ->assertSee($this->spot->name)
            ->assertSee($this->spot->address)
            ->assertSee($this->spot->phone_no);
    }
}
