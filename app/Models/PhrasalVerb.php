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
        'chapter',
        'example',
        'example2',
        'example_trs',
        'example_trs2',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('eng_check', 'per_check')->withTimestamps();
    }

}
