@extends('layouts.admin')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Dashboard </h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard </li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round align-self-center round-success"><i class="ti-user"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0">{{ $user }}</h3>
                            <h5 class="text-muted m-b-0">Jumlah Petugas</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round align-self-center round-info"><i class="ti-user"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0">{{ $masyarakat }}</h3>
                            <h5 class="text-muted m-b-0">Jumlah Masyarakat</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round align-self-center round-danger"><i class="ti-calendar"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0">{{ $proses }}</h3>
                            <h5 class="text-muted m-b-0">Laporan Yg Proses</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round align-self-center round-success"><i class="ti-settings"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0">{{ $selesai }}</h3>
                            <h5 class="text-muted m-b-0">Laporan Yg Selesai</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->
        <div class="row">
                <div class="card">

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in! ') }}{{ Auth::user()->name }}
                    </div>
                </div>
        </div>
@endsection
