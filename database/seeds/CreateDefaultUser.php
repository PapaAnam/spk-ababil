<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class CreateDefaultUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$role = Role::updateOrCreate([
    		'nama'=>'superadmin',
    	],[
    		'hak_akses'=>'{"dasbor":"on","progress":"on","progress_tugas":"on","progress_proyek":"on","jurnal":"on","timesheet":"on","timsheet_create":"on","laporan_progress_kerja_harian":"on","konsumsi_bbm":"on","jam_alat":"on","memo":"on","proyek":"on","proyek_create":"on","tugas":"on","tugas_create":"on","invoice":"on","invoice_create":"on","pengeluaran":"on","pengeluaran_create":"on","karyawan":"on","karyawan_create":"on","keuangan":"on","keuangan_create":"on","klien":"on","klien_create":"on","armada":"on","armada_create":"on","setting":"on","setting_uam":"on","setting_vendor":"on","setting_satuan":"on","setting_rekening":"on","setting_kategori_armada":"on","setting_role_maker":"on"}'
    	]);
    	User::updateOrCreate([
    		'email'=>'superadmin@spkababil.com',
    	],[
    		'password'=>bcrypt('superadmin'),
    		'nama_lengkap'=>'Superadmin',
    		'jabatan'=>'Superadmin',
    		'id_role'=>$role->id,
    	]);
    }
}
