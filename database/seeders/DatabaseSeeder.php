<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Enums\RolesEnum;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'test@test.pl',
            'password' => Hash::make('testtest'),
            'role' => RolesEnum::ADMINISTRATOR,
        ]);
    }
}
