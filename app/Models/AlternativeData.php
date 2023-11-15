<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternativeData extends Model
{
    use HasFactory;
    protected $table ='alternatif';
    protected $fillable = ['no_anggota', 'nama_anggota', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'keperluan' ,'is_checked', 'besar_pinjaman'];

    public function alternatifSub(){
        return $this->hasMany(AlternatifSubkriteria::class, 'alternatif_id');
    }
}
