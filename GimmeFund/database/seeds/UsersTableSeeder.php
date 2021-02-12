<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Serve per avere le password cifrate
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Creo le 2 tabelle: una per i ruoli degli utenti (admin o utente generico), l'altra per gli utenti  */
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('role_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        /* Dichiaro ed inizializzo 2 variabili: una per l'admin, l'altra per lo user */
        $adminRole = Role::where('name', 'Admin')->first();
        $userRole = Role::where('name', 'User')->first();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Creazione dell'utente admin
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@gimmefund.com',
            'password' => Hash::make('password'),
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user1 = User::create([
            'first_name' => 'Davide', 
            'last_name' => 'Zanellato',
            'email' => 'davide@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Enrico Fermi, 299',
            'city' => 'Taglio di Po',
            'CAP' => '45019',
            'phone_number' => '3472460103',
            'birthday' => '1999-11-29',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user2 = User::create([
            'first_name' => 'Marco', 
            'last_name' => 'Beltrame',
            'email' => 'marco@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Domenico Sampieri, 74',
            'city' => 'Adria',
            'CAP' => '45011',
            'points' => 0,
            'phone_number' => '3403183848',
            'birthday' => '1999-08-30',
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user3 = User::create([
            'first_name' => 'Francesco', 
            'last_name' => 'Sindaco',
            'email' => 'francesco@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Domenico Sampieri, 139/A',
            'city' => 'Adria',
            'CAP' => '45011',
            'phone_number' => '3206479281',
            'birthday' => '1999-04-28',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user4 = User::create([
            'first_name' => 'Enrico',
            'last_name' => 'Bregoli',
            'email' => 'enrico@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via dei Bersaglieri, 4',
            'city' => 'Taglio di Po',
            'CAP' => '45019',
            'phone_number' => '3338087889',
            'birthday' => '1999-06-18',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);
        
        /* Gestione delle chiavi esterne: chiamo il metodo attach() per attaccare la chiave esterna */
        $admin->roles()->attach($adminRole);
        $user1->roles()->attach($userRole);
        $user2->roles()->attach($userRole);
        $user3->roles()->attach($userRole);
        $user4->roles()->attach($userRole);
    }
}
