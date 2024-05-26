<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name' => 'Hair wedding',
            'description' => 'Amazing hair',
            'price' => 200.00,
        ]);
        Service::create([
            'name' => 'Hair normal',
            'description' => 'Normal hair',
            'price' => 45.00,
        ]);
        Service::create([
            'name' => 'Cut Hair',
            'description' => 'Cutting hair',
            'price' => 52.50,
        ]);
        Service::create([
            'name' => 'Color hair',
            'description' => 'Coloring hair',
            'price' => 19.50,
        ]);
    }
}
