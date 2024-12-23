<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhrasalVerb extends Model
{
    use HasFactory;
    protected $fillable = [
        'eng',
        'per',
        'unit',
    ];
}
