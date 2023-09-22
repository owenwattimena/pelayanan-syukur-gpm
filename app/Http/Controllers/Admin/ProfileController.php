<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }
    public function ubahPassword(Request $request)
    {
        $data = $request->validate([
            'password' => 'required',
            'confirm' => 'required|same:password',
        ]);

        $user = Auth::guard('admin')->user();
        $user->password = $request->password;
        if($user->save())
        {
            return redirect()->route('keluar');
        }
        return redirect()->back()->with(AlertFormatter::danger('Password gagal diubah'));
    }
}
