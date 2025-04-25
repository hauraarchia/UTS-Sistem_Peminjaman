@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            {{-- <a class="btn btn-sm btn-primary mt-1" href="{{ url('rental/create') }}">Tambah</a> --}}
            <button onclick="modalAction('{{url('/rental/create_ajax')}}')" class="btn btn-sm btn-success mt-1">Tambah Data Rental</button>
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
                        <select class="form-control" id="kategori_id" name="kategori_id" required>
                            <option value="">- Semua -</option>
                            @foreach($kategori as $item)
                                <option value="{{ $item->kategori_id}}">{{ $item->kategori_nama}}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Kategori</small>
                    </div>
                </div>
            </div>
        </div>
        
        <table class="table table-bordered table-hover table-sm" id="table_rental">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NIM</th>
                    <th>Kategori Sepeda</th>
                    <th>Total Peminjaman</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
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

    var datarental;
    $(document).ready(function() {
       datarental = $('#table_rental').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ url('rental/list') }}",
                dataType: "json",
                type: "POST",
                "data" : function(d) {
                    d.kategori_id = $('#kategori_id').val();
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
                    data: "mahasiswa.nim",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "kategori.kategori_nama",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "total_pinjam",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "tgl_pinjam",
                    orderable: true,
                    searchable: true,
                    date:true
                },
                {
                    data: "tgl_kembali",
                    orderable: true,
                    searchable: true,
                    date:true
                },
                {
                    data: "aksi",
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#kategori_id').on('change', function(){
            datarental.ajax.reload();
        });

    });
</script>
@endpush
    