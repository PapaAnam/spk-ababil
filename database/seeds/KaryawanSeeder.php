<?php

use Illuminate\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('set foreign_key_checks=0;');
    	DB::table('karyawan')->truncate();
    	$faker = \Faker\Factory::create('id_ID');
    	foreach (range(1,100) as $a) {
    		DB::table('karyawan')->insert([
    			'nama'=>$faker->name,
    			'nik'=>$faker->nik,
    			'alamat'=>$faker->address,
    			'no_hp'=>$faker->phoneNumber,
    			'no_darurat'=>$faker->phoneNumber,
    			'jabatan'=>$faker->jobTitle,
    			'armada'=>str_random(10),
    			'gaji_pokok'=>$faker->numberBetween(1000000,10000000),
    			'rate_per_jam'=>$faker->numberBetween(100000,1000000),
    			'um_harian'=>$faker->numberBetween(100000,1000000),
    			'rate_lembur'=>$faker->numberBetween(100000,1000000),
    			'insentif'=>$faker->numberBetween(1000000,10000000),
    		]);
    	}
    }
}
