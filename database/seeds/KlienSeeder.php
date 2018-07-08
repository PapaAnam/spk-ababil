<?php

use Illuminate\Database\Seeder;
use App\Klien;

class KlienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('set foreign_key_checks=0;');
    	DB::table('klien')->truncate();
    	$faker = \Faker\Factory::create('id_ID');
    	foreach (range(1,50) as $a) {
    		$klien = Klien::create([
    			'nama_perusahaan'=>$faker->company,
    			'alamat'=>$faker->address,
    		]);
    		foreach (range(1, $faker->numberBetween(1,5)) as $i) {
    			$gender = $faker->randomElement(['male','female']);
    			$tipe = $gender == 'male' ? 'bapak' : 'ibu';
    			$klien->pic()->create([
    				'tipe' => $tipe,
    				'nama' => $faker->name($gender),
    				'no_hp' => $faker->unique()->phoneNumber,
    			]);
    		}
    	}
    }
}
