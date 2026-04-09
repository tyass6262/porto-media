<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Http\Controllers\User\ProjectController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProjectModerationController;
use App\Http\Controllers\Admin\MediaController;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {

        if(auth()->user()->role->slug == 'admin'){
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

Route::get('/', function () {

    if(auth()->check()){
        if(auth()->user()->role->slug == 'admin'){
            return redirect('/admin/dashboard');
        }
        return redirect('/user/projects');
    }

    return redirect('/login');
});


Route::middleware(['auth'])->prefix('user')->name('user.')->group(function(){

    Route::get('/dashboard', function(){
        return redirect()->route('user.projects.index');
    })->name('dashboard');

    Route::resource('projects', ProjectController::class);

});

Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function(){

    Route::get('/dashboard', function(){
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('categories', CategoryController::class);

    Route::delete('/projects/{project}', [ProjectModerationController::class,'destroy'])
        ->name('projects.destroy');

    Route::delete('/media/{media}', [MediaController::class,'destroy'])
        ->name('media.destroy');

});