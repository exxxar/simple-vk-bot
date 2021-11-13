<?php

namespace App\Http\Controllers;

use App\ClassCallList;
use App\Exceptions\ResponseStatusException;
use App\Http\Requests\ClassCallListStoreRequest;
use App\Http\Requests\ClassCallListUpdateRequest;
use App\Http\Resources\ClassCallListCollection;
use App\Http\Resources\ClassCallListResource;
use Illuminate\Http\Request;

class ClassCallListController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\ClassCallListCollection
     */
    public function index(Request $request)
    {
        $classCallLists = ClassCallList::paginate(30);

        return new ClassCallListCollection($classCallLists);
    }

    /**
     * @param \App\Http\Requests\ClassCallListStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ClassCallListStoreRequest $request)
    {
        $classCallList = ClassCallList::create($request->validated());

        return response()->json(new ClassCallListResource($classCallList));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\ClassCallList $classCallList
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        $classCallList = ClassCallList::find($id);

        if (is_null($classCallList))
            throw new ResponseStatusException("ClassList", "ClassList not found", 404);

        return response()->json(new ClassCallListResource($classCallList));
    }

    /**
     * @param \App\Http\Requests\ClassCallListUpdateRequest $request
     * @param \App\ClassCallList $classCallList
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ClassCallListUpdateRequest $request, $id)
    {
        $classCallList = ClassCallList::find($id);

        if (is_null($classCallList))
            throw new ResponseStatusException("ClassList", "ClassList not found", 404);

        $classCallList->update($request->validated());

        return response()->json(new ClassCallListResource($classCallList));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\ClassCallList $classCallList
     * @return \Illuminate\Http\Response
     * @throws ResponseStatusException
     */
    public function destroy(Request $request, $id)
    {

        $classCallList = ClassCallList::find($id);

        if (is_null($classCallList))
            throw new ResponseStatusException("ClassList", "ClassList not found", 404);

        $classCallList->delete();

        return response()->noContent();
    }
}
