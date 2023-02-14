<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    //
    public function index($id) {
        return view("laporan.index", [
            "laporan"=>Laporan::where("id", $id)->first()
        ]);
    }

    public function store(Request $request) {
        $request["id_user"] = Auth::id(); unset($request["_token"]);
        Laporan::insert($request->all());

        return back()->with("message", "Berhasil membuat laporan");
    }

    public function history() {
        return view("laporan.history", [
            "reports" => Laporan::all()
        ]);
    }
}
