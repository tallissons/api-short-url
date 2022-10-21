<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function getLastVisitAttribute()
    {
        return $this->visits()->latest()->first()->created_at;
    }
}
