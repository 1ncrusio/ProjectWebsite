<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alat';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public function statusAlat()
    {
        return $this->belongsTo(StatusAlat::class, 'id_status', 'id_status');
    }
}
