<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['title' => 'Selected'],
            ['title' => 'Ongoing/Started'],
            ['title' => 'Completed'],
            ['title' => 'Verified'],
            ['title' => 'Approved'],
            ['title' => 'Rejected'],
            ['title' => 'Deleted'],
        ];

        foreach ($statuses as $status) {
            \App\Models\Status::create($status);
        }
    }
}
