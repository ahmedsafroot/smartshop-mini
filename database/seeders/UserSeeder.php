<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => config('app.user.email')],
            [
            'name' => config('app.user.name'),
            'email' => config('app.user.email'),
            'password' => Hash::make(config('app.user.password')),
            'role' => 'customer',
        ]);
    }
}
