<?php

namespace App\Http\Controllers;

use App\ClassCallList;
use App\Dictionary;
use App\Exceptions\ResponseStatusException;
use App\Http\Requests\DictionaryStoreRequest;
use App\Http\Requests\DictionaryUpdateRequest;
use App\Http\Resources\DictionaryCollection;
use App\Http\Resources\DictionaryResource;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\DictionaryCollection
     */
    public function index(Request $request)
    {
        $dictionaries = Dictionary::paginate(30);

        return new DictionaryCollection($dictionaries);
    }

    /**
     * @param \App\Http\Requests\DictionaryStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DictionaryStoreRequest $request)
    {
        $dictionary = Dictionary::create($request->validated());

        return response()->json(new DictionaryResource($dictionary));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Dictionary $dictionary
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        $dictionary = Dictionary::find($id);

        if (is_null($dictionary))
            throw new ResponseStatusException("Dictionary", "Dictionary not found", 404);

        return response()->json(new DictionaryResource($dictionary));
    }

    /**
     * @param \App\Http\Requests\DictionaryUpdateRequest $request
     * @param \App\Dictionary $dictionary
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DictionaryUpdateRequest $request, $id)
    {
        $dictionary = Dictionary::find($id);

        if (is_null($dictionary))
            throw new ResponseStatusException("Dictionary", "Dictionary not found", 404);

        $dictionary->update($request->validated());

        return response()->json(new DictionaryResource($dictionary));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Dictionary $dictionary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $dictionary = Dictionary::find($id);

        if (is_null($dictionary))
            throw new ResponseStatusException("Dictionary", "Dictionary not found", 404);

        $dictionary->delete();

        return response()->noContent();
    }
}
