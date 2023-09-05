<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function pengaturan(Request $request)
    {
        $pengaturan = Pengaturan::get()->first();
        return \App\Helpers\JsonFormatter::success($pengaturan, message: 'Data pengaturan.');

    }
}
