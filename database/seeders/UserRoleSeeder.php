<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->where('email', 'admin@example.com')->update(['role' => 'admin']);
        DB::table('users')->where('email', 'designer@example.com')->update(['role' => 'designer']);
    }
}
