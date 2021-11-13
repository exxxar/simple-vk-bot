<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonStoreRequest;
use App\Http\Requests\LessonUpdateRequest;
use App\Http\Resources\LessonCollection;
use App\Http\Resources\LessonResource;
use App\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\LessonCollection
     */
    public function index(Request $request)
    {
        $lessons = Lesson::all();

        return new LessonCollection($lessons);
    }

    /**
     * @param \App\Http\Requests\LessonStoreRequest $request
     * @return \App\Http\Resources\LessonResource
     */
    public function store(LessonStoreRequest $request)
    {
        $lesson = Lesson::create($request->validated());

        return new LessonResource($lesson);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Lesson $lesson
     * @return \App\Http\Resources\LessonResource
     */
    public function show(Request $request, Lesson $lesson)
    {
        return new LessonResource($lesson);
    }

    /**
     * @param \App\Http\Requests\LessonUpdateRequest $request
     * @param \App\Lesson $lesson
     * @return \App\Http\Resources\LessonResource
     */
    public function update(LessonUpdateRequest $request, Lesson $lesson)
    {
        $lesson->update($request->validated());

        return new LessonResource($lesson);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Lesson $lesson)
    {
        $lesson->delete();

        return response()->noContent();
    }
}
