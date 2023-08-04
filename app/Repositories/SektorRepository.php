<?php
namespace App\Repositories;
use App\Models\PengurusSektor;
use App\Models\Sektor;
use Illuminate\Database\Eloquent\Collection;

interface SektorRepository{
    public function get(): Collection;
    public function tambah(array $data) : Sektor | null ;
    public function tambahPengurus(array $data) : PengurusSektor | null ;
}
