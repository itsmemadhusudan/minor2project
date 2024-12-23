<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\UserDetail;

class MigrateUserData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:userdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate user data from users table to user_details table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch all users from the users table
        $users = User::all();

        // Loop through each user and create/update corresponding user_detail record
        foreach ($users as $user) {
            UserDetail::updateOrCreate(
                ['user_id' => $user->id], // Condition to find existing record
                [
                    'name' => $user->name,
                    'email' => $user->email
                ] // Data to update/create
            );
        }

        // Output a success message
        $this->info('User data migrated successfully.');
    }
}
