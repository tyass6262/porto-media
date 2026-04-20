<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Http\Controllers\User\ProjectController;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProjectModerationController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| LANDING PAGE (SEBELUM LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('landing'); // 🔥 halaman awal
})->name('landing');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {

        if (auth()->user()->role->slug == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.projects.index');
    }

    return back()->with('error', 'Login gagal');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role_id' => 2
    ]);

    Auth::login($user);

    return redirect()->route('user.projects.index');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('landing');
})->name('logout');


/*
|--------------------------------------------------------------------------
| PUBLIC PORTFOLIO
|--------------------------------------------------------------------------
*/
Route::get('/portfolio', [ProjectController::class, 'publicIndex'])
    ->name('portfolio.index');

Route::get('/portfolio/{project}', [ProjectController::class, 'publicShow'])
    ->name('portfolio.show');

Route::get('/portfolio/category/{slug}', [ProjectController::class, 'filterByCategory'])
    ->name('portfolio.category');


/*
|--------------------------------------------------------------------------
| USER AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {

    Route::get('/dashboard', function () {
        return redirect()->route('user.projects.index');
    })->name('dashboard');

    Route::resource('projects', ProjectController::class);

    // ✅ TOGGLE STATUS FIX
    Route::put('projects/{project}/toggle-status', [ProjectController::class, 'toggleStatus'])
        ->name('projects.toggleStatus');
});


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('categories', CategoryController::class);

    Route::patch('/categories/{category}/toggle', [CategoryController::class, 'toggle'])
        ->name('categories.toggle');

    Route::resource('users', UserController::class);

    // ✅ PROJECT MODERATION
    Route::get('/projects', [ProjectModerationController::class, 'index'])
        ->name('projects.index');

    Route::get('/projects/{project}', [ProjectModerationController::class, 'show'])
        ->name('projects.show');

    Route::delete('/projects/{project}', [ProjectModerationController::class, 'destroy'])
        ->name('projects.destroy');

    // ✅ MEDIA DELETE FIX
    Route::delete('/media/{media}', [MediaController::class, 'destroy'])
        ->name('media.destroy');
});