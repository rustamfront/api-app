<?php

namespace App\Http\Controllers;

use App\Http\Requests\SyllabusUpdateRequest;
use App\Http\Resources\SyllabusResource;
use App\Models\Grade;
use App\Models\Syllabus;
use App\Models\SyllabusItem;
use App\Services\SyllabusService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SyllabusController extends Controller
{
    public function __construct(Syllabus $syllabus,
                                SyllabusItem $syllabusItem,
                                Grade $grade,
                                SyllabusService $syllabusService)
    {
        $this->syllabus = $syllabus;
        $this->syllabusItem = $syllabusItem;
        $this->grade = $grade;
        $this->syllabusService = $syllabusService;
    }

    public function show(string $id)
    {
        $grade = $this->grade->with('syllabus.syllabusItems')->find($id);
        if ($grade && $grade->syllabus) {
            return new SyllabusResource($grade->syllabus->syllabusItems);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Учебный план не найден'
        ], 422);
    }

    public function store(string $id)
    {
        return new SyllabusResource($this->syllabus->create([
            'grade_id' => $id
        ]));
    }

    public function update(SyllabusUpdateRequest $request, string $id)
    {
        $grade = $this->syllabusService->findByGrade($request, $id);

        if ($grade) {
            return response()->json([
               'status' => 'error',
               'message' => 'Лекция не может повторяться'
            ], 422);
        }

        $syllabusItem = $this->syllabusItem->add($request->validated(), $id);

        return new SyllabusResource($syllabusItem);
    }
}
