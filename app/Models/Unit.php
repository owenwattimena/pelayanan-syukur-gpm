<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'unit';

    protected $fillable = [
        "id_sektor",
        "nama_unit"
    ];

    /**
     * Get the sektor associated with the Unit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sektor(): HasOne
    {
        return $this->hasOne(Sektor::class, 'id', 'id_sektor');
    }
}
