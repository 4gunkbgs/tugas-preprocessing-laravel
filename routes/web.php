<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\StemmingController;
use Illuminate\Support\Facades\Route;


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

// Route::get('/', function () {
//     return view('upload_file');
// });

Route::get('/', [FileController::class, 'index']);
Route::post('/upload', [FileController::class, 'upload']);

Route::get('/result', [FileController::class, 'result']);
