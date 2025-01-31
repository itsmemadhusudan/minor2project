<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WesternTableSeeder extends Seeder
{
    /**
     * Seed the database with data from the upload table.
     *
     * @return void
     */
    public function run()
    {
        $uploads = DB::table('upload')->get();
        foreach ($uploads as $upload) {
            DB::table('westerns')->insert([
                'designer_name' => $upload->designer_name,
                'email' => $upload->email,
                'address' => $upload->address,
                'description' => $upload->description,
                'price' => $upload->price,
                'category' => $upload->category,
                'profile_picture' => $upload->profile_picture,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
