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

    /** @test */
    public function a_spot_belongs_to_a_user(){
        $spot = factory('App\Spot')->create();
        $this->AssertInstanceOf(User::class,$spot->user);
    }

    /** @test */
    public function a_spot_has_a_location(){
        $spot = factory('App\Spot')->create();
        $this->AssertInstanceOf('App\Location',$spot->location);
    }
}
