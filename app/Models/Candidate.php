<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'email',
        'phone_number',
        'job_title',
        'cv'
    ];

    public function users(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
