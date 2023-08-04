<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengurusUnit extends Model
{
    use HasFactory;

    protected $table = "pengurus_unit";
    public $timestamps = false;

    protected $fillable = [
        "id_user",
        "id_unit",
    ];
}
