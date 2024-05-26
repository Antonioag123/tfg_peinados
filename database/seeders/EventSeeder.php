<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     
        Event::create([
            'event'=>'hair wedding',
            'start_date'=>'2024-05-29 09:00',
            'end_date'=>'2024-05-29 09:30',
            'booking_id'=>1
        ]);
        Event::create([
            'event'=>'Book hair',
            'start_date'=>'2024-05-27 11:00',
            'end_date'=>'2024-05-27 12:00',
            'booking_id'=>2
        ]);

        
       
    }
}
