<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laporan extends Model
{
    use HasFactory;

    protected $table = "laporan";
    protected $fillable = [
        "tanggal_kejadian", "id_user", "isi", "foto", "status", "created_at", "updated_at"
    ];

    public function tanggapan(): hasMany {
        return $this->hasMany(Tanggapan::class, "id_laporan");
    }
}
