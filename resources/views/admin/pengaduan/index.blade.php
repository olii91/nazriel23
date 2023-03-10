@extends('layouts.admin')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Pengaduan Masyarakat</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Pengaduan Masyarakat</li>
            </ol>
        </div>
    </div>
</div>
    <div id="main-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title m-t-20">Data Pengaduan</h4>
                            <div class="table-responsive m-t-20">
                                <table id="myTable" class="table table-striped border">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Masyarakat</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Isi Laporan</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pengaduan as $p)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $p->masyarakat->name }}</td>
                                                <td>{{ $p->tgl_pengaduan }}</td>
                                                <td>{{ $p->isi_pengaduan }}</td>
                                                <td>
                                                    @if ($p->status == '0')
                                                        <p class="badge bg-danger">Pending</p>
                                                    @elseif($p->status == 'proses')
                                                        <p class="badge bg-warning text-dark ">{{ ucwords($p->status) }}</p>
                                                    @else
                                                        <p class="badge bg-success">{{ ucwords($p->status) }}</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a
                                                        href="{{ route('pengaduanadmin.show', $p->id_pengaduan) }}">Detail</a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="./assets/node_modules/jquery/dist/jquery.min.js"></script>
    <script>
        $(function() {
            $('#myTable').DataTable();
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group +
                                '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            })
        });
    </script>
@endsection


