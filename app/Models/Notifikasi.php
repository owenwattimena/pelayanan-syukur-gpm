<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;
    protected $table = "notifikasi";
    protected $fillable = [
        "judul",
        "isi",
        "waktu",
        "satuan_waktu",
        "id_unit",
    ];
}
