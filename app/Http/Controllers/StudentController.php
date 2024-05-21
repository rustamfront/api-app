<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(Student $student, StudentService $service)
    {
        $this->student = $student;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return StudentResource::collection($this->student->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentStoreRequest $request)
    {
        return new StudentResource($this->student->create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if ($student = $this->student->with('grade')->find($id)) {
            return new StudentResource($student);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Студент не найден'
        ], 422);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentUpdateRequest $request, string $id)
    {
        if ($student = $this->student->find($id)) {
            $student->update($request->validated());
            return $student;
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Студент не найден'
        ], 422);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($student = $this->student->find($id)) {
            $student->delete();

            return response()->json([
                'status' => 'ok',
                'message' => 'Студент удален'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Студент не найден'
        ], 422);

    }
}
