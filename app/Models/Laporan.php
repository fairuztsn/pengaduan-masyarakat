<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = "pengaduan";
    protected $fillable = [
        "tanggal_pengaduan", "id_user", "isi_laporan", "foto", "status", "created_at", "updated_at"
    ];
}
