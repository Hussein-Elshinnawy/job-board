<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'job_title',
        'job_description',
        'city_id',
        'category_id',
        'technology_id',
        'salary',
        'is_active',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function technology(): HasMany
    {
        return $this->hasMany(Technology::class);
    }
}
