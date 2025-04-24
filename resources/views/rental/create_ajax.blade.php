<form action="{{ url('/rental/ajax') }}" method="POST" id="form-tambah"> 
@csrf 
<div id="modal-master" class="modal-dialog modal-lg" role="document"> 
    <div class="modal-content"> 
        <div class="modal-header"> 
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Rental</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span 
aria-hidden="true">&times;</span></button> 
        </div>  
        <div class="modal-body"> 
            <div class="form-group"> 
                <label>NIM Peminjam</label> 
                <select name="id_mahasiswa" id="id_mahasiswa" class="form-control" required> 
                    <option value="">- Pilih NIM -</option> 
                    @foreach($mahasiswa as $n) 
                        <option value="{{ $n->id_mahasiswa}}">{{ $n->nim}}</option> 
                    @endforeach 
                </select> 
                <small id="error-id_mahasiswa" class="error-text form-text text-danger"></small> 
            </div> 
        <div class="modal-body"> 
            <div class="form-group"> 
                <label>Kategori Sepeda</label> 
                <select name="kategori_id" id="kategori_id" class="form-control" required> 
                    <option value="">- Pilih Kategori -</option> 
                    @foreach($kategori as $k) 
                        <option value="{{ $k->kategori_id}}">{{ $k->kategori_nama}}</option> 
                    @endforeach 
                </select> 
                <small id="error-kategori_id" class="error-text form-text text-danger"></small> 
            </div> 
            <div class="form-group"> 
                <label>Total Peminjaman</label> 
                <input value="" type="text" name="total_pinjam" id="total_pinjam" class="form-control" required> 
                <small id="error-total_pinjam " class="error-text form-text text-danger"></small> 
            </div> 
            <div class="form-group"> 
                <label>Tanggal Pinjam</label> 
                <input value="" type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control" required> 
                <small id="error-tgl_pinjam" class="error-text form-text text-danger"></small> 
            </div> 
            <div class="form-group"> 
                <label>Tanggal Kembali</label> 
                <input value="" type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" required> 
                <small id="error-tgl_kembali" class="error-text form-text text-danger"></small> 
            </div> 
            {{-- <div class="form-group"> 
                <label>Password</label> 
                <input value="" type="password" name="password" id="password" class="form-control" required> 
                <small id="error-password" class="error-text form-text text-danger"></small> 
            </div>  --}}
        </div> 
        <div class="modal-footer"> 
            <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button> 
            <button type="submit" class="btn btn-primary">Simpan</button> 
        </div> 
    </div> 
</div> 
</form> 
<script> 
    $(document).ready(function() { 
        $("#form-tambah").validate({ 
            rules: { 
                id_mahasiswa: {required: true},
                kategori_id: {required: true, minlength: 1, maxlength: 2},
                total_pinjam: {required: true, minlength: 1, maxlength: 2},
                tgl_pinjam: {required: true, date:true},
                tgl_kembali: {required: true, date:true}
            }, 
            submitHandler: function(form) { 
                $.ajax({ 
                    url: form.action, 
                    type: form.method, 
                    data: $(form).serialize(), 
                    success: function(response) { 
                        if(response.status){ 
                            $('#myModal').modal('hide'); 
                            Swal.fire({ 
                                icon: 'success', 
                                title: 'Berhasil', 
                                text: response.message 
                            }); 
                            datarental.ajax.reload(); 
                        }else{ 
                            $('.error-text').text(''); 
                            $.each(response.msgField, function(prefix, val) { 
                                $('#error-'+prefix).text(val[0]); 
                            }); 
                            Swal.fire({ 
                                icon: 'error', 
                                title: 'Terjadi Kesalahan', 
                                text: response.message 
                            }); 
                        } 
                    }             
                }); 
                return false; 
            }, 
            errorElement: 'span', 
            errorPlacement: function (error, element) { 
                error.addClass('invalid-feedback'); 
                element.closest('.form-group').append(error); 
            }, 
            highlight: function (element, errorClass, validClass) { 
                $(element).addClass('is-invalid'); 
            }, 
            unhighlight: function (element, errorClass, validClass) { 
                $(element).removeClass('is-invalid'); 
            } 
        }); 
    }); 
</script> 
