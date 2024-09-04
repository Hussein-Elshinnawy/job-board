<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
    ];

    public function jobPosts()
    {
        return $this->belongsToMany(JobPost::class, 'technologies_job_posts');
    }
}
