<?php

use App\Classes\ServerHandler;
use App\Http\Controllers\KnowledgeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


Route::view('/', 'welcome');

Route::get('/knowledge', \KnowledgeController::class . "@index")
    ->name("knowledge.index");

Route::get('/knowledge/edit/{id}', \KnowledgeController::class."@edit")
    ->name("knowledge.edit");

Route::put('/knowledge/update', \KnowledgeController::class . "@update")
    ->name("knowledge.update");

Route::view('/knowledge/create', 'knowledge.create')->name("knowledge.create.page");
Route::post('/knowledge/create', \KnowledgeController::class . "@create")
    ->name("knowledge.create");

Route::delete('/knowledge/delete/{id}',\KnowledgeController::class . "@destroy")
    ->name("knowledge.delete")
    ->where(["id"=>"[0-9]+"]);

Route::get('/knowledge/show/{id}', \KnowledgeController::class."@show")
    ->name("knowledge.show");

Route::post("/vk_bot_callback", function (Request $request) {
    $handler = new ServerHandler();
    $data = json_decode(file_get_contents('php://input'));
    $handler->parse($data);
});


