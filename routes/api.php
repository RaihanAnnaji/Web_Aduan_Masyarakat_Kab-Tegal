<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\AduanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Di sinilah kamu bisa mendefinisikan semua endpoint API yang akan 
| diakses oleh aplikasi Flutter kamu.
|
*/

// ✅ Endpoint untuk registrasi dan login (tanpa middleware)
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


// ✅ Endpoint yang butuh token autentikasi (middleware Sanctum)
Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return response()->json($request->user());
});

// Laravel route (api.php)
Route::get('/me', function (Request $request) {
    return response()->json($request->user()); // hanya jika pakai Sanctum atau Passport
})->middleware('auth:sanctum');


Route::get('menus', [MenuController::class, 'index']);
Route::get('berita', [BeritaController::class, 'index']);
Route::get('berita/{id}', [BeritaController::class, 'show']);
Route::middleware('auth:sanctum')->post('berita', [BeritaController::class, 'store']);
Route::middleware('auth:sanctum')->put('berita/{id}', [BeritaController::class, 'update']);
Route::middleware('auth:sanctum')->delete('berita/{id}', [BeritaController::class, 'destroy']);
Route::post('/aduan', [AduanController::class, 'store']);
Route::get('/aduan', [AduanController::class, 'index'])->middleware('auth:sanctum');


