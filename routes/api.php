<?php

use App\Http\Controllers\Api\{
    CategoryController,
    ProductController,
    ResourceController,
    PermissionUserController,
    UserController
};
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return response()->json(['message' => 'Hello world']);
});

/** User permission route*/
Route::get('/users/permission', [PermissionUserController::class, 'permissionUser']);
/** User routes*/
Route::apiResource('/users', UserController::class);

Route::apiResource('/categories/{category}/products', ProductController::class);
/** Update category by uuid*/
Route::put('/categories/{uuid}', [CategoryController::class, 'update']);
/** Delete category by uuid*/
Route::delete('/categories/{uuid}', [CategoryController::class, 'destroy']);
/** Get category by uuid*/
Route::get('/categories/{uuid}', [CategoryController::class, 'show']);
/** Create category */
Route::post('/categories', [CategoryController::class, 'store']);
/** Get all categories */
Route::get('/categories', [CategoryController::class, 'index']);
/** Get all resources */
Route::get('/resources', [ResourceController::class, 'index']);
