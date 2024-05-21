<?php

namespace App\Services;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Builder;

class SyllabusService
{
    public function __construct(Grade $grade)
    {
        $this->grade = $grade;
    }

    public function findByGrade($request, $id)
    {
        return $this->grade
            ->whereHas('syllabus.syllabusItems', function (Builder $query) use ($request) {
                $query->where('lecture_id', $request->lecture_id);
            })
            ->where('id', $id)
            ->first();
    }
}
