<?php

namespace Tests\Feature\Http\Controllers;

use App\Lesson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LessonController
 */
class LessonControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $lessons = factory(Lesson::class, 3)->create();

        $response = $this->get(route('lesson.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LessonController::class,
            'store',
            \App\Http\Requests\LessonStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $auditory_number = $this->faker->word;
        $teacher_full_name = $this->faker->word;
        $teacher_email = $this->faker->word;
        $faculty = $this->faker->numberBetween(-10000, 10000);
        $speciality = $this->faker->numberBetween(-10000, 10000);
        $department = $this->faker->numberBetween(-10000, 10000);
        $group = $this->faker->numberBetween(-10000, 10000);
        $course = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('lesson.store'), [
            'auditory_number' => $auditory_number,
            'teacher_full_name' => $teacher_full_name,
            'teacher_email' => $teacher_email,
            'faculty' => $faculty,
            'speciality' => $speciality,
            'department' => $department,
            'group' => $group,
            'course' => $course,
        ]);

        $lessons = Lesson::query()
            ->where('auditory_number', $auditory_number)
            ->where('teacher_full_name', $teacher_full_name)
            ->where('teacher_email', $teacher_email)
            ->where('faculty', $faculty)
            ->where('speciality', $speciality)
            ->where('department', $department)
            ->where('group', $group)
            ->where('course', $course)
            ->get();
        $this->assertCount(1, $lessons);
        $lesson = $lessons->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $lesson = factory(Lesson::class)->create();

        $response = $this->get(route('lesson.show', $lesson));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LessonController::class,
            'update',
            \App\Http\Requests\LessonUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $lesson = factory(Lesson::class)->create();
        $auditory_number = $this->faker->word;
        $teacher_full_name = $this->faker->word;
        $teacher_email = $this->faker->word;
        $faculty = $this->faker->numberBetween(-10000, 10000);
        $speciality = $this->faker->numberBetween(-10000, 10000);
        $department = $this->faker->numberBetween(-10000, 10000);
        $group = $this->faker->numberBetween(-10000, 10000);
        $course = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('lesson.update', $lesson), [
            'auditory_number' => $auditory_number,
            'teacher_full_name' => $teacher_full_name,
            'teacher_email' => $teacher_email,
            'faculty' => $faculty,
            'speciality' => $speciality,
            'department' => $department,
            'group' => $group,
            'course' => $course,
        ]);

        $lesson->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($auditory_number, $lesson->auditory_number);
        $this->assertEquals($teacher_full_name, $lesson->teacher_full_name);
        $this->assertEquals($teacher_email, $lesson->teacher_email);
        $this->assertEquals($faculty, $lesson->faculty);
        $this->assertEquals($speciality, $lesson->speciality);
        $this->assertEquals($department, $lesson->department);
        $this->assertEquals($group, $lesson->group);
        $this->assertEquals($course, $lesson->course);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $lesson = factory(Lesson::class)->create();

        $response = $this->delete(route('lesson.destroy', $lesson));

        $response->assertNoContent();

        $this->assertDeleted($lesson);
    }
}
