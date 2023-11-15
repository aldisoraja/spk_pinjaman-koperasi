<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailHasilPerhitungan extends Model
{
    use HasFactory;
    protected $table = "hasil_detail_tabel";
    protected $fillable = ['hasil_id', 'alternatif_id','nilai_total','rangking','jumlah_pinjaman','keterangan'];

    public function alternatif()
    {
        return $this->belongsTo(AlternativeData::class, 'alternatif_id');
    }
}
