<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterGapValue extends Model
{
    use HasFactory;

    protected $table = "bobot_nilai_gap";
    protected $fillable = ['bobot_nilai_kriteria', 'nilai_gap','keterangan'];
}
