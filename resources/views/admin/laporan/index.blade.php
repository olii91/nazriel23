@extends('layouts.admin')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Laporan</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Laporan</li>
            </ol>
        </div>
    </div>
</div>
    <div class="row mt-5">
        <div class="col-lg-6 col-12 mx-auto">
            <div class="card">
                <div class="card-header text-center">
                    Cari Berdasarkan Tanggal
                </div>
                <div class="card-body">
                    <form action="">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="from" id="from" class="form-control" placeholder="Tanggal Awal"
                                onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                        </div>
                        <div class="form-group">
                            <input type="text" name="to" id="to" class="form-control" placeholder="Tanggal Akhir"
                                onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                        </div>
                        {{-- <button type="submit" class="btn btn-primary" style="width: 100%">Cari Laporan</button> --}}
                        <a href="" onclick="this.href='/cetak/'+ document.getElementById('from').value +
                        '/' +document.getElementById('to').value" target="_blank" class="btn btn-danger btn-sm" 
                        style="width: 100%">
                            <i class="fas fa-print fa-fw"></i> PRINT
                    </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection