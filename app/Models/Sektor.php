<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sektor extends Model
{
    use HasFactory;

    protected $table = 'sektor';

    protected $fillable = [
        "nama_sektor"
    ];

    // protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get all of the unit for the Sektor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unit(): HasMany
    {
        return $this->hasMany(Unit::class, 'id_sektor', 'id');
    }
}
