<?php

use Illuminate\Database\Seeder;
use App\Donation;
use App\User;
use Carbon\Carbon;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\UserController;

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

        $MAX_DONANTIONS_NUMBER = 400;

        for ($i = 0; $i < $MAX_DONANTIONS_NUMBER; $i++) {
            $amount = rand(1.0, 200.0);
            $user_id = rand(2, 51);
            
            Donation::create([
                'date' => Carbon::now()->subDays(rand(2,20))->format('Y-m-d'),
                'amount' => $amount,
                'user_id' => $user_id,
                'anonimate' => rand(0,1),
                'fundraiser_id' => rand(1,9),
            ]);

            // Punti utente
            $donationController = new DonationController();
            $user = User::find($user_id);
            $gainedPoints = $donationController->computeGainedPoints($amount);
            $userController = new UserController();
            $userController->addPoints($gainedPoints, $user_id);
        }
    }
}
