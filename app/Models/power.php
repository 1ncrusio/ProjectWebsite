<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class power extends Model
{
    protected $table = 'power';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
