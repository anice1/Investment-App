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
            'password' => '$2y$10$dIb.9Umoh6LMhNLBwvHqGecma4OjvsdyZ3n3p2s7AxN5m4U0/ihri', // Meet-Administrator-Django!12-Ac-Nice
            // 'ref_code' => 'Admin'.'-'.random_int(10, 50000),
            // 'ref_by' => '0',
            'remember_token' => \Str::random(10),
            ]);
            \DB::table('referal')->insert([
                'ref_code' => 'Admin'.'-'.random_int(10, 50000),
                'ref_by' => '0',
                'user_id' => '1',
                ]);
                


        \DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'super@gmail.com',
            'email_verified_at' => now(),
            'role' => '2',
            'password' => '$2y$10$dIb.9Umoh6LMhNLBwvHqGecma4OjvsdyZ3n3p2s7AxN5m4U0/ihri', // Meet-Administrator-Django!12-Ac-Nice
            // 'ref_code' => 'Super'.'-'.random_int(10, 50000),
            // 'ref_by' => '0',
            'remember_token' => \Str::random(10),
            ]);
            \DB::table('referal')->insert([
                'ref_code' => 'Super'.'-'.random_int(10, 50000),
                'ref_by' => '0',
                'user_id' => '2',
                ]);
    }
}
