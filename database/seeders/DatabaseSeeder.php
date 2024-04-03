<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\Beneficiary::factory(10)->create();
        //  \App\Models\User::factory(3)->create();

        $this->call([
            DesignationSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            ModuleSeeder::class,
            StatusSeeder::class,
            LatrineStepSeeder::class,
        ]);

        Artisan::call('BangladeshGeocode:setup');
    }
}
