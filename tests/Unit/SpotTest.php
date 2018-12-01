<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use App\Location;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SpotTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(){
        parent::setUp();
        $this->spot = factory('App\Spot')->create();
    }
    
    /** @test */
    public function a_spot_belongs_to_a_user(){
        $this->AssertInstanceOf(User::class,$this->spot->user);
    }

    /** @test */
    public function a_spot_has_a_location(){
        $this->AssertInstanceOf('App\Location',$this->spot->location);
    }
}
