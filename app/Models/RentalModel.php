<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RentalModel extends Model
{
    use HasFactory;
    protected $table = 'rental'; //mendefinisikan nama table yang digunakan oleh model ini
    protected $primaryKey = 'id_rental'; //mendefinisikan primary key dari table yang digunakan

    // @var array

    protected $fillable = ['id_rental', 'id_mahasiswa', 'kategori_id', 'total_pinjam', 'tgl_pinjam', 'tgl_kembali'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(MahasiswaModel::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
