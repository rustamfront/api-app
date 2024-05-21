<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyllabusItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'syllabus_id',
        'lecture_id',
        'order'
    ];

    public static function add($data, $id)
    {
        return self::create([
            'syllabus_id' => $id,
            'lecture_id' => $data['lecture_id'],
            'order' => $data['order']
        ]);
    }

    public function syllabus(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Syllabus::class);
    }
}
