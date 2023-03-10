<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

use App\DataTables\LaporanDataTable;

class LaporanController extends Controller
{
    //

    private function removeImg($path) {
        unlink(storage_path('app/public/foto_laporan/'.$path));
    }

    public function dashboard() {
        $user_role_id = Auth::user()->role_id;
        return $user_role_id == 1 ? 
        view("laporan.create") 
        : view("dashboard", [
            "report" => Laporan::whereNull("deleted_at")->orderBy("created_at", "desc")->get()
        ]);
    }

    public function index(LaporanDataTable $dataTable) {
        $user = Auth::user();

        if($user->role_id == 1) {
            $val =  Laporan::where("id_user", Auth::id())->whereNull("deleted_at")->orderBy("created_at", "desc")->get();

            return view("laporan.index", [
                "report" => $val
            ]);
        }
        else {
            return $dataTable->render('laporan.index');
        }
    }

    public function detail($id) {
        $report = Laporan::where("id", $id)->whereNull("deleted_at")->first();
        return $report == null ? abort(404) : view("laporan.detail", [
            "laporan"=> $report,
            "tanggapans"=>$report->tanggapan->whereNull("deleted_at")
        ]);
    }

    public function store(Request $request) {
        $validate = $request->validate([
            "title" => ["required", "max:100"],
            "photo" => ["required", "mimes:png,jpg,jpeg,gif"],
            "report" => ["required"],
            "date" => ["required"]
        ]);

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

    public function set(Request $request) {
        $status = [
            1 => "process",
            2 => "tolak",
            3 => "selesai"
        ];

        if(in_array($request->status, [1,2,3])) {
            $report = Laporan::find($request->id)->first();

            if($report->status == $status[$request->status]) {
                return response()->json(["response" => "Tidak ada perubahan"]);
            } else {
                $report->status = $status[$request->status];
                $report->update();
                return response()->json(["response" => "Success"]);
            }

            return response()->json([
                "response" => "Success"
            ]);
        }else {
            return response()->json([
                "response" => "Status tidak terdefinisi"
            ]);
        }

        return response()->json([
            "response" => (int) $request->tanggapan
        ]);
    }

    public function destroy(Request $request) {
        $report = Laporan::find($request->id);

        if(isset($report->tanggapan)) {
            foreach($report->tanggapan as $tanggapan) {
                Tanggapan::find($tanggapan->id)->delete();
            }
        }

        if (Storage::exists("/public/foto_laporan/".$report->foto)) {
            $this->removeImg($report->foto);
        }
        $report->delete();
        return redirect()->route("laporan.index")->with("message", [
            "type" => "danger",
            "message" => "Laporan berhasil dihapus"
        ]);
    }

    public function archive(Request $request) {
        $report = Laporan::find($request->id);
        $report->deleted_at = Carbon::now()->toDateTimeString();
        $report->update();

        return redirect()->route("laporan.index")->with("message", [
            "type" => "danger",
            "message" => "Berhasil menghapus laporan"
        ]);
    }

    public function archived($id) {
        $report = Laporan::where("id", $id)->whereNotNull("deleted_at")->first();

        return $report == null ? abort(404) : view("archive.laporan.detail", [
            "laporan"=> $report,
            "tanggapans"=>$report->tanggapan
        ]);
    }

    public function unarchive($id) {
        $report = Laporan::find($id);
        $report->deleted_at = null;
        $report->update();
        
        return redirect()->route("archived.laporan")->with("message", [
            "message" => "Berhasil melakukan unarchive laporan",
            "type" => "success"
        ]);
    }

}
