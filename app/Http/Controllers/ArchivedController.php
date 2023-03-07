<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\DataTables\LaporanArchivedDataTable;

class ArchivedController extends Controller
{
    //
    public function index() {
        return view("archive.index");
    }

    public function laporan(LaporanArchivedDataTable $dataTable) {
        return $dataTable->render("archive.laporan");
    }
}
