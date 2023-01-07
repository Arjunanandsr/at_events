<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        
        $faker = Faker::create();
        $dob = $faker->date($format = 'D-m-y', $max = '2010',$min = '1980');
        $start = $faker->dateTimeBetween('next Monday', 'next Monday +7 days');
        $end = $faker->dateTimeBetween($start, $start->format('Y-m-d H:i:s').' +2 days');

    	foreach (range(1,500) as $index) {
            DB::table('events')->insert([
                'event_name' => $faker->sentence,
                'user_id' => 1,
                'event_type' => 1,
                'start_date' => $start,
                'end_date' => $end
            ]);
        }
    }

}
