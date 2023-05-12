<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GardenToolController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreFrontController;
use App\Http\Controllers\UserController;
use App\Models\GardenTool;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [StoreFrontController::class, 'Index']);
Route::get('/gardentool/show/{GardenTool}', [GardenToolController::class, 'Show']);

Route::get('/cart/view', [GardenToolController::class, 'ViewCart']);
Route::get('/cart/add/{GardenTool}', [GardenToolController::class, 'AddToCart']);

Route::group(['middleware' => ['check.cart']], function () {
    Route::get('/cart/reducebyone/{GardenTool}', [GardenToolController::class, 'ReduceByOne']);
    Route::get('/cart/remove/{GardenTool}', [GardenToolController::class, 'RemoveItem']);

    Route::get('/cart/clear', [GardenToolController::class, 'ClearCart']);

    Route::get('/cart/checkout', [GardenToolController::class, 'Checkout']);
    Route::post('/cart/checkout/{Cart}', [GardenToolController::class, 'ProcessCheckOut']);
});


Route::group(['middleware' => ['auth','auth.admin']], function () {
    Route::get('/admin', [AdminController::class, 'Index']);

    Route::get('/gardentool/create', [GardenToolController::class, 'Create']);
    Route::post('/gardentool/store', [GardenToolController::class, 'Store']);

    Route::get('/gardentool/edit/{GardenTool}', [GardenToolController::class, 'Edit']);
    Route::post('/gardentool/update/{GardenTool}', [GardenToolController::class, 'Update']);

    Route::get('/gardentool/delete/{GardenTool}', [GardenToolController::class, 'Destroy']);
});

Route::group(['middleware' => ['guest']], function () {
    Route::get('/sign-up', [UserController::class, 'SignUp']);
    Route::post('/sign-up', [UserController::class, 'Registration']);

    Route::get('/sign-in', [UserController::class, 'SignIn']);
    Route::post('/sign-in', [UserController::class, 'LogIn']);
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/orders/{User}', [OrderController::class, 'View']);

    Route::get('/orders/{User}/refund/{Order}', [OrderController::class, 'Refund']);

    Route::get('sign-out', [UserController::class, 'LogOut']);
});

