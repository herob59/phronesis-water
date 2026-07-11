<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;
use Carbon\Carbon;

class SalesSeeder extends Seeder
{
    public function run(): void
    {
        Sale::truncate();

        $days = [
            ['Monday', 25000],
            ['Tuesday', 32000],
            ['Wednesday', 28000],
            ['Thursday', 45000],
            ['Friday', 55000],
            ['Saturday', 70000],
            ['Sunday', 40000],
        ];

        foreach ($days as $index => $day) {

            Sale::create([
                'product_id' => 1, // make sure product ID 1 exists
                'quantity'   => rand(10, 50),
                'total'      => $day[1],
                'created_at' => Carbon::now()
                    ->startOfWeek()
                    ->addDays($index),
                'updated_at' => now(),
            ]);
        }
    }
}
