<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minute extends Model
{
    /** @use HasFactory<\Database\Factories\MinuteFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'followed_up_by');
    }
}
