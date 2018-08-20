<?php

use Illuminate\Database\Seeder;
use App\Karyawan;


class TimeSheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('set foreign_key_checks=0;');
    	DB::table('time_sheet')->truncate();
    	$faker  = \Faker\Factory::create('id_ID');
    	$karyawan = Karyawan::all();
    	$tanggal = [];
    	foreach (range(0, 30) as $i) {
    		$tanggal[] = date('Y-m-d', strtotime('-'.$i.' days'));
    	}
    	$jam = [];
    	foreach (range(17, 23) as $i) {
    		$jam[] = $i.':00:00';
    		$jam[] = $i.':15:00';
    		$jam[] = $i.':30:00';
    		$jam[] = $i.':45:00';
    	}
    	foreach ($karyawan as $k) {
    		$data = [];
    		foreach ($tanggal as $t) {
    			$data[] = [
    				'tanggal'=>$t,
    				'id_karyawan'=>$k->id,
    				'jam_mulai'=>'08:00:00',
    				'jam_selesai'=>$faker->randomElement($jam),
    				'ritase'=>$k->jenis === 'Sopir' ? $faker->randomElement(range(1,15)) : 0,
    				'lembur'=>$k->jenis === 'Sopir' ? $faker->randomElement(range(1,7)) : 0,
    				'istirahat'=>$faker->randomElement(range(1,3)+[0.1,0.2,0.3,0.4,0.5,0.6,0.7,0.8,0.9,0]),
    			];
    		}
    		DB::table('time_sheet')->insert($data);
    	}
    	echo 'Time sheet berhasil diseeder';
    }
}
