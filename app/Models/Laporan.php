<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = "laporan";
    protected $fillable = [
        "id_laporan", "tanggal_kejadian", "id_user", "isi", "foto", "status", "created_at", "updated_at"
    ];
}
