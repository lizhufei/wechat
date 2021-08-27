<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'api'
], function(){
    //公众号入口URL
    Route::any('official/entrance/{company_id}', [\Hsvisus\Wechat\Controllers\EntranceController::class, 'index']);
    //auth2.0回调URL
    Route::any('official/authorizer/{company_id}', [\Hsvisus\Wechat\Controllers\CallbackController::class, 'authorizer']);
});

