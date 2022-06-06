<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\MovedirController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [CameraController::class, 'home'])->name('home');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/camera', [CameraController::class, 'find'])->name('camera.find');

Route::get('/camera/{id}', [CameraController::class, 'camera'])->name('camera.id');
Route::get('copy', [MovedirController::class, 'copy'])->name('copy');

Route::prefix('image')->group(
    function () {
        Route::get('job/{filename}', 'ImageController@showJobImage')->name('jobImage');
    }
);


require __DIR__ . '/auth.php';
