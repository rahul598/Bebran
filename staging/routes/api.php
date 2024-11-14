<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\UserHomeController;
use App\Http\Controllers\Api\VerificationController;
use App\Http\Controllers\Api\MessageController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('get-register', [UserAuthController::class, 'register']);
Route::post('register', [UserAuthController::class, 'register_user']);
Route::post('login', [UserAuthController::class, 'login_user']);
Route::post('forgot-password', [UserAuthController::class, 'forgotPassword']);

Route::post('get-header', [PageController::class, 'getHeader']);
Route::post('get-footer', [PageController::class, 'getFooter']);
Route::post('get-page', [PageController::class, 'ShowPage']);



Route::group(['namespace' => 'App\Http\Controllers\Api', 'middleware' => ['api']],function ($router) {
    //Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->middleware(['auth', 'signed'])->name('verification.verify');
    Route::get('/email/resend', 'VerificationController@resend')->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');
});

// Verify email
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, '__invoke'])
    ->middleware(['signed'])
    ->name('verification.verify');
// Resend link to verify email
/*Route::post('/email/verify/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');*/



Route::post('get-blog', [PageController::class, 'getBlog']);
Route::post('get-blog-details', [PageController::class, 'getBlogDetails']);
Route::post('post-comment', [PageController::class, 'updateComment']);

Route::post('get-services', [PageController::class, 'getService']);
Route::post('get-service-details', [PageController::class, 'getServiceDetails']);
Route::post('get-service-category', [PageController::class, 'getServiceCategory']);
Route::post('get-service-category-details', [PageController::class, 'getServiceCategoryDetails']);

Route::post('get-job', [PageController::class, 'getJob']);

Route::get('get-state', [UserHomeController::class, 'get_state']);


Route::middleware(['auth:sanctum'])->group(function () {
	Route::post('user-token-list', [UserHomeController::class, 'login_token_list']);

	Route::post('get-job-details', [PageController::class, 'getJobDetails']); // Token Required for view count

	Route::post('get-profile', [UserHomeController::class, 'login_token_list']);
	Route::post('update-profile', [UserHomeController::class, 'update_user']);
	Route::post('update-avatar', [UserHomeController::class, 'update_user_avatar']);
	Route::post('update-password', [UserHomeController::class, 'update_password']);

	Route::post('get-service', [UserHomeController::class, 'getService']);
	Route::post('update-service', [UserHomeController::class, 'updateService']);
	Route::post('service-list', [UserHomeController::class, 'serviceList']);
	Route::post('service-details', [UserHomeController::class, 'serviceDetails']);
	Route::post('service-delete', [UserHomeController::class, 'serviceDelete']);
	Route::post('service-file-delete', [UserHomeController::class, 'serviceFileDestroy']);

	Route::post('gallery-delete', [UserHomeController::class, 'galleryDestroy']);

	Route::post('add-job', [UserHomeController::class, 'addJob']);
	Route::post('update-job', [UserHomeController::class, 'updateJob']);
	Route::post('my-job', [UserHomeController::class, 'myJob']);
	Route::post('my-job-details', [UserHomeController::class, 'myJobDetails']);
	Route::post('my-job-delete', [UserHomeController::class, 'myJobDelete']);

	Route::post('add-proposal', [UserHomeController::class, 'addProposal']);
	Route::post('update-proposal', [UserHomeController::class, 'updateProposal']);
	Route::post('my-proposal', [UserHomeController::class, 'myProposal']);
	Route::post('my-proposal-details', [UserHomeController::class, 'myProposalDetails']);


	///Message related Pages
	Route::post('/messages', [MessageController::class, 'get_messages'])->name('messages');
	Route::post('fetch-messages', 'App\Http\Controllers\Api\MessageController@fetchMessages')->name('fetch-messages');
	Route::post('post-message', 'App\Http\Controllers\Api\MessageController@post_message')->name('post-message');
	Route::post('append-message', 'App\Http\Controllers\Api\MessageController@updateMessages')->name('append-message');
	Route::post('prepend-message', 'App\Http\Controllers\Api\MessageController@prependMessages')->name('prepend-message');
	Route::post('lastOnlineTimeUpdate', 'App\Http\Controllers\Api\MessageController@lastOnlineTimeUpdate')->name('lastOnlineTimeUpdate');
	Route::post('check-host-online', ['uses' => 'App\Http\Controllers\Api\MessageController@UpdatelastOnlineTime', 'as' => 'check-host-online']);

	Route::post('update-rating', [UserHomeController::class, 'updateRating']);

	Route::post('create-job-request', [UserHomeController::class, 'createJobByUser']);

});
