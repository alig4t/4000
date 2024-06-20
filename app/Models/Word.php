<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    protected $fillable = [
        'per',
        'example',
        'description',
        'example_trs',
        'test_tik'
    ];

    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'user_word');
    // }
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('eng_check', 'per_check')->withTimestamps();
    }

}
