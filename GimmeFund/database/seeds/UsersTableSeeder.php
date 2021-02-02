<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::truncate();

        DB::table('users')->truncate();
        // Creazione dell'utente admin
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@gimmefund.com',
            'password' => Hash::make('password'),
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        User::create([
            'first_name' => 'Davide', 
            'last_name' => 'Zanellato',
            'email' => 'davide@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Enrico Fermi, 299',
            'city' => 'Taglio di Po',
            'CAP' => '45019',
            'phone_number' => '3472460103',
            'birthday' => '1999-11-29',
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        User::create([
            'first_name' => 'Marco', 
            'last_name' => 'Beltrame',
            'email' => 'marco@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Domenico Sampieri, 74',
            'city' => 'Adria',
            'CAP' => '45011',
            'phone_number' => '3403183848',
            'birthday' => '1999-08-30',
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        User::create([
            'first_name' => 'Francesco', 
            'last_name' => 'Sindaco',
            'email' => 'francesco@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Domenico Sampieri, 139/A',
            'city' => 'Adria',
            'CAP' => '45011',
            'phone_number' => '3206479281',
            'birthday' => '1999-04-28',
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        User::create([
            'first_name' => 'Enrico',
            'last_name' => 'Bregoli',
            'email' => 'enrico@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via dei Bersaglieri, 4',
            'city' => 'Taglio di Po',
            'CAP' => '45019',
            'phone_number' => '3338087889',
            'birthday' => '1999-06-18',
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);
    }
}
