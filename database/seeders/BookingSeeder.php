<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::create([
            'user_id' => 3,
            'service_id' => 1,
        ]);

        Booking::create([
            'user_id' => 2,
            'service_id' => 2,
        ]);
    }
}
