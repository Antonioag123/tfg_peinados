<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Juan',
            'password'=>'1234',
            'email'=>'j@gmail.com',
            'phone'=>'678950483'
        ]);
        User::create([
            'name'=>'Maria',
            'password'=>'1234',
            'email'=>'m@gmail.com',
            'phone'=>'672923812'
        ]);
        User::create([
            'name'=>'Raul',
            'password'=>'1234',
            'email'=>'r@gmail.com',
            'phone'=>'634232122'
        ]);
    }
}
