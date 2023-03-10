<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $selesai = DB::table('pengaduan')->where('status', 'selesai')->count();
        $proses = DB::table('pengaduan')->where('status', 'proses')->count();
        $masyarakat = DB::table('masyarakat')->count();
        $user = DB::table('users')->count();
        return view('home', compact('proses','selesai','masyarakat','user'));
    }
}
