<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 10; $i++) {
            Vendor::Create([
                'name' => "ahmed" . $i,
                'email' => "ahmed$i@gmail.com",
                'password' => Hash::make('password'),
            ]);
        }
    }
}
