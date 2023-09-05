<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengurusSektor extends Model
{
    use HasFactory;
    protected $table = "pengurus_sektor";

    public $timestamps = false;

    protected $fillable = [
        "id_admin",
        "id_sektor",
    ];

    /**
     * Get the admin that owns the PengurusSektor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id');
    }
    /**
     * Get the admin that owns the PengurusSektor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sektor(): BelongsTo
    {
        return $this->belongsTo(Sektor::class, 'id_sektor', 'id');
    }
}
