<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example: Update users by their emails or other identifiers to assign roles
        DB::table('users')->where('email', 'admin@example.com')->update(['role' => 'admin']);
        DB::table('users')->where('email', 'designer@example.com')->update(['role' => 'designer']);
        // Add more users as needed
    }
}
