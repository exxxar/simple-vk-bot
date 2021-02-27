<?php

namespace App\Http\Controllers;

use App\Knowledge;
use Illuminate\Http\Request;

class KnowledgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $knowledges = Knowledge::all();

        return view('knowledge.index', compact('knowledges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            "keyword" => "required",
            "answer" => "required"
        ]);

        Knowledge::create($request->all());

        return redirect()->route("knowledge.index");
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Knowledge $knowledge
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $knowledge = Knowledge::find($id);
        return view('knowledge.show', compact("knowledge"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Knowledge $knowledge
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $knowledge= Knowledge::find($id);

        return view("knowledge.edit",compact("knowledge"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Knowledge $knowledge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            "id" => "required",
            "keyword" => "required|min:2|max:100",
            "answer" => "required|min:2|max:100"
        ]);

        $knowledge= Knowledge::find($request->get("id"));
        $knowledge->keyword=$request->get("keyword");
        $knowledge->answer=$request->get("answer");
        $knowledge->save();

        return response()
            ->redirectToRoute("knowledge.index")
            ->with("message","Запись $knowledge->id успешно обновлена!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Knowledge $knowledge
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {

        $knowledge = Knowledge::find($id);
        $knowledge->delete();

        return back()
            ->with("message", "Запись $id успешно удалена!");

    }
}
