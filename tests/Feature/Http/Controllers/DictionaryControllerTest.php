<?php

namespace Tests\Feature\Http\Controllers;

use App\Dictionary;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DictionaryController
 */
class DictionaryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $dictionaries = factory(Dictionary::class, 3)->create();

        $response = $this->get(route('dictionary.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DictionaryController::class,
            'store',
            \App\Http\Requests\DictionaryStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $title = $this->faker->sentence(4);
        $type = $this->faker->randomElement(/** enum_attributes **/);
        $code = $this->faker->word;

        $response = $this->post(route('dictionary.store'), [
            'title' => $title,
            'type' => $type,
            'code' => $code,
        ]);

        $dictionaries = Dictionary::query()
            ->where('title', $title)
            ->where('type', $type)
            ->where('code', $code)
            ->get();
        $this->assertCount(1, $dictionaries);
        $dictionary = $dictionaries->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $dictionary = factory(Dictionary::class)->create();

        $response = $this->get(route('dictionary.show', $dictionary));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DictionaryController::class,
            'update',
            \App\Http\Requests\DictionaryUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $dictionary = factory(Dictionary::class)->create();
        $title = $this->faker->sentence(4);
        $type = $this->faker->randomElement(/** enum_attributes **/);
        $code = $this->faker->word;

        $response = $this->put(route('dictionary.update', $dictionary), [
            'title' => $title,
            'type' => $type,
            'code' => $code,
        ]);

        $dictionary->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($title, $dictionary->title);
        $this->assertEquals($type, $dictionary->type);
        $this->assertEquals($code, $dictionary->code);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $dictionary = factory(Dictionary::class)->create();

        $response = $this->delete(route('dictionary.destroy', $dictionary));

        $response->assertNoContent();

        $this->assertDeleted($dictionary);
    }
}
