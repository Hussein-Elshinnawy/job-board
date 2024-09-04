<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class comment extends Model
{
    use HasFactory;
    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }
    public function candidate()
    {
        return $this->belongsTo(candidate::class);
    }


}
