<?php

namespace App\Http\Controllers;

use App\Http\Requests\LectureStoreRequest;
use App\Http\Requests\LectureUpdateRequest;
use App\Http\Resources\LectureResource;
use App\Models\Lecture;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    public function __construct(Lecture $lecture)
    {
        $this->lecture = $lecture;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LectureResource::collection($this->lecture->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LectureStoreRequest $request)
    {
        return new LectureResource($this->lecture->create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if ($lecture = $this->lecture->find($id)) {

            return new LectureResource($lecture);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Лекция не найдена'
        ], 422);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LectureUpdateRequest $request, string $id)
    {
        if ($lecture = $this->lecture->find($id)) {
            $lecture->update($request->validated());
            return $lecture;
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Лекция не найдена'
        ], 422);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($lecture = $this->lecture->find($id)) {
            $lecture->delete();

            return response()->json([
                'status' => 'ok',
                'message' => 'Лекция удалена'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Лекция не найдена'
        ], 422);
    }
}
