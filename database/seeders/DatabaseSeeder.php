<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(EspecesTableSeeder::class);
        // $this->call(ProductionsTableSeeder::class);
        // $this->call(MoleculesTableSeeder::class);
        $this->call(AnthelmsTableSeeder::class);
        $this->call(Anthelm_MoleculeTableSeeder::class);
    }
}
