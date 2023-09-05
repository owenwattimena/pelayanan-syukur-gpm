<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Collection;

interface JemaatService
{
    public function all(): Collection|null;
    public function create(array $data) : bool;
    public function update(array $data, int $id) : bool;
    public function delete(array|int $ids) : bool;
}
