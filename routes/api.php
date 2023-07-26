<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\OnThisDayController;

Route::group(['prefix' => 'v1'], function () {
    Route::get('today', [OnThisDayController::class, 'index']);
});
