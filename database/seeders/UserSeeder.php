<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(['email' => 'sobiamehboob@test.com'], [
            'name' => 'sobiamehboob',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123456789'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        User::factory(20)->create();
    }
}
