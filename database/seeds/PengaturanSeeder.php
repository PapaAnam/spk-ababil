<?php

use Illuminate\Database\Seeder;
use App\Pengaturan;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengaturan::updateOrCreate([
        	'key'	=> 'font',
        ], [
        	'value' => 'https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet',
        ]);
        Pengaturan::updateOrCreate([
        	'key'	=> 'style_font',
        ], [
        	'value' => 'font-family: \'Roboto Condensed\', sans-serif;',
        ]);
        Pengaturan::updateOrCreate([
        	'key'	=> 'nama_aplikasi',
        ], [
        	'value' => '<b>HRMS</b> PAN',
        ]);
        Pengaturan::updateOrCreate([
        	'key'	=> 'nama_aplikasi_mobile',
        ], [
        	'value' => '<b>HR</b>MS',
        ]);
        Pengaturan::updateOrCreate([
        	'key'	=> 'nama_aplikasi_footer',
        ], [
        	'value' => 'HRMS PAN',
        ]);
        Pengaturan::updateOrCreate([
        	'key'	=> 'skin',
        ], [
        	'value' => 'skin-blue',
        ]);
        Pengaturan::updateOrCreate([
        	'key'	=> 'versi',
        ], [
        	'value' => '1.0.0',
        ]);
        Pengaturan::updateOrCreate([
        	'key'	=> 'tahun',
        ], [
        	'value' => '2018',
        ]);
    }
}
