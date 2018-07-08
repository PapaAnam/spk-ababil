<?php

use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('set foreign_key_checks=0;');
    	DB::table('vendor')->truncate();
    	$faker = \Faker\Factory::create('id_ID');
    	foreach (range(1,50) as $a) {
    		DB::table('vendor')->insert([
    			'nama'=>str_random(10),
    			'telp'=>$faker->phoneNumber,
    			'alamat'=>$faker->address,
    			'keterangan'=>'Ini hanyalah contoh',
    		]);
    	}
    	echo 'vendor berhasil digenerate';
    }
}
