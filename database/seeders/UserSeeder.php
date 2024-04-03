<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456'),
            'type' => 'official',
            'nid' => fake()->unique()->randomNumber(9),
        ]);
        $user->roles()->sync(1);

        $le = User::create([
            'name' => 'LE 1',
            'password' => Hash::make('123456'),
            'nid' => fake()->unique()->randomNumber(9),
            'type' => "le",
            'phone' => "01303054266",
            'gender' => "male",
            'religion' => "islam",
            'division_id' => "4",
            'district_id' => "34",
            'upazila_id' => "259",
            'union_id' => "2329",
            'status' => 1,

        ]);
        $le->roles()->sync(3);

    }
}
