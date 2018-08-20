<?php

use Illuminate\Database\Seeder;
use App\Karyawan;
use App\Gaji;
use App\TimeSheet;

class GajiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('set foreign_key_checks=0;');
    	DB::table('gaji')->truncate();
    	$faker  = \Faker\Factory::create('id_ID');
    	$karyawan = Karyawan::all();
    	$tanggal_dari = date('Y-m-d', strtotime('-30 days'));
    	$tanggal_sampai = date('Y-m-d');
    	$data = [];
    	$jumlahHariTimeSheet = floor((strtotime($tanggal_sampai) - strtotime($tanggal_dari)) / 3600 / 24);
    	foreach ($karyawan as $k) {
    		$timeSheet = TimeSheet::where('id_karyawan', $k->id)
    		->whereBetween('tanggal', [
    			$tanggal_dari, $tanggal_sampai
    		])->get();
    		$totalJamKerja  = $timeSheet->sum('total_jam');
    		$jumlahInsentif = $timeSheet->sum('ritase');
    		$jumlahLembur   = $timeSheet->sum('lembur');
    		if($k->jenis != 'Sopir'){
    			$jumlahLembur = ($totalJamKerja - 200) > 0 ? $totalJamKerja - 200 : 0;
    		}
    		$data[] = [
    			'tanggal_dari'=>$tanggal_dari, 
    			'tanggal_sampai'=>$tanggal_sampai, 
    			'id_karyawan'=>$k->id, 
    			'plat_no'=>$faker->word, 
    			'total_jam_kerja'=>$totalJamKerja, 
    			'gaji_pokok'=>$k->gaji_pokok, 
    			'rate_per_jam'=>$k->jenis === 'Operator' ? $k->rate_per_jam : 0, 
    			'um_harian'=>$k->um_harian, 
    			'jumlah_hari_timesheet'=>$jumlahHariTimeSheet, 
    			'rate_insentif'=>$k->jenis === 'Sopir' ? $k->insentif : 0, 
    			'jumlah_insentif'=>$k->jenis === 'Sopir' ? $jumlahInsentif : 0, 
    			'rate_lembur'=>$k->rate_lembur, 
    			'jumlah_lembur'=>$jumlahLembur, 
    			'tanggal'=>date('Y-m-d'), 
    			'jabatan'=>$k->jabatan, 
    			'armada'=>$k->armada, 
    			'jenis'=>$k->jenis,
    		];
    	}
    	DB::table('gaji')->insert($data);
    	$gaji = Gaji::all();
    	$data = [];
    	foreach ($gaji as $g) {
    		// jumlah pengeluaran
    		foreach (range(1,$faker->randomElement(range(0,3))) as $d) {
    			$data[] = [
    				'jumlah'=>$faker->numberBetween(200000, 3000000),
    				'deskripsi'=>$faker->word.' '.$faker->word.' '.$faker->word,
    				'id_gaji'=>$g->id
    			];	
    		}
    	}
    	DB::table('gaji_pengeluaran')->insert($data);
    	echo 'Gaji berhasil diseeder';
    }
}
