<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

use App\Models\Tanggapan;
use App\DataTables\TanggapanDataTable;

class TanggapanController extends Controller
{
    //

    // "id_laporan", "tanggal_tanggapan", "tanggapan", "id_user", "created_at","updated_at"
    public function index(TanggapanDataTable $dataTable){

        return $dataTable->render("tanggapan.index");
        // return view("tanggapan.index", [
        //     "tanggapans" => Tanggapan::all()
        // ]);
    }

    public function destroy($id) {
        Tanggapan::where("id", $id)->first()->delete();

        return back()->with("message", [
            "type" => "danger",
            "message" => "Tanggapan berhasil dihapus"
        ]);
    }
    
    public function store(Request $request) {
        $tanggapan = new Tanggapan();

        $today = date("Y-m-d");
        $tanggapan->id_laporan = $request->id;
        $tanggapan->tanggapan = $request->tanggapan;
        $tanggapan->id_user = Auth::id();

        $tanggapan->save();

        return response()->json([
            "message" => "Done"
        ]);

    }
}
