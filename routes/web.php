<?php /** @noinspection PhpUndefinedClassInspection */

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function(){
    Route::get('/projects', [\App\Http\Controllers\ProjectsController::class, 'index'])->name('dashboard');
    Route::get('/projects/create', [\App\Http\Controllers\ProjectsController::class, 'create']);
    Route::get('/projects/{project}', [\App\Http\Controllers\ProjectsController::class, 'show']);
    Route::post('/projects', [\App\Http\Controllers\ProjectsController::class, 'store']);

    Route::post('/projects/{project}/tasks', [\App\Http\Controllers\ProjectTasksController::class, 'store']);
});




Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth']);

require __DIR__.'/auth.php';
