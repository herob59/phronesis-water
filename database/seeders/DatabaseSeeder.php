<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\SalesSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SalesSeeder::class,
        ]);
    }
}
