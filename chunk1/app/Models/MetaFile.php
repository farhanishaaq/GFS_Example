<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaFile extends Model
{
    use HasFactory;
    protected $table = 'files';
    protected $guarded = [];
}
