<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AlternativeData;
use App\Models\MasterGapValue;
use App\Models\MasterSubCriteria;
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
        $this->call([
            RolesSeeder::class,
            UserSeeder::class,
            FaktorSeeder::class,
            MasterCriteriaSeeder::class,
            MasterSubCriteriaSeeder::class,
            AlternativeDataSeeder::class,
            AlternatifSubkriteriaSeeder::class,
            MasterGapValueSeeder::class,
            MasterIdealValueSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
