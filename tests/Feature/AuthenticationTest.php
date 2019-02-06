<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;
    protected $user;

    public function setUp(){
        parent::setUp();
        $this->user = factory('App\User')->create();
    }

    /** @test */
    public function it_logs_in_and_return_access_token(){
        $response = $this->post('/api/login',[
            'email'=>$this->user->email,
            'password'=>'secret'
        ]);
        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);        
    }


    /** @test */
    public function it_does_not_login_invalid_user(){
        $response = $this->post('/api/login',[
            'email'=>$this->user->email,
            'password'=>'invalidpassword'
        ]);
        $response->assertJsonStructure([
            'error'
        ]);
    }

    /** @test */
    public function it_logs_out_user_and_invalidate_token(){
        $token = auth()->login($this->user);
        $response = $this->withHeaders(['Authorization'=>'Bearer '.$token])->post('/api/logout');
        $response->assertJson(['message'=>'successfully Logged Out User']); 
    }

}
