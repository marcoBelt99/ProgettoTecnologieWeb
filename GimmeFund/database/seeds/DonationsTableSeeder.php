<?php

use Illuminate\Database\Seeder;
use App\Donation;

class DonationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Donation::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $donation1 = Donation::create([
            'date' => '2020-01-30',
            'amount' => 1000.00,
            'user_id' => 2,
            'fundraiser_id' => 1,
        ]);

        $donation2 = Donation::create([
            'date' => '2020-01-30',
            'amount' => 3000.00,
            'user_id' => 3,
            'fundraiser_id' => 2,
        ]);

        $donation3 = Donation::create([
            'date' => '2020-01-30',
            'amount' => 4000.00,
            'user_id' => 3,
            'fundraiser_id' => 2,
        ]);
    }
}
