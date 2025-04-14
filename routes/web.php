<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Datatable\PermissionDatatableController;
use App\Http\Controllers\Datatable\UserDatatableController;
use App\Http\Controllers\Datatable\UserRoleDatatableController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard',  [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth'
)->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('users/export', [UserController::class,'export_userroles'])->name('user.export');
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::get('userrole/export', [UserRoleController::class,'export_userroles'])->name('userrole.export');
    Route::resource('userrole', UserRoleController::class);
    Route::post('/user/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('user.toggleStatus');
});

Route::prefix('datatable')->group(function () {
    Route::get('/user', [UserDatatableController::class, 'index'])->name('datatable.user');
    Route::get('/permission', [PermissionDatatableController::class, 'index'])->name('datatable.permission');
    Route::get('/userrole', [UserRoleDatatableController::class, 'index'])->name('datatable.userrole');

});
require __DIR__.'/auth.php';
