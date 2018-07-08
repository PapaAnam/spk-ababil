<?php

use Illuminate\Database\Seeder;
use App\Satuan;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('set foreign_key_checks=0;');
    	DB::table('satuan')->truncate();
    	$satuan = ['ton','kwintal','kg','ponds','pon','hg','kg','ons','gram','inci','meter','foot','yard','mile','mile','cm','dm','m','dam','hm','km','hektar','are','m2','km2','m³','dm³','liter','cm³','barrel','gallon','liter','rim','lembar','gross','lusin','buah','kodi',];
    	foreach ($satuan as $s) {
    		Satuan::updateOrCreate([
    			'nama'=>$s
    		]);
    	}
    	echo 'satuan berhasil digenerate';
    }
}
