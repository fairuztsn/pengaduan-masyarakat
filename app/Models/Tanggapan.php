<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    protected $table = "tanggapan";
    protected $fillable = [
        "id_laporan", "tanggapan", "id_user", "created_at","updated_at"
    ];
}
