<?php

use Illuminate\Database\Seeder;
use App\User;

class GenerateUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	if(User::count()<=0){
    		DB::statement('set foreign_key_checks=0;');
    		DB::table('user')->truncate();
    	}
    	User::updateOrCreate([
    		'email'=>'superadmin@spkababil.com',
    	],[
    		'role'=>'superadmin',
    		'nama_lengkap'=>'Super Admin',
    		'jabatan'=>'IT Manager',
    		'password'=>bcrypt('superadmin')
    	]);
    	User::updateOrCreate([
    		'email'=>'admin@spkababil.com',
    	],[
    		'role'=>'admin',
    		'nama_lengkap'=>'Admin',
    		'jabatan'=>'IT Consultant',
    		'password'=>bcrypt('admin')
    	]);
    	User::updateOrCreate([
    		'email'=>'finance@spkababil.com',
    	],[
    		'role'=>'finance',
    		'nama_lengkap'=>'Finance',
    		'jabatan'=>'Finance Manager',
    		'password'=>bcrypt('finance')
    	]);
    }
}
