<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
    	return view('profil.index',[
    		'title'=>'Profil Saya',
    		'modul_link'=>'',
    		'modul'=>'Profil',
    		'action'=>route('profile.update'),
    		'active'=>''
    	]);
    }

    public function update(Request $request)
    {
    	$user = Auth::user();
        $rule = [
            'nama_lengkap'              => 'required',
            'jabatan'         => 'required',
            'email'            => 'required|unique:users',
            'password'     => 'nullable',
        ];
        if($user->email == $request->email){
            $rule['email'] = 'required';
        }
        $data = [
            'nama_lengkap'    => $request->nama_lengkap,
            'jabatan'         => $request->jabatan,
            'email'           => $request->email,
        ];
        if($request->password){
            $data['password'] = $request->password;
        }
        $request->validate($rule);
        $user->update($data);
        return redirect()->route('profile')->with('success_msg', 'Profil berhasil diperbarui');
    }
}
