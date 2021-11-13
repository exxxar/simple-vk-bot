<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KnowledgeController;
use Cryptolib\CryptoCore\Classes\UserPayloadServiceForServer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use VK\Client\VKApiClient;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/send-message-to-bot', function (Request $request) {

    $access_token = env("VK_SECRET_KEY");
    $vk = new VKApiClient();
    $vk->messages()->send($access_token, [
        'peer_id' => "14054379",
        'message' => $request->get("message"),
        'random_id' => random_int(0, 10000000000),

    ]);
});




Route::group([
    "namespace" => "Api",
    "name" => "knowledge.api.",
    "prefix" => "auth"
], function () {
    Route::post("/login", \AuthController::class . "@login")->name("login");
    Route::post("/signup", \AuthController::class . "@signup")->name("login");
});


Route::group([
    "middleware" => [
        'auth:api'
    ],
    "namespace" => "Api",
    "name" => "knowledge.api.",
    "prefix" => "knowledge"], function () {

    Route::get('/list', \KnowledgeController::class . "@index")
        ->name("list");

    Route::put('/update', \KnowledgeController::class . "@update")
        ->name("update");

    Route::post('/create', \KnowledgeController::class . "@create")
        ->name("create");

    Route::delete('/delete/{id}', \KnowledgeController::class . "@destroy")
        ->name("delete")
        ->where(["id" => "[0-9]+"]);

    Route::get('/show/{id}', \KnowledgeController::class . "@show")
        ->name("show");
});


Route::apiResource('profile', 'ProfileController');

Route::apiResource('student', 'StudentController');

Route::apiResource('dictionary', 'DictionaryController');

Route::apiResource('lesson', 'LessonController');

Route::apiResource('class-call-list', 'ClassCallListController');
