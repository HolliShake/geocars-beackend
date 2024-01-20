<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSubscriptionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth
Route::controller(AuthController::class)->group(function() {
    Route::middleware('auth:api')->post('/Auth/refresh', 'refresh');
    Route::post('/Auth/login', 'loginAttempt');
    Route::post('/Auth/register', 'registerUser');
    Route::post('/Auth/generate/{secret_key}', 'generateAdmin')->where('secret_key', '.+');
});


// User
Route::middleware('auth:api')->controller(UserController::class)->group(function() {
    Route::get('/User/all', 'getAllUsers');
    Route::get('/User/pending', 'getPendingUsers');
    Route::patch('/User/approve/{user_id}', 'approveUser')->where('user_id', '\d+');
    Route::patch('/User/reject/{user_id}', 'rejectUser')->where('user_id', '\d+');
});


// Car
Route::middleware('auth:api')->controller(CarController::class)->group(function() {
    Route::get('/Car/all', 'getAllCars');
    Route::get('/Car/user_subscription/{user_subscription_id}', 'getCarsBySubscriptionId')->where('user_subscription_id', '\d+');
    Route::get('/Car/{car_id}', 'getCar')->where('car_id', '\d+');
    Route::post('/Car/create', 'createCar');
    Route::put('/Car/update/{car_id}', 'updateCar')->where('car_id', '\d+');
    Route::delete('/Car/delete/{car_id}', 'deleteCar')->where('car_id', '\d+');
});

// Subscription
Route::middleware('auth:api')->controller(SubscriptionController::class)->group(function() {
    Route::get('/Subscription/all', 'getAllSubscriptions');
    Route::get('/Subscription/{subscription_id}', 'getSubscription')->where('subscription_id', '\d+');
    Route::post('/Subscription/create', 'createSubscription');
    Route::put('/Subscription/update/{subscription_id}', 'updateSubscription')->where('subscription_id', '\d+');
    Route::delete('/Subscription/delete/{subscription_id}', 'deleteSubscription')->where('subscription_id', '\d+');
});

// User Subscription
Route::middleware('auth:api')->controller(UserSubscriptionController::class)->group(function() {
    Route::get('/UserSubscription/user/{user_id}', 'getUserSubscriptionByUserId')->where('user_id', '\d+');
    Route::get('/UserSubscription/{user_subscription_id}', 'getUserSubscription')->where('user_subscription_id', '\d+');
    Route::get('/UserSubscription/My', 'getCurrentUserSubscription');
    Route::post('/UserSubscription/create', 'createUserSubscription');
    Route::put('/UserSubscription/update/{user_subscription_id}', 'updateUserSubscription')->where('user_subscription_id', '\d+');
    Route::delete('/UserSubscription/delete/{user_subscription_id}', 'deleteUserSubscription')->where('user_subscription_id', '\d+');
    //
    Route::post('/UserSubscription/subscribe/{subscription_id}', 'subscribeAttempt')->where('subscription_id', '\d+');
});
