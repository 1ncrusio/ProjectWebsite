<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusAlat extends Model
{
    use HasFactory;

    protected $table = 'status_alat';
    protected $primaryKey = 'id_status';

    protected $fillable = ['status_alat'];
}
