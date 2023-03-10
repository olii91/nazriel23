<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengaduanSayaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengaduan = DB::table('pengaduan')
        ->leftjoin('tanggapan', 'pengaduan.id_pengaduan', '=', 'tanggapan.id_pengaduan')
        ->join('masyarakat', 'pengaduan.id_masyarakat', '=', 'masyarakat.id')
        ->join('users', 'tanggapan.id_user', '=', 'users.id')
        ->select('pengaduan.*', 'tanggapan.*', 'masyarakat.name as name_masyarakat', 'users.name as name_petugas')
        ->orderBy('tgl_pengaduan', 'desc')
        ->where('pengaduan.id_masyarakat', Auth::guard('masyarakat')->id())
        ->get();
        return view('masyarakat.pengaduansaya', compact('pengaduan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
