<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternatifSubkriteria extends Model
{
    use HasFactory;
    protected $table = 'alternatif_subkriteria';

    protected $fillable = [
        'alternatif_id',
        'subkriteria_id',
    ];

    public function alternatif()
    {
        return $this->belongsTo(AlternativeData::class, 'alternatif_id');
    }

    public function subkriteria()
    {
        return $this->belongsTo(MasterSubCriteria::class, 'subkriteria_id');
    }
}
