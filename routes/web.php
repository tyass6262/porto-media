<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

// USER
use App\Http\Controllers\User\ProjectController;

// ADMIN
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProjectModerationController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

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
            return redirect('/admin/dashboard');
        }

        return redirect('/user/projects');
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

    return redirect('/user/projects');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    if (auth()->check()) {
        if (auth()->user()->role->slug == 'admin') {
            return redirect('/admin/dashboard');
        }
        return redirect('/user/projects');
    }

    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| PUBLIC PORTFOLIO (🔥 INI YANG BELUM TADI)
|--------------------------------------------------------------------------
*/

// semua project published (gallery)
Route::get('/portfolio', [ProjectController::class, 'publicIndex'])
    ->name('portfolio.index');

// detail project publik
Route::get('/portfolio/{project}', [ProjectController::class, 'publicShow'])
    ->name('portfolio.show');

// filter kategori
Route::get('/portfolio/category/{slug}', [ProjectController::class, 'filterByCategory'])
    ->name('portfolio.category');

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {

    Route::get('/dashboard', function () {
        return redirect()->route('user.projects.index');
    })->name('dashboard');

    // CRUD PROJECT + upload media
    Route::resource('projects', ProjectController::class);
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // CATEGORY
    Route::resource('categories', CategoryController::class);

    Route::patch('/categories/{category}/toggle', [CategoryController::class, 'toggle'])
        ->name('categories.toggle');

    // USER MANAGEMENT
    Route::resource('users', UserController::class);

    // LIHAT SEMUA PROJECT
    Route::get('/projects', [ProjectModerationController::class, 'index'])
        ->name('projects.index');

    // HAPUS PROJECT
    Route::delete('/projects/{project}', [ProjectModerationController::class, 'destroy'])
        ->name('projects.destroy');

    // HAPUS MEDIA
    Route::delete('/media/{media}', [MediaController::class, 'destroy'])
        ->name('media.destroy');
});