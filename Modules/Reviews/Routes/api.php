<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Reviews\Http\Controllers\Admin\ReviewResourceController;
use Modules\Reviews\Http\Controllers\Admin\TargetTypeController;
use Modules\Reviews\Http\Controllers\DoctorReviewController;

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
Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::get('reviews/reviewable-type', [TargetTypeController::class, 'index']);
    Route::get('doctor/reviews', [DoctorReviewController::class, 'getReviews']);

    Route::apiResources([
        'reviews'=>ReviewResourceController::class
    ]);
});
