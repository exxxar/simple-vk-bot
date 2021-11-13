<?php

namespace Tests\Feature\Http\Controllers;

use App\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProfileController
 */
class ProfileControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $profiles = factory(Profile::class, 3)->create();

        $response = $this->get(route('profile.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProfileController::class,
            'store',
            \App\Http\Requests\ProfileStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $faculty = $this->faker->numberBetween(-10000, 10000);
        $speciality = $this->faker->numberBetween(-10000, 10000);
        $department = $this->faker->numberBetween(-10000, 10000);
        $group = $this->faker->numberBetween(-10000, 10000);
        $course = $this->faker->numberBetween(-10000, 10000);
        $user_id = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('profile.store'), [
            'faculty' => $faculty,
            'speciality' => $speciality,
            'department' => $department,
            'group' => $group,
            'course' => $course,
            'user_id' => $user_id,
        ]);

        $profiles = Profile::query()
            ->where('faculty', $faculty)
            ->where('speciality', $speciality)
            ->where('department', $department)
            ->where('group', $group)
            ->where('course', $course)
            ->where('user_id', $user_id)
            ->get();
        $this->assertCount(1, $profiles);
        $profile = $profiles->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $profile = factory(Profile::class)->create();

        $response = $this->get(route('profile.show', $profile));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProfileController::class,
            'update',
            \App\Http\Requests\ProfileUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $profile = factory(Profile::class)->create();
        $faculty = $this->faker->numberBetween(-10000, 10000);
        $speciality = $this->faker->numberBetween(-10000, 10000);
        $department = $this->faker->numberBetween(-10000, 10000);
        $group = $this->faker->numberBetween(-10000, 10000);
        $course = $this->faker->numberBetween(-10000, 10000);
        $user_id = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('profile.update', $profile), [
            'faculty' => $faculty,
            'speciality' => $speciality,
            'department' => $department,
            'group' => $group,
            'course' => $course,
            'user_id' => $user_id,
        ]);

        $profile->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($faculty, $profile->faculty);
        $this->assertEquals($speciality, $profile->speciality);
        $this->assertEquals($department, $profile->department);
        $this->assertEquals($group, $profile->group);
        $this->assertEquals($course, $profile->course);
        $this->assertEquals($user_id, $profile->user_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $profile = factory(Profile::class)->create();

        $response = $this->delete(route('profile.destroy', $profile));

        $response->assertNoContent();

        $this->assertDeleted($profile);
    }
}
