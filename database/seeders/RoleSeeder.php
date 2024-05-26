<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name'=>'admin',
            'description'=>'He can make changes to the website'
        ]);
        Role::create([
            'name'=>'user',
            'description'=>'He can buy products, use the IA, value the website and see the appointment on the calendar.'
        ]);
        Role::create([
            'name'=>'anonymous',
            'description'=>'He just can see the website.'
        ]);

        DB::table('role_user')->insert([
            'role_id'=> 1,
            'user_id'=> 1
        ]);

        DB::table('role_user')->insert([
            'role_id'=>2,
            'user_id'=>2
        ]);
        DB::table('role_user')->insert([
            'role_id'=>2,
            'user_id'=>3
        ]);

    }
}
