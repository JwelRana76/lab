<?php

namespace Database\Seeders;

use App\Models\BloodGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
        foreach ($items as $key => $value) {
            BloodGroup::create([
                'name' => $value,
            ]);
        }
    }
}
