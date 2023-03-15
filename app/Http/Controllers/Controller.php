<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Models\Laporan;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function test() {
        return \App\Models\User::find(3)->role;
    }

    public function dashboard() {
        if(Auth::user()->role_id == 1) {
            return view("laporan.create");
        }else {
            return view("dashboard", [
                    "report" => Laporan::whereNull("deleted_at")->orderBy("created_at", "desc")->get(),
                    "todays_report" => Laporan::whereNull("deleted_at")->where("created_at", "LIKE", "%".Carbon::now()->toDateString()."%")->count(),
                    "user_count" => User::where("role_id", 1)->count(),
                    "petugas_count" => User::where("role_id", 2)->count(),
                    "today" => Carbon::now()->format("d M Y"),
                    "res" => Carbon::now(),
            ]);
        }
    }
}
