<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTechnology extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_post_id',
        'technology_id'
    ];
}
