<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pernikahan extends Model
{
    use HasFactory;
    protected $table = 'pernikahan';
    protected $fillable = [
        "nama_pria",
        "nama_wanita",
        "tanggal",
        "jam",
        "alamat",
        "id_unit",
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
