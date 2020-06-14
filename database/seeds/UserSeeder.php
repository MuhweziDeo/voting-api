<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(0, 10) as $number) {
            $rand = rand(0, 1);
            $party_rand = rand(0, 4);
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'is_candidate'=> $rand == 0 ? false : true,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at' =>\Carbon\Carbon::now(),
                'party'=> \App\User::$parties[$party_rand]
            ]);
        }
    }
}
