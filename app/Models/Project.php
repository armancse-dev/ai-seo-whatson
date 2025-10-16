<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'website', 'settings'];
    protected $casts = ['settings' => 'array'];
    public function keywords()
    {
        return $this->hasMany(Keyword::class);
    }
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
