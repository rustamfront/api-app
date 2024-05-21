<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradeStoreRequest;
use App\Http\Requests\GradeUpdateRequest;
use App\Http\Resources\GradeResource;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function __construct(Grade $grade)
    {
        $this->grade = $grade;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return GradeResource::collection($this->grade->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GradeStoreRequest $request)
    {
        return new GradeResource($this->grade->create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if ($grade = $this->grade->with('students')->find($id)) {
            return new GradeResource($grade);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Класс не найден'
        ], 422);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GradeUpdateRequest $request, string $id)
    {
        if ($grade = $this->grade->find($id)) {
            $grade->update($request->validated());
            return $grade;
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Класс не найден'
        ], 422);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($student = $this->grade->find($id)) {
            $student->delete();

            return response()->json([
                'status' => 'ok',
                'message' => 'Класс удален'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Класс не найден'
        ], 422);
    }
}
