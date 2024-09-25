<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Paginatable;

class vol extends Model
{
    protected $table = 'vol';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
