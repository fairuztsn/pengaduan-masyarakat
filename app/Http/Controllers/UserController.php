<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\DataTables\UsersDataTable;
use App\Models\Laporan;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(UsersDataTable $dataTable) {
        return $dataTable->render("user.index");
    }

    public function profile($id) {
        $user = User::where("id", $id)->first();

        return $user != null ? view("profile.index", [
            "user" => $user,
            "recent" => $user->role_id == 1 ? 
                Laporan::where("id_user", $id)
                    ->whereNull("deleted_at")
                    ->orderBy("created_at", "desc")
                    ->take(2)->get() 
                : Tanggapan::where("id_user", $id)
                    ->whereHas("laporan", function($query) {
                        $query->whereNull('deleted_at');
                    })->orderBy("created_at", "desc")->take(2)->get()
        ]) : abort(404);
    }

    public function create() {
        return view("user.create");
    }

    public function store(Request $request) {
        $request->validate([
            "email" => "required|unique:users|max:255",
            "username" => "required|unique:users|max:255|alpha_dash",
            "nik" => "required|numeric|unique:users",
            "nama" => "required|max:255",
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->username = $request->username;
        $user->nik = $request->nik;
        $user->nama = $request->nama;
        $user->password = Hash::make("12345678");
        $user->role_id = 2;

        $user->save();

        return redirect()->route("user.index")->with("message", [
            "type" => "primary",
            "message" => "Berhasil membuat user"
        ]);
    }
}
