<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSubCriteria extends Model
{
    use HasFactory;
    protected $table = 'subkriteria';
    protected $fillable = ['kriteria_id', 'nama_subkriteria', 'nilai_subkriteria', 'keterangan_subkriteria'];

    public function kriteria()
    {
        return $this->hasOne(MasterCriteria::class, 'id', 'kriteria_id');
    }
}
