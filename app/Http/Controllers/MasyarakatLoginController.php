<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class MasyarakatLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth-masyarakat.login');
    }
    public function register()
    {
        return view('auth-masyarakat.register');
    }
    public function actionlogin(Request $request)
    {
        // dd($request->all());

        try {
            $username = Masyarakat::where('username', $request->username)->first();
            $password = Hash::check($request->password, $username->password);
        
            if (Auth::guard('masyarakat')->attempt(['username' => $request->username, 'password' => $request->password])) {
                return redirect('pengaduan');
            } else {
                throw new Exception('Username atau password salah!');
            }
        
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function actionregister(Request $request)
    {
        $request->validate([
            'nik' => ['required', 'unique:masyarakat', 'numeric'],
            'name' => ['required'],
            'username' => ['required','unique:masyarakat'],
            'password' => ['required'],
            'tlpn' => ['required', 'numeric'],
        ]);

        try {
            // dd($request->all());
            $masyarakat = new Masyarakat();
            $masyarakat->nik = $request->nik;
            $masyarakat->name = $request->name;
            $masyarakat->username = $request->username;
            $masyarakat->password = Hash::make($request->password);
            $masyarakat->tlpn = $request->tlpn;
            $masyarakat->save();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        return redirect()->route('masyarakat.login')->with('success', 'Data Masyarakat berhasil di simpan.');
    
    }
}
