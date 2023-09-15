<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Jemaat extends Model
{
    use HasFactory;
    protected $table = 'jemaat';

    protected $fillable = [
        'no_kk',
        'nama_lengkap',
        'status_keluarga',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'status_domisili',
        'status_menikah',
        'tanggal_menikah',
        'alamat',
        'id_unit',
    ];

    /**
     * Get the unit associated with the pernikahan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unit(): HasOne
    {
        return $this->hasOne(Unit::class, 'id', 'id_unit');
    }
}
