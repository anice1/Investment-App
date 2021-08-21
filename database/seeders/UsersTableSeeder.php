<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'role' => '1',
            'ref_code' => 'Admin'.'-'.random_int(10, 700000),
            'ref_by' => '0',
            'password' => '$2y$10$dIb.9Umoh6LMhNLBwvHqGecma4OjvsdyZ3n3p2s7AxN5m4U0/ihri', // Meet-Administrator-Django!12-Ac-Nice
            // 'ref_code' => 'Admin'.'-'.random_int(10, 50000),
            // 'ref_by' => '0',
            'remember_token' => \Str::random(10),
            ]);
                


        \DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'super@gmail.com',
            'email_verified_at' => now(),
            'role' => '2',
            'ref_code' => 'Super'.'-'.random_int(10, 700000),
            'ref_by' => '0',
            'password' => '$2y$10$dIb.9Umoh6LMhNLBwvHqGecma4OjvsdyZ3n3p2s7AxN5m4U0/ihri', // Meet-Admnistrator-Django!12-Ac-Nice
            // 'ref_code' => 'Super'.'-'.random_int(10, 50000),
            // 'ref_by' => '0',
            'remember_token' => \Str::random(10),
            ]);

            // \DB::table('users')->insert([
            //     'name' => 'teckbot',
            //     'email' => 'user@gmail.com',
            //     'email_verified_at' => now(),
            //     'role' => '0',
            //     'ref_code' => random_int(10, 700000),
            //     'password' => '$2y$10$qdxQYR3BCEkdqbpQEaZQoOQ5x.1IjNj6H49jW.JuQgIeWjazXRIDW', // qwertyuiiop
            //     'remember_token' => \Str::random(10),
            //     ]);
    }
}
