<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class jobPost extends Model
{
    use HasFactory;
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
    public function jobPost(): BelongsTo
    {
        return $this->belongsTo(city::class);
    }
    public function comment()
    {
        return $this->hasMany(jobPost::class);
    }
}
