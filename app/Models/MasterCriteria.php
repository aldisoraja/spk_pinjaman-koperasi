<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCriteria extends Model
{
    use HasFactory;
    protected $table = "kriteria";
    protected $fillable = ['kode_kriteria', 'nama_kriteria', 'faktor_id'];

    public function faktor()
    {
        return $this->hasOne(MasterFactor::class, 'id', 'faktor_id');
    }

    public function nilaiIdeal()
    {
        return $this->hasOne(MasterIdealValue::class);
    }
}
