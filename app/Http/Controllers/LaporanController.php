<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\DataTables\LaporanDataTable;

class LaporanController extends Controller
{
    //
    private function removeImg($path) {
        unlink(storage_path('app/public/foto_laporan/'.$path));
    }

    public function dashboard() {
        $user_role_id = Auth::user()->role_id;
        return $user_role_id == 1 ? view("laporan.create") : view("dashboard", [
            "report" => Laporan::orderBy("created_at", "desc")->get()
        ]);
    }

    public function index(LaporanDataTable $dataTable) {
        $user = Auth::user();

        if($user->role_id == 1) {
            $val =  Laporan::where("id_user", Auth::id())->orderBy("created_at", "desc")->get();

            return view("laporan.index", [
                "report" => $val
            ]);
        }
        else {
            return $dataTable->render('laporan.index');
        }
    }

    public function detail($id) {
        return view("laporan.detail", [
            "laporan"=>Laporan::where("id", $id)->first(),
            "tanggapans"=>Tanggapan::where("id_laporan", $id)->orderBy("created_at", "asc")->get()
        ]);
    }

    public function store(Request $request) {
        $laporan = new Laporan();

        $laporan->judul = $request->title;
        $laporan->tanggal_kejadian = $request->date;
        $laporan->id_user = Auth::id();
        $laporan->isi = $request->report;

        if($request->hasFile('photo')){
            $newname =  Auth::id().$newname = date("ymdhis").'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/foto_laporan', $newname);
            $laporan->foto = $newname;
        }


        $laporan->save();

        return redirect()->route("laporan.index")->with("message", [
            "type" => "primary",
            "message" => "Berhasil membuat laporan!"
        ]);
    }

    public function history() {
        return view("laporan.history", [
            "reports" => Laporan::all()
        ]);
    }
    
    public function edit($id) {
        if(Auth::id() == Laporan::where("id", $id)->first()->id_user) {
            return view("laporan.edit", [
                "laporan" => Laporan::find($id)
            ]);
        }else {
            abort(404);
        }
    }

    public function update(Request $request, $id) {
        $report = Laporan::find($id);
        $changes = 0;

        if($request->judul != $report->judul) {
            $report->judul = $request->title;
            $changes += 1;
        }

        if($request->report != $report->isi) {
            $report->isi = $request->report;
            $changes += 1;
        }

        if($request->hasFile("photo")) {
            $newname =  Auth::id().$newname = date("ymdhis").'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/foto_laporan', $newname);
            $this->removeImg($report->foto);
            $report->foto = $newname;
            $changes += 1;
        }

        if($changes > 0) {
            $report->updated_at = date("Y-m-d");
            $report->update();
        }

        return $changes > 0 ? redirect()->route("laporan.index")->with("message", [
            "type" => "success",
            "message" => "Perubahan berhasil disimpan"
        ]) : redirect()->route("laporan.index")->with("message", [
            "type" => "light",
            "message" => "Tidak ada perubahan data"
        ]);
    }

    public function set($id, $method) {
        $methods = [
            1 => "process",
            2 => "tolak",
            3 => "selesai"
        ];

        $laporan = Laporan::where("id", $id)->first();
        $old = $laporan->status;
        $method = $methods[$method];

        if(in_array($method, $methods)) {
            $laporan->status = $method;
            $laporan->update();

            return redirect()->route("laporan.detail", $id)->with("message", [
                "type" => "success",
                "message" => "Status berhasil diubah dari $old menjadi $laporan->status"
            ]);
        }else if($old == $method) {
            return redirect()->route("laporan.detail", $id)->with("message", [
                "type" => "warning",
                "message" => "Tidak ada perubahan"
            ]);
        }else {
            return redirect()->route("laporan.detail", $id)->with("message", [
                "type" => "danger",
                "message" => "Unknown status"
            ]);
        }
    }

    public function destroy($id) {
        $report = Laporan::find($id);
        if (Storage::exists("/public/foto_laporan/".$report->foto)) {
            $this->removeImg($report->foto);
        }
        $report->delete();
        return redirect()->route("laporan.index")->with("message", [
            "type" => "danger",
            "message" => "Laporan berhasil dihapus"
        ]);
    }

}
