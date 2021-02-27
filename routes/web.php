<?php /** @noinspection PhpUndefinedClassInspection */

use Illuminate\Support\Facades\Route;

Route::get('/projects', [\App\Http\Controllers\ProjectsController::class, 'index']);
Route::get('/projects/{project}', [\App\Http\Controllers\ProjectsController::class, 'show']);
Route::post('/projects', [\App\Http\Controllers\ProjectsController::class, 'store'])->middleware('auth');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
