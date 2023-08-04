<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = "admin";

    protected $fillable = [
        'nama_lengkap',
        'email',
        'telepon',
        'username',
        'password',
        'role',
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            // get: fn($value) => json_decode($value, true),
            set: fn($value) => Hash::make($value),
        );
    }

    /**
     * The sektor that belong to the Admin
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sektor(): BelongsToMany
    {
        return $this->belongsToMany(Sektor::class, 'pengurus_sektor', 'id_admin', 'id_sektor');
    }
}
