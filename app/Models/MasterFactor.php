<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFactor extends Model
{
    use HasFactory;
    protected $table = "faktor";
    protected $fillable = ['nama_faktor', 'bobot_faktor'];
    
}
