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
        DB::table('users')->truncate();
        // Creazione utente admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);
        
        // Creazione dell'utente generico
        User::create([
            'name' => 'Generic User',
            'email' => 'user@user.com',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('y-m-d h:i:s')
        ]);
    }
}
