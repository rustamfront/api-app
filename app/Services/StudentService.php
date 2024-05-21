<?php

namespace App\Services;

use App\Models\Student;

class StudentService
{
    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function findStudent(string $id)
    {
        if ($student = $this->student->with('grade')->find($id)) {
            return $student;
        }

        return false;
    }
}
