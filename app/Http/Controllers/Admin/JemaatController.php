<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JemaatController extends Controller
{
    public function index()
    {
        return view('jemaat.index');
    }
}
