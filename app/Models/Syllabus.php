<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade_id'
    ];

    public function syllabusItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SyllabusItem::class);
    }

    public function grade(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }
}
