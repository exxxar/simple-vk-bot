<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Knowledge;
use Illuminate\Http\Request;


class KnowledgeController extends Controller
{
    //

    public function index()
    {
        $knowledges = Knowledge::all();

        return response()->json($knowledges);
    }

    public function create(Request $request)
    {
        $request->validate([
            "keyword" => "required",
            "answer" => "required",
            "is_active" => "required",
        ]);

        $tmp = Knowledge::create($request->all());

        return response()->json(["id" => $tmp->id]);
    }

    public function show($id)
    {
        $knowledge = Knowledge::find($id);
        return response()->json($knowledge);
    }

    public function destroy($id)
    {
        $knowledge = Knowledge::find($id);

        if (!is_null($knowledge))
            $knowledge->delete();
        else
            return response()->json(["id" => $id, "message" => "Not Found"]);
        return response()->json(["id" => $id]);
    }

    public function update(Request $request)
    {
        $request->validate([
            "id" => "required",
        ]);

        $knowledge = Knowledge::find($request->get("id"));

        if (!is_null($knowledge)) {
            $knowledge->keyword = $request->get("keyword") ?? "";
            $knowledge->answer = $request->get("answer") ?? "";
            $knowledge->is_active = $request->get("is_active") ?? false;
            $knowledge->save();
        }
        else
            $knowledge = Knowledge::create($request->all());

        return response()->json($knowledge);
    }

}
