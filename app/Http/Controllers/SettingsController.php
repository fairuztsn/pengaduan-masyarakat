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
            return response()->json([
                "response" => Hash::check($request->password, $user->password),
                "expected" => $user->password,
                "founded" => Hash::make($request->password),
                "raw" => $request->password
            ]);
        }catch(\Exception $e) {
            return response()->json([
                "error" => $e
            ]);
        }
    }
}
