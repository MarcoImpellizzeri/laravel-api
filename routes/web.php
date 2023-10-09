<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProjectController;

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

Route::get('/', function () {
    return view('guest.welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// my routes
// group of routes
Route::middleware(['auth', 'verified'])
    ->prefix("admin")
    ->name("admin.")
    ->group(function () {
        // create
        Route::get("/projects/create", [ProjectController::class, "create"])->name("projects.create");
        Route::post("/projects", [ProjectController::class, "store"])->name("projects.store");

        // show
        Route::get("/projects", [ProjectController::class, "index"])->name("projects.index");
        Route::get("/projects/{slug}", [ProjectController::class, "show"])->name("projects.show");

        // update
        Route::get("/projects/{slug}/edit", [ProjectController::class, "edit"])->name("projects.edit");
        Route::put("/projects/{slug}", [ProjectController::class, "update"])->name("projects.update");
    
        // delete
        Route::delete("/projects/{slug}", [ProjectController::class, "destroy"])->name("projects.destroy");
    });


Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

require __DIR__ . '/auth.php';
