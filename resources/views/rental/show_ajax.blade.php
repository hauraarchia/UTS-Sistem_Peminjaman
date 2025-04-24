@empty($rental)
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header bg-danger text-white">
            <h5 class="modal-title">Kesalahan</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
            <a href="{{ url('/rental') }}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
</div>
@else
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info text-white">
            <h5 class="modal-title">Detail Data Rental</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <table class="table table-sm table-bordered table-striped">
                <tr>
                    <th class="text-right col-3">NIM Peminjam:</th>
                    <td class="col-9">{{ $rental->mahasiswa->nim }}</td>
                </tr>
                <tr>
                    <th class="text-right col-3">Kategori Sepeda:</th>
                    <td class="col-9">{{ $rental->kategori->kategori_nama }}</td>
                </tr>
                <tr>
                    <th class="text-right col-3">Total Peminjaman:</th>
                    <td class="col-9">{{ $rental->total_pinjam }}</td>
                </tr>
                <tr>
                    <th class="text-right col-3">Tanggal Pinjam:</th>
                    <td class="col-9">{{ $rental->tgl_pinjam }}</td>
                </tr>
                <tr>
                    <th class="text-right col-3">Tanggal Kembali:</th>
                    <td class="col-9">{{ $rental->tgl_kembali }}</td>
                </tr>
                {{-- <tr>
                    <th class="text-right col-3">Nama:</th>
                    <td class="col-9">{{ $rental->nama }}</td>
                </tr> --}}
            </table>
        </div>

        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-secondary">Tutup</button>
        </div>
    </div>
</div>


@endempty