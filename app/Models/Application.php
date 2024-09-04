<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_post_id',
        'candidate_id',
        'status',
    ];

    public function jobPosts(): BelongsTo
    {
        return $this->belongsTo(JobPost::class);
    }

    public function candidates(): BelongsTo
    {
        return $this->belongsTo(Candidate::class);
    }
}
