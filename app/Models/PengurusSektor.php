<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengurusSektor extends Model
{
    use HasFactory;
    protected $table = "pengurus_sektor";

    public $timestamps = false;

    protected $fillable = [
        "id_admin",
        "id_sektor",
    ];
}
