<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';

    protected $fillable = ['file', 'file2'];
    use HasFactory;
}
