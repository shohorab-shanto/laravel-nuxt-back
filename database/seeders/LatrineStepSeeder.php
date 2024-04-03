<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LatrineStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $latrineSteps = [
            ['title' => 'Plot image'],
            ['title' => 'Twin pit image'],
            ['title' => 'Interior image'],
            ['title' => 'Exterior with beneficiary image'],
            ['title' => 'Site completion/ Handover image'],
        ];

        foreach ($latrineSteps as $latrineStep) {
            \App\Models\LatrineStep::create($latrineStep);
        }
    }
}
