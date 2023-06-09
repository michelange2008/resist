<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class MoleculesTableSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeders/csvs/molecules.csv';
        $this->timestamps = false;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::disableQueryLog();
        parent::run();
    }
}
