<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


use App\Http\Controllers\User\ProjectController as UserProject;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProjectController as AdminProject;
use App\Http\Controllers\Admin\MediaController;

Route::get('/login', fn() => view('auth.login'))->name('login');

Route::post('/login', function () {
    if (Auth::attempt(request(['email','password']))) {
        return redirect('/projects');
    }
    return back()->with('error','Login gagal');
});

Route::get('/register', fn() => view('auth.register'))->name('register');

Route::post('/register', function () {
    $data = request()->validate([
        'name'=>'required',
        'email'=>'required|email|unique:users',
        'password'=>'required|min:6'
    ]);

    $user = User::create([
        'name'=>$data['name'],
        'email'=>$data['email'],
        'password'=>bcrypt($data['password']),
        'role_id'=>2
    ]);

    Auth::login($user);
    return redirect('/projects');
});

Route::get('/logout', function(){
    Auth::logout();
    return redirect('/login');
});

Route::middleware('auth')->group(function () {
    Route::resource('projects', UserProject::class);
});

Route::prefix('admin')->middleware(['auth','admin'])->group(function () {

    Route::get('/', fn() => "Admin Dashboard");

    Route::resource('categories', CategoryController::class);

    Route::resource('projects', AdminProject::class);

    Route::delete('/media/{media}', [MediaController::class,'destroy']);
});