<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PassportTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        User::factory(10)->create();
    }
}
