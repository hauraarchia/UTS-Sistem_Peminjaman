<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data User</title>
</head>
<body>
      <h1>Data User</h1>  
      <a href="/user/tambah"> Tambah User</a> 
      <table border="1" cellpadding="2" cellspacing="0">  
            <tr>  
                <td>ID</td>  
                <td>NIM</td>  
                <td>Kategori Sepeda</td>  
                <td>Total Peminjaman</td>  
                <td>Tanggal Pinjam</td>  
                <td>Tanggal Kembali</td>  
                <td>Aksi</td>  
            </tr>  
            @foreach ($data as $d)
            <tr>  
                <td>{{ $d->id_rental }}</td>  
                <td>{{ $d->nim }}</td>  
                <td>{{ $d->kategori_sepeda }}</td>  
                <td>{{ $d->total_pinjam }}</td>  
                <td>{{ $d->tgl_pinjam }}</td>  
                <td>{{ $d->tgl_kembali }}</td>  
                {{-- <td>  
                    <a href="/user/ubah/{{ $d->user_id }}">Ubah</a> |   
                    <a href="/user/hapus/{{ $d->user_id }}">Hapus</a>  
                </td>   --}}
            </tr>  
            @endforeach
        </table>  
    </body>
</html>