<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Models\Tanggapan;
use App\DataTables\TanggapanDataTable;

class TanggapanController extends Controller
{
    //
    public function index(TanggapanDataTable $dataTable){

        return $dataTable->render("tanggapan.index");
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
        
        $tanggapan->id_laporan = $request->id;
        $tanggapan->tanggapan = $request->tanggapan;
        $tanggapan->id_user = Auth::id();

        $tanggapan->save();

        return response()->json([
            "message" => "Done"
        ]);
    }

    public function archive($id) {
        $tanggapan = Tanggapan::find($id);
        $tanggapan->deleted_at = Carbon::now()->toDateTimeString();
        $tanggapan->update();
        return redirect()->route("tanggapan.index")->with("message", [
            "message" => "Tanggapan berhasil dihapus",
            "type" => "danger"
        ]);
    }

    public function archived($id) {
        $tanggapan = Tanggapan::where("id", $id)->whereNotNull("deleted_at")->first();

        return $tanggapan == null ? abort(404) : view("archive.tanggapan.detail", [
            "tanggapan"=>$tanggapan
        ]);
    }

    public function unarchive($id) {
        $tanggapan = Tanggapan::find($id);
        $tanggapan->deleted_at = null;
        $tanggapan->update();

        return redirect()->route("archived.tanggapan")->with("message", [
            "message" => "Berhasil unarchive tanggapan",
            "type" => "success"
        ]);
    }
}
