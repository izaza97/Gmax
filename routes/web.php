<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\PackageTourController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\PackageListController;

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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('/user-management', [UserController::class, 'index'])->name('user-management.index');
    Route::get('/user-management/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user-management/create', [UserController::class, 'store'])->name('user.store');
    Route::get('/user-management/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user-management/{id}/edit', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user-management/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    route::put('/user-management/{id}/status', [UserController::class, 'status'])->name('user.status');
    route::post('/user-management/{id}/image', [UserController::class, 'storeImage'])->name('user.image');
    route::delete('/user-management/{id}/image', [UserController::class, 'destroyImage'])->name('user.destroyImage');

    Route::get('/employees', [EmployeesController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeesController::class, 'create'])->name('employees.create');
    Route::post('/employees/create', [EmployeesController::class, 'store'])->name('employees.store');
    Route::get('/employees/{id}/edit', [EmployeesController::class, 'edit'])->name('employees.edit');
    Route::post('/employees/{id}/edit', [EmployeesController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{id}', [EmployeesController::class, 'destroy'])->name('employees.destroy');
    Route::put('/employees/{id}/status', [EmployeesController::class, 'status'])->name('employees.status');
    Route::post('/employees/{id}/image', [EmployeesController::class, 'storeImage'])->name('employees.image');
    Route::delete('/employees/{id}/image', [EmployeesController::class, 'destroyImage'])->name('employees.destroyImage');

    Route::get('/package-tour', [PackageTourController::class, 'index'])->name('package-tour.index');
    Route::get('/package-tour/create', [PackageTourController::class, 'create'])->name('package-tour.create');
    Route::post('/package-tour/create', [PackageTourController::class, 'store'])->name('package-tour.store');
    Route::get('/package-tour/{id}/edit', [PackageTourController::class, 'edit'])->name('package-tour.edit');
    Route::post('/package-tour/{id}/edit', [PackageTourController::class, 'update'])->name('package-tour.update');
    Route::delete('/package-tour/{id}', [PackageTourController::class, 'destroy'])->name('package-tour.destroy');
    Route::get('/package-tour/{id}/image', [PackageTourController::class, 'showImage'])->name('package-tour.showImage');
    Route::post('/package-tour/{id}/image', [PackageTourController::class, 'storeImage'])->name('package-tour.image');
    Route::delete('/package-tour/{id}/image', [PackageTourController::class, 'destroyImage'])->name('package-tour.destroyImage');
    Route::get('/package-tour/{id}/detail', [PackageTourController::class, 'showDetail'])->name('package-tour.showDetail');

    Route::get('/package-list', [PackageListController::class, 'index'])->name('package-list.index');
    Route::get('/package-list/create', [PackageListController::class, 'create'])->name('package-list.create');
    Route::post('/package-list/create', [PackageListController::class, 'store'])->name('package-list.store');
    Route::get('/package-list/{id}/edit', [PackageListController::class, 'edit'])->name('package-list.edit');
    Route::post('/package-list/{id}/edit', [PackageListController::class, 'update'])->name('package-list.update');
    Route::delete('/package-list/{id}', [PackageListController::class, 'destroy'])->name('package-list.destroy');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

    Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
