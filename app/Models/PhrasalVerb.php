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
        'example3',
        'example4',
        'example5',
        'example_trs',
        'example_trs2',
        'example_trs3',
        'example_trs4',
        'example_trs5',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('eng_check', 'per_check')->withTimestamps();
    }

}
