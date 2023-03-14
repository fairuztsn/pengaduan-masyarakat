<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class SettingsController extends Controller
{
    //

    public function index() {
        return view("settings.index");
    }

    public function profile() {
        return view("settings.profile", Auth::user());
    }

    public function updateProfile(Request $request) {
        $user = User::find(Auth::id());
        $changes = 0;

        if($user->email != $request->email) {
            $request->validate(["email" => "max:255|unique:users"]);
            $user->email = $request->email;
            $changes += 1;
        }

        if($user->username != $request->username) {
            $request->validate(["username" => "max:255|unique:users|alpha_dash"]);
            $user->username = $request->username;
            $changes += 1;
        }

        if($user->nik != $request->nik) {
            $request->validate(["nik" => "numeric|unique:users"]);
            $user->nik = $request->nik;
            $changes += 1;
        }

        if($user->nama != $request->nama) {
            $user->nama = $request->nama;
            $changes += 1;
        }

        if($changes > 0) {
            $user->update();
            return redirect()->back()->with("message", [
                "type" => "success",
                "message" => "Berhasil menyimpan perubahan profil"
            ]);
        }else {
            return redirect()->back()->with("message", [
                "type" => "light",
                "message" => "Tidak ada perubahan yang dibuat"
            ]);
        }
    }

    public function changePassword() {
        return view("settings.change-password");
    }

    public function validateOldPassword(Request $request) {
        try {
            $user = User::find(Auth::id());
            $valid = Hash::check($request->password, $user->password);

            if($valid) {
                return response()->json([
                    "response" => $valid,
                    "returns" => view("settings.partials.new-password")->render()
                ]);
            }else {
                return response()->json([
                    "response" => $valid,
                    "message" => "Password salah"
                ]);
            }
        }catch(\Exception $e) {
            return response()->json([
                "error" => $e
            ]);
        }
    }

    public function updatePassword(Request $request) {
        $user = User::find(Auth::id());

        // New-password and Re-typed-new-password are the same
        if($request->password == $request->retyped_password) {

            // Same as old password
            if(Hash::check($request->password, $user->password)) {
                return response()->json([
                    "response" => "same_as_old",
                    "message" => "Password-mu tidak boleh sama dengan yang lama",
                    "icon" => "face-sad-tear"
                ]);
            }else {
                $user->password = Hash::make($request->password);
                $user->update();

                return response()->json([
                    "response" => "success",
                    "message" => "Password-mu berhasil diubah",
                    "returns" => view("settings.partials.success-change-password")->render()
                ]);
            }
        }else {
            return response()->json([
                "response" => "not_same",
                "message" => "Password yang diketik ulang tidak cocok dengan password baru yang kamu ketikkan",
                "icon" => "face-sad-tear"
            ]);
        }
    }
}
