<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->updateOrCreate(
            ['email' => 'joao.schias@justeattakeaway.com'],
            [
                'name' => 'João Pedro Schias',
                'email_verified_at' => now(),
                'password' => 'password',
                'remember_token' => Str::random(10),
            ]
        );

    }
}
