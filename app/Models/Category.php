<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function jobPosts()
    {
        return $this->belongsToMany(JobPost::class, 'categories_job_posts');
    }
}
