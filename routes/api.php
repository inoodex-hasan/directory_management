<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/demo/admin-role', [DemoController::class, 'forAdminRole'])->middleware('auth:sanctum', 'roles:admin,super-admin');
Route::get('/demo/editor-role', [DemoController::class, 'forEditorRole'])->middleware('auth:sanctum', 'roles:editor,admin,super-admin');
Route::get('/demo/user-role', [DemoController::class, 'forUserRole'])->middleware('auth:sanctum', 'roles:user,editor,admin,super-admin');
