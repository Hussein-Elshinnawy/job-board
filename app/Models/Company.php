<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'email',
        'company_name',
        'description',
        'contact_phone',
        'logo'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    // public function users(): HasOne
    // {
    //     return $this->hasOne(User::class);
    // }

    public function jobPosts(): HasMany
    {
        return $this->hasMany(JobPost::class);
    }
}
