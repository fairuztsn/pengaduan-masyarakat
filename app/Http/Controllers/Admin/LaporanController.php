<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Laporan;
class LaporanController extends Controller
{
    //

    public function index() {
        return view("admin.laporan.index", [
            "laporan"=>Laporan::all()
        ]);
    }
}
