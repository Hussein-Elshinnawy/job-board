<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobPost extends Model
{
    use HasFactory;
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
    public function jobPost(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    public function comment()
    {
        return $this->hasMany(JobPost::class);
    }
    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
    public function technology()
    {
        return $this->belongsToMany(Technology::class);
    }
}
