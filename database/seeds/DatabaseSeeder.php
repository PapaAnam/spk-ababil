<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(KaryawanSeeder::class);
        // $this->call(TimeSheetSeeder::class);
        $this->call(KlienSeeder::class);
        $this->call(RekeningSeeder::class);
        $this->call(SatuanSeeder::class);
        $this->call(VendorSeeder::class);
        // $this->call(ProyekSeeder::class);
        // $this->call(TugasSeeder::class);
        // $this->call(GajiSeeder::class);
    }
}
