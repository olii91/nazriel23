@extends('layouts.admin')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Data Masyarakat</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Data Masyarakat</li>
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
                            <a class="btn btn-primary" href="{{ route('masyarakat.create') }}" role="button"
                                style="width:100%">Tambah Masyarakat</a>
                            <h4 class="card-title m-t-20">Data Masyarakat</h4>
                            <div class="table-responsive m-t-20">
                                <table id="myTable" class="table table-striped border">
                                    <thead>
                                        <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">NIK</th>
                                          <th scope="col">NAMA</th>
                                          <th scope="col">USERNAME</th>
                                          <th scope="col">NO HP</th>
                                          <th scope="col">AKSI</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($masyarakat as $m)
                                        <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>{{ $m->nik }}</td>
                                          <td>{{ $m->name }}</td>
                                          <td>{{ $m->username }}</td>
                                          <td>{{ $m->tlpn }}</td>
                                          <td>
                                              <a href="{{route('masyarakat.edit',$m->id)}}" class="btn btn-outline-success">Edit</a>
                                              <form action="{{ route('masyarakat.destroy', $m->id) }}" 
                                                  method="post" class="d-inline">
                                              @csrf
                                              @method('delete')
                                              <button type="submit" class="btn btn-outline-danger">Hapus</button>
                                              </form>
                      
                                              {{-- <a href="{{route('siswa.edit',$m->id)}}" class="btn btn-sn btn-primary"
                                                  title="Edit"><i class="far fa-edit"></i></a>
                                                  <x-adminlte-button class="btn btn-sn btn-danger"  data-toggle="modal" data-target="#hapussiswa{{$loop->iteration}}" icon="far fa-trash-alt" class="bg-danger"> </x-adminlte-button>
                                                  <x-adminlte-modal id="hapussiswa{{$loop->iteration}}" title="Hapus Siswa" size="md" theme="danger"
                                                  icon="fas fa-bell" v-centered static-backdrop scrollable>
                                                  <div style="height:80px;">
                                                      <form action="{{route('siswa.delete',$m->id)}}" method="POST">
                                                          @csrf
                                                          @method('DELETE')
                                                            Apakah anda yakin akan menghapus siswa ini?</div>
                                                  <x-slot name="footerSlot">
                                                      <x-adminlte-button type="submit" class="mr-auto" theme="primary" label="Hapus"/>
                                                      <x-adminlte-button theme="danger" label="Batal" data-dismiss="modal"/>
                                                      </form>
                                                  </x-slot>
                                                  </x-adminlte-modal> --}}
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
