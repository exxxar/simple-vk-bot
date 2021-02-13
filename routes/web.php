<?php

use App\Classes\ServerHandler;
use App\Http\Controllers\KnowledgeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


Route::view('/','welcome' );

Route::get('/knowledge',\KnowledgeController::class."@index" )
    ->name("knowledge.index");

Route::view('/knowledge/edit','knowledge.edit' )->name("knowledge.edit");
Route::view('/knowledge/create','knowledge.create' )->name("knowledge.create");
Route::view('/knowledge/show','knowledge.show' )->name("knowledge.show");

Route::post("/vk_bot_callback",function (Request $request){
    $handler = new ServerHandler();
    $data = json_decode(file_get_contents('php://input'));
    $handler->parse($data);
});


