<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kelahiran extends Model
{
    use HasFactory;
    protected $table = "kelahiran";

    protected $fillable = [
        "nama",
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
