<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WesternSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch all records from the upload table
        $uploads = DB::table('upload')->get();

        foreach ($uploads as $upload) {
            // Insert records into the western table
            DB::table('western')->updateOrInsert(
                ['upload_id' => $upload->id], // Use upload_id as a unique key
                [
                    'designer_name' => $upload->designer_name,
                    'email' => $upload->email,
                    'address' => $upload->address,
                    'description' => $upload->description,
                    'price' => $upload->price,
                    'category' => $upload->category,
                    'profile_picture' => $upload->profile_picture,
                    'upload_id' => $upload->id, // Store the upload ID
                ]
            );
        }
    }
}
