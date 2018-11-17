<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([
        //     UsersTableSeeder::class,
        //     // ]);
        factory(App\User::class,20)->create();
        factory(App\Location::class,20)->create()->each(function($location){
            factory(App\Spot::class,5)->create([
                'user_id'=>App\User::all()->random()->id,
                'location_id'=>$location->id,
            ])->each(function($spot){
                $spot->update([
                    'user_id'=>App\User::all()->random()->id
                ]);
            });
        });                
    }
}
