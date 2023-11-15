<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterIdealValue extends Model
{
    use HasFactory;

    protected $table = "kriteria_ideal";
    protected $fillable = ['kriteria_id', 'nilai_ideal', 'keterangan'];

    public function kriteria()
    {
        return $this->belongsTo(MasterCriteria::class, 'kriteria_id');
    }
}
