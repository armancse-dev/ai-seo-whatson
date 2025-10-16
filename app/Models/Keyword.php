<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;
    protected $fillable = ['project_id', 'keyword', 'search_volume', 'difficulty', 'cluster', 'meta'];
    protected $casts = ['meta' => 'array'];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
