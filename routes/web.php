<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function(){

    Route::get('/dashboard', function(){
        return redirect()->route('user.projects.index');
    });

    Route::resource('projects', ProjectController::class);

});

Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function(){

    Route::get('/dashboard', function(){
        return view('admin.dashboard');
    });

    Route::resource('categories', CategoryController::class);

    Route::delete('/projects/{project}', [ProjectModerationController::class,'destroy']);
    Route::delete('/media/{media}', [MediaController::class,'destroy']);

});