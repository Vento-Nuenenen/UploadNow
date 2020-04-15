<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed test admin
        $seededAdminEmail = 'admin@uploadnow.ch';
        $user = User::where('email', '=', $seededAdminEmail)->first();
        if ($user === null){
            $user = User::create([
                'scoutname' => 'Admin',
                'firstname' => 'Admin',
                'lastname' => 'Admin',
                'email' => $seededAdminEmail,
                'password' => Hash::make('password'),
            ]);
            $user->save();
        }

        // Seed test user
        $seededUserEmail = 'caspar.brenneisen@protonmail.ch';
        $user = User::where('email', '=', $seededUserEmail)->first();
        if ($user === null) {
            $user = User::create([
                'scoutname' => 'Vento',
                'firstname' => 'Caspar',
                'lastname' => 'Brenneisen',
                'email' => $seededUserEmail,
                'password' => Hash::make('password'),
            ]);
            $user->save();
        }
    }
}
