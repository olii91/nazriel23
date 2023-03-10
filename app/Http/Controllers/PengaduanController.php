<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengaduanController extends Controller
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
        ->get();
        return view('masyarakat.pengaduan', compact('pengaduan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $masyarakat = Masyarakat::all();
        return view('masyarakat.pengaduancreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'isi_pengaduan' => 'required',
            'foto' => 'required',
        ]);
        
        try {
            $pengaduan = new Pengaduan();
            $pengaduan->tgl_pengaduan = date('Y-m-d h:i:s');
            $pengaduan->id_masyarakat = Auth::guard('masyarakat')->user()->id;
            $pengaduan->isi_pengaduan = $request->isi_pengaduan;
            $pengaduan->status = '0';
            if ($request->hasFile('foto')) {
                $request->file('foto')->move('foto-pengaduan/', $request->file('foto')->getClientOriginalName());
                $pengaduan->foto = $request->file('foto')->getClientOriginalName();
            }
            $pengaduan->save();
        } catch (\Exception $e)
        {
            dd($e->getMessage());
        }
        return redirect('pengaduan')->with('success', 'Pengaduan Berhasil di tambah');
        
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_pengaduan)
    {
        $pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan)->with('masyarakat')->get()->first();
        $tanggapan = Tanggapan::where('id_pengaduan', $id_pengaduan)->with('user')->get()->first();
        return view('masyarakat.pengaduanshow', compact('pengaduan','tanggapan'));
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
