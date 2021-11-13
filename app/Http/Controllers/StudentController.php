<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Resources\StudentCollection;
use App\Http\Resources\StudentResource;
use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\StudentCollection
     */
    public function index(Request $request)
    {
        $students = Student::all();

        return new StudentCollection($students);
    }

    /**
     * @param \App\Http\Requests\StudentStoreRequest $request
     * @return \App\Http\Resources\StudentResource
     */
    public function store(StudentStoreRequest $request)
    {
        $student = Student::create($request->validated());

        return new StudentResource($student);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Student $student
     * @return \App\Http\Resources\StudentResource
     */
    public function show(Request $request, Student $student)
    {
        return new StudentResource($student);
    }

    /**
     * @param \App\Http\Requests\StudentUpdateRequest $request
     * @param \App\Student $student
     * @return \App\Http\Resources\StudentResource
     */
    public function update(StudentUpdateRequest $request, Student $student)
    {
        $student->update($request->validated());

        return new StudentResource($student);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Student $student)
    {
        $student->delete();

        return response()->noContent();
    }
}
