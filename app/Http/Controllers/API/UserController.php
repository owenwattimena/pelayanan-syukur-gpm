<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonFormatter;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    private UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function masuk(Request $request)
    {
        $validator = Validator::make($request->input(), [
            "username" => "required",
            "password" => "required"
        ]);

        if ($validator->fails()) {
            return JsonFormatter::error("Data tidak lengkap.", data: $validator->errors()->all(),code:422);
        }

        $data = [
            'username' => $request->username,
            'password' => $request->password
        ];
        if (auth()->attempt($data)) {
            $user = auth()->user();


            if(!$user->email_verified_at)
                return JsonFormatter::error("Email belum diverifikasi.", code: 403);
            $token = $user->createToken('user_token')->plainTextToken;;
            $user['id_unit'] = $user->unit->first()->id;
            return JsonFormatter::success(
                [
                    'user' => $user,
                    'token' => $token
                ]
            );
        } else {
            return JsonFormatter::error("Unauthorised", code: 401);
        }
    }
    public function daftar(Request $request)
    {
        $validator = Validator::make($request->input(), [
            "nama_lengkap" => "required",
            "email" => "required",
            "telepon" => "required",
            "id_unit" => "required",
            "username" => "required",
            "password" => "required"
        ]);

        if ($validator->fails()) {
            return JsonFormatter::error("Data tidak lengkap.", data: $validator->errors()->all());
        }
        try {
            if ($this->userService->tambah($validator->getData())) {
                return JsonFormatter::success([], message: "Proses pendaftaran berhasil. Data anda akan segera diverifikasi.");
            }
            return JsonFormatter::error("Proses pendaftaran gagal. Silahkan coba lagi.");

        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->getCode();

            if ($errorCode == 23000) {
                // Get the error message from the exception
                $errorMessage = $e->getMessage();

                // Extract the column name(s) from the error message
                preg_match('/Duplicate entry \'(.+?)\' for key/', $errorMessage, $matches);

                if (isset($matches[1])) {
                    $duplicateColumn = $matches[1];
                    // Handle the "Duplicate entry" error with the specific column name(s)
                    // For example, you can display a user-friendly error message with the column name(s)
                    return JsonFormatter::error("Data '$duplicateColumn' telah digunakan.");
                }
            }
            return JsonFormatter::error("Proses pendaftaran gagal. " . $e->getMessage());
        }

    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->input(), [
            "nama_lengkap" => "required",
            "email" => "required",
            "telepon" => "required"
        ]);

        if ($validator->fails()) {
            return JsonFormatter::error("Data tidak lengkap.", data: $validator->errors()->all());
        }

        try {
            $user = $request->user();
            $user->nama_lengkap = $request->nama_lengkap;
            $user->email = $request->email;
            $user->telepon = $request->telepon;
            if($user->save())
            {
                $user['id_unit'] = $user->unit->first()->id;
                return JsonFormatter::success(["user" => $user], message: "Berhasil mengubah profile.");
            }
            return JsonFormatter::success([], message: "Gagal mengubah profile.");
        } catch (\Exception $e) {
            return JsonFormatter::success([], message: "Gagal mengubah profile. " . $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token()->revoke();

        return JsonFormatter::success([$token], message: "Berhasil keluar.");

    }
}
