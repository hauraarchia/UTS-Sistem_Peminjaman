<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class KategoriModel extends Model
{
    use HasFactory;
    protected $table = 'kategori_sepeda'; //mendefinisikan nama table yang digunakan oleh model ini
    protected $primaryKey = 'kategori_id'; //mendefinisikan primary key dari table yang digunakan

    protected $fillable = ['kategori_kode', 'kategori_nama'];

    public function rental(): HasMany
    {
        return $this->hasMany(RentalModel::class);
    }
}
