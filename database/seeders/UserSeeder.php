<?php

namespace Database\Seeders;

use App\Models\CadUser;
use Illuminate\Database\Seeder;
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
        CadUser::firstOrCreate([
            'email' =>  'admin@example.com',
            'role_id' =>  1,
        ],[
            'name' => 'Admin',
            'password' => Hash::make('123456'),
            'is_active' => 1,
            'is_approved' => 1,
        ]);

        CadUser::firstOrCreate([
            'email' =>  'user@example.com',
            'role_id' =>  2,
        ],[
            'name' => 'User',
            'password' => Hash::make('123456'),
            'is_active' => 1,
            'is_approved' => 1,
        ]);
    }
}
