<?php

use Illuminate\Database\Seeder;

class RekeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('set foreign_key_checks=0;');
    	DB::table('rekening')->truncate();
    	$faker = \Faker\Factory::create('id_ID');
    	foreach (range(1,20) as $a) {
    		DB::table('rekening')->insert([
    			'bank'=>$faker->randomElement(['BNI','BTN','BRI','BCA','MANDIRI','BANK MEGA','DANAMON']),
    			'atas_nama'=>$faker->name,
    			'no_rek'=>$faker->numberBetween(100000,999999)*$faker->numberBetween(100000,999999),
    			'kantor_cabang'=>$faker->city,
    		]);
    	}
    	echo 'rekening berhasil digenerate';
    }
}
