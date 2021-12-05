<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentsController;

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

Route::get('/', [CommentsController::class, 'Comments'])->name('home');
Route::get('/GetComments', [CommentsController::class, 'GetComments'])->name('GetComments');
Route::post('/AddComments', [CommentsController::class, 'AddComments'])->name('AddComments');
Route::post('/ReplyComments', [CommentsController::class, 'ReplyComments'])->name('ReplyComments');
Route::post('/NestedReply', [CommentsController::class, 'NestedReply'])->name('NestedReply');