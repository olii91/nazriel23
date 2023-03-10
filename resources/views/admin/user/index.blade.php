@extends('layouts.admin')

@section('css')
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Data Petugas</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Data Petugas</li>
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
                            <a class="btn btn-primary" href="{{ route('user.create') }}" role="button"
                                style="width:100%">Tambah Petugas</a>
                            <h4 class="card-title m-t-20">Data Petugas</h4>
                            <div class="table-responsive m-t-20">
                                <table id="myTable" class="table table-striped border">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">USERNAME</th>
                                            <th scope="col">NAMA</th>
                                            <th scope="col">NO HP</th>
                                            <th scope="col">Jabatan</th>
                                            <th scope="col">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $u)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $u->username }}</td>
                                                <td>{{ $u->name }}</td>
                                                <td>{{ $u->tlpn }}</td>
                                                <td>
                                                    @if ($u->level == 'admin')
                                                        <p class="badge bg-info text-dark">Administrator</p>
                                                    @else
                                                        <p class="badge bg-warning text-dark">{{ ucwords($u->level) }}</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('user.edit', $u->id) }}"
                                                        class="btn btn-outline-success">Edit</a>
                                                    <form action="{{ route('user.destroy', $u->id) }}" method="post"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-outline-danger">Hapus</button>
                                                    </form>
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
@section('js')
@endsection
