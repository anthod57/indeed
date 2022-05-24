<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offers;
use App\Models\User;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();
        Offers::factory(5)->create();
    }
}
