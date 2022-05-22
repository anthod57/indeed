<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offers;
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
        Offers::factory(10)->create();
    }
}
