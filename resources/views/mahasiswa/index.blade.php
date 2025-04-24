@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            {{-- <a class="btn btn-sm btn-primary mt-1" href="{{ url('mahasiswa/create') }}">Tambah</a> --}}
            <button onclick="modalAction('{{url('/mahasiswa/create_ajax')}}')" class="btn btn-sm btn-success mt-1">Tambah Data Mahasiswa</button>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select class="form-control" id="id_mahasiswa" name="id_mahasiswa" required>
                            <option value="">- Semua -</option>
                            @foreach($mahasiswa as $item)
                                <option value="{{ $item->id_mahasiswa}}">{{ $item->jurusan}}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">jurusan</small>
                    </div>
                </div>
            </div>
        </div>
        
        <table class="table table-bordered table-hover table-sm" id="table_mahasiswa">
            <thead>
                <tr>
                     <th>ID</th>
                     <th>NIM</th>
                     <th>Nama Mahasiswa</th>
                     <th>Jurusan</th>
                     <th>No HP</th>
                     <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div id="myModal" class="modal fade animate shake" 
tabindex="-1" role="dialog" data-backdrop="static" 
data-keyboard="false" data-width="75%" aria-hidden="true"></div> 
@endsection

@push('css')
<!-- Tambahkan custom CSS di sini jika diperlukan -->
@endpush

@push('js')
<script>
    function modalAction(url = ''){
        $('#myModal').load(url,function(){
            $('#myModal').modal('show');
        });
    }

    var datamahasiswa;
    $(document).ready(function() {
       datamahasiswa = $('#table_mahasiswa').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ url('mahasiswa/list') }}",
                dataType: "json",
                type: "POST",
                "data" : function(d) {
                    d.id_mahasiswa = $('#id_mahasiswa').val();
                }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "nim",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "nama",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "jurusan",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "no_hp",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "aksi",
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#id_mahasiswa').on('change', function(){
            datamahasiswa.ajax.reload();
        });

    });
</script>
@endpush
    