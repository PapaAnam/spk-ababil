<?php

use Illuminate\Database\Seeder;
use App\Tugas;

class TugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('set foreign_key_checks=0;');
    	DB::table('tugas')->truncate();
    	$faker = \Faker\Factory::create('id_ID');
    	$proyek = DB::table('proyek')->get()->pluck('id')->toArray();
    	$karyawan = DB::table('karyawan')->get()->pluck('id')->toArray();
    	$satuan = DB::table('satuan')->get()->pluck('id')->toArray();
    	foreach (range(1,50) as $a) {
    		$start_date = date('Y-m-d', strtotime('-'.$faker->numberBetween(1,30)));
    		$end_date = date('Y-m-d', strtotime($start_date)+3600*24*$faker->numberBetween(1,30));
    		$tugas = Tugas::create([
    			'id_proyek'=>$faker->randomElement($proyek),
    			'deskripsi'=>$faker->text,
    			'qty'=>$faker->numberBetween(1,1000),
    			'satuan'=>$faker->randomElement($satuan),
    			'start_date'=>$start_date,
    			'end_date'=>$end_date,
    		]);
    		foreach (range(1, $faker->numberBetween(1,5)) as $i) {
    			$gender = $faker->randomElement(['male','female']);
    			$tipe = $gender == 'male' ? 'bapak' : 'ibu';
    			$tugas->pelaksana()->create([
    				'id_pelaksana' => $faker->randomElement($karyawan),
    			]);
    		}
    	}
    }
}
