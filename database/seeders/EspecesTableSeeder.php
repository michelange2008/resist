<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class EspecesTableSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeders/csvs/especes.csv';
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
