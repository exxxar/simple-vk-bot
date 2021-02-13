<?php

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

Route::post('/send-message-to-bot',function (Request $request){

    $access_token = env("VK_SECRET_KEY");
    $vk = new VKApiClient();
    $vk->messages()->send($access_token, [
        'peer_id' => "14054379",
        'message' => $request->get("message"),
        'random_id' => random_int(0, 10000000000),

    ]);
});
