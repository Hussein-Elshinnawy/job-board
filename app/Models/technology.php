<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class technology extends Model
{
    use HasFactory;
    public function jobPost()
    {
        return $this->belongsToMany(jobPost::class);
    }
}
