<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserConnection;
use Carbon\Carbon;
class ReceiveRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserConnection::firstOrCreate([
            'sender_id' => 1,
            'status' => 2,
            'receiver_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        UserConnection::firstOrCreate([
            'sender_id' => 5,
            'status' => 1,
            'receiver_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
         UserConnection::firstOrCreate([
            'sender_id' => 6,
            'status' => 3,
            'receiver_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
         UserConnection::firstOrCreate([
            'sender_id' => 1,
            'status' => 2,
            'receiver_id' => 9,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
         UserConnection::firstOrCreate([
            'sender_id' => 12,
            'status' => 1,
            'receiver_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
