<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $fillable = [
        'title',
        'description'
    ];

    public function syllabusItems()
    {
        return $this->hasMany(SyllabusItem::class);
    }

    use HasFactory;
}
