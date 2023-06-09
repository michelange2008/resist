<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class Anthelm_MoleculeTableSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeders/csvs/anthelms_molecules.csv';
        $this->timestamps = false;
        $this->tablename = "anthelm_molecule";
    }
    /**Anthelms_MoleculesTableSeeder
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::disableQueryLog();
        parent::run();
    }
}
