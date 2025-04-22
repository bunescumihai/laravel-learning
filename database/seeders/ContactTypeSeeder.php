<?php

namespace Database\Seeders;

use App\Models\ContactType;
use Illuminate\Database\Seeder;

class ContactTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactType::firstOrCreate(['name' => 'Phone']);
        ContactType::firstOrCreate(['name' => 'Email']);
    }
}
