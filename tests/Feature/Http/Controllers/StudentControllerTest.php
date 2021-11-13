<?php

namespace Tests\Feature\Http\Controllers;

use App\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\StudentController
 */
class StudentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $students = factory(Student::class, 3)->create();

        $response = $this->get(route('student.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\StudentController::class,
            'store',
            \App\Http\Requests\StudentStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $first_name = $this->faker->firstName;
        $last_name = $this->faker->lastName;
        $faculty = $this->faker->numberBetween(-10000, 10000);
        $speciality = $this->faker->numberBetween(-10000, 10000);
        $department = $this->faker->numberBetween(-10000, 10000);
        $group = $this->faker->numberBetween(-10000, 10000);
        $course = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('student.store'), [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'faculty' => $faculty,
            'speciality' => $speciality,
            'department' => $department,
            'group' => $group,
            'course' => $course,
        ]);

        $students = Student::query()
            ->where('first_name', $first_name)
            ->where('last_name', $last_name)
            ->where('faculty', $faculty)
            ->where('speciality', $speciality)
            ->where('department', $department)
            ->where('group', $group)
            ->where('course', $course)
            ->get();
        $this->assertCount(1, $students);
        $student = $students->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $student = factory(Student::class)->create();

        $response = $this->get(route('student.show', $student));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\StudentController::class,
            'update',
            \App\Http\Requests\StudentUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $student = factory(Student::class)->create();
        $first_name = $this->faker->firstName;
        $last_name = $this->faker->lastName;
        $faculty = $this->faker->numberBetween(-10000, 10000);
        $speciality = $this->faker->numberBetween(-10000, 10000);
        $department = $this->faker->numberBetween(-10000, 10000);
        $group = $this->faker->numberBetween(-10000, 10000);
        $course = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('student.update', $student), [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'faculty' => $faculty,
            'speciality' => $speciality,
            'department' => $department,
            'group' => $group,
            'course' => $course,
        ]);

        $student->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($first_name, $student->first_name);
        $this->assertEquals($last_name, $student->last_name);
        $this->assertEquals($faculty, $student->faculty);
        $this->assertEquals($speciality, $student->speciality);
        $this->assertEquals($department, $student->department);
        $this->assertEquals($group, $student->group);
        $this->assertEquals($course, $student->course);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $student = factory(Student::class)->create();

        $response = $this->delete(route('student.destroy', $student));

        $response->assertNoContent();

        $this->assertDeleted($student);
    }
}
