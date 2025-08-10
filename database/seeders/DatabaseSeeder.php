<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $user=\App\Models\User::factory()->create([
             'name' => 'Zaeem',
             'email' => 'zaeem@gmail.com',
             'password' => Hash::make('zaeem123'),
         ]);
        $user->assignRole('admin');
    }
}
