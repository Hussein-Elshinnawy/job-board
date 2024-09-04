<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','email','company_name','description','contact_phone'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function jobPost()
    {
        return $this->hasMany(JobPost::class);
    }
}
