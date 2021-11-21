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
        $students = Student::paginate(30);

        return new StudentCollection($students);
    }

    /**
     * @param \App\Http\Requests\StudentStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StudentStoreRequest $request)
    {
        $student = Student::create($request->validated());

        return response()->json(new StudentResource($student));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Student $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Student $student)
    {
        return response()->json(new StudentResource($student));
    }

    /**
     * @param \App\Http\Requests\StudentUpdateRequest $request
     * @param \App\Student $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StudentUpdateRequest $request, Student $student)
    {
        $student->update($request->validated());

        return response()->json(new StudentResource($student));
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
