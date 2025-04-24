<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class MahasiswaModel extends Model
{
    use HasFactory;
    protected $table = 'data_mahasiswa'; //mendefinisikan nama table yang digunakan oleh model ini
    protected $primaryKey = 'id_mahasiswa'; //mendefinisikan primary key dari table yang digunakan

    protected $fillable = ['nim', 'nama', 'jurusan', 'no_hp'];
    public $timestamps = false;

    public function rental(): HasMany
    {
        return $this->hasMany(RentalModel::class);
    }
}
