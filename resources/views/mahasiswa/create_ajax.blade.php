<form action="{{ url('/mahasiswa/ajax') }}" method="POST" id="form-tambah"> 
@csrf 
<div id="modal-master" class="modal-dialog modal-lg" role="document"> 
    <div class="modal-content"> 
        <div class="modal-header"> 
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data mahasiswa</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span 
aria-hidden="true">&times;</span></button> 
        </div>  
        <div class="modal-body"> 
            {{-- <div class="form-group"> 
                <label>Level Pengguna</label> 
                <select name="level_id" id="level_id" class="form-control" required> 
                    <option value="">- Pilih Level -</option> 
                    @foreach($level as $l) 
                        <option value="{{ $l->level_id }}">{{ $l->level_nama }}</option> 
                    @endforeach 
                </select> 
                <small id="error-level_id" class="error-text form-text text-danger"></small> 
            </div>  --}}
            <div class="form-group"> 
                <label>NIM</label> 
                <input value="" type="text" name="nim" id="nim" class="form-control" required> 
                <small id="error-nim " class="error-text form-text text-danger"></small> 
            </div> 
            <div class="form-group"> 
                <label>Nama mahasiswa</label> 
                <input value="" type="text" name="nama" id="nama" class="form-control" required> 
                <small id="error-nama" class="error-text form-text text-danger"></small> 
            </div> 
            <div class="form-group"> 
                <label>Jurusan</label> 
                <input value="" type="text" name="jurusan" id="jurusan" class="form-control" required> 
                <small id="error-jurusan" class="error-text form-text text-danger"></small> 
            </div> 
            <div class="form-group"> 
                <label>No HP</label> 
                <input value="" type="text" name="no_hp" id="no_hp" class="form-control" required> 
                <small id="error-no_hp" class="error-text form-text text-danger"></small> 
            </div> 
           
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
                nim: {required: true, minlength: 10, maxlength: 10},
                nama: {required: true, minlength: 3, maxlength: 100},
                jurusan: {required: true, minlength: 10, maxlength: 100},
                no_hp: {required: true, minlength: 12, maxlength: 13}
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
                            datamahasiswa.ajax.reload(); 
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
