<?php

use App\Http\Controllers\Api\{
    CategoryController,
    ProductController,
    ResourceController,
    PermissionUserController,
    UserController
};
use App\Http\Controllers\Api\Auth\{
    AuthController,
    RegisterController
};
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return response()->json(['message' => 'Hello world']);
});
/**
 * Auth and Register routes
 */
Route::post('/register', [RegisterController::class, 'store']);


/** User login */
Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    /** User permission validate route*/
    Route::get('/users/can/{permission}', [PermissionUserController::class, 'userHasPermissionsUser']);
    /** User permission route*/
    Route::post('/users/permissions', [PermissionUserController::class, 'addPermissionsUser']);
    Route::get('/users/{uuid}/permissions', [PermissionUserController::class, 'permissionUser']);
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
});
