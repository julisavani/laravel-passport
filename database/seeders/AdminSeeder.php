<?php

namespace Database\Seeders;

use App\Models\RoleGroup;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
        DB::table('role_groups')->insert([
            [
            'RoleId' => 1,
            'Name' => 'User',
            'Description' => '',
            'Status' => 1
        ],[
            'RoleId' => 2,
            'Name' => 'Admin',
            'Description' => '',
            'Status' => 1
        ]]);
        User::create([
            'first_name' => 'Admin',
            'last_name' => '',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'RoleId' => 1,
            'Status' => 1
        ]);
    }
}
