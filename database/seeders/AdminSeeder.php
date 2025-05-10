<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = new User();

        $user->fill([
            'name' => 'Admin',
            'address' => 'Admin address',
            'image' => 'image',
            'email' => 'admin@isa.sa'
        ]);

        $user->password = Hash::make("Mihai123!");
        $user->assignRole('admin');

        $user->save();
    }
}
