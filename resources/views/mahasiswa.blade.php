<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Data Mahasiswa</h1>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Jurusan</th>
            <th>No HP</th>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{$d->id_mahasiswa}}</td>
            <td>{{$d->nim}}</td>
            <td>{{$d->nama}}</td>
            <td>{{$d->jurusan}}</td>
            <td>{{$d->no_hp}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>