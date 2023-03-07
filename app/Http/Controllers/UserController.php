<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\DataTables\UsersDataTable;
use App\Models\Laporan;
use App\Models\Tanggapan;

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
            "recent" => $user->role_id == 1 ? Laporan::where("id_user", $id)->whereNull("deleted_at")->orderBy("created_at", "desc")->take(2)->get() : Tanggapan::where("id_user", $id)->whereHas("laporan", function($query) {
                $query->whereNull('deleted_at');
            })->orderBy("created_at", "desc")->take(2)->get()
        ]) : abort(404);
    }
}
