<?php

namespace Tests\Feature\Http\Controllers;

use App\ClassCallList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ClassCallListController
 */
class ClassCallListControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $classCallLists = factory(ClassCallList::class, 3)->create();

        $response = $this->get(route('class-call-list.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ClassCallListController::class,
            'store',
            \App\Http\Requests\ClassCallListStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $title = $this->faker->sentence(4);
        $index = $this->faker->numberBetween(-10000, 10000);
        $start_at = $this->faker->word;
        $end_at = $this->faker->word;

        $response = $this->post(route('class-call-list.store'), [
            'title' => $title,
            'index' => $index,
            'start_at' => $start_at,
            'end_at' => $end_at,
        ]);

        $classCallLists = ClassCallList::query()
            ->where('title', $title)
            ->where('index', $index)
            ->where('start_at', $start_at)
            ->where('end_at', $end_at)
            ->get();
        $this->assertCount(1, $classCallLists);
        $classCallList = $classCallLists->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $classCallList = factory(ClassCallList::class)->create();

        $response = $this->get(route('class-call-list.show', $classCallList));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ClassCallListController::class,
            'update',
            \App\Http\Requests\ClassCallListUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $classCallList = factory(ClassCallList::class)->create();
        $title = $this->faker->sentence(4);
        $index = $this->faker->numberBetween(-10000, 10000);
        $start_at = $this->faker->word;
        $end_at = $this->faker->word;

        $response = $this->put(route('class-call-list.update', $classCallList), [
            'title' => $title,
            'index' => $index,
            'start_at' => $start_at,
            'end_at' => $end_at,
        ]);

        $classCallList->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($title, $classCallList->title);
        $this->assertEquals($index, $classCallList->index);
        $this->assertEquals($start_at, $classCallList->start_at);
        $this->assertEquals($end_at, $classCallList->end_at);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $classCallList = factory(ClassCallList::class)->create();

        $response = $this->delete(route('class-call-list.destroy', $classCallList));

        $response->assertNoContent();

        $this->assertDeleted($classCallList);
    }
}
