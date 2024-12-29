<?php

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    $users = User::query();

    if($request->has('search')){
        $users =  $users->where('name', 'like', '%' . $request->input('search') .'%');
    }

    return inertia('Home', ['users' => $users->paginate(5)->withQueryString(),
     'searchTerm' => $request->search, 
     'can' => ['delete_user' => Auth::user() ? Auth::user()->can('delete', User::class) : null
],
     ]);
})->name('home');


Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

Route::middleware(['guest'])->group(function (){

    Route::inertia('/register', 'Register')->name('register');

    Route::post('/register', [AuthController::class,'register'])->name('register.post');

    Route::inertia('/login', 'Login')->name('login');

    Route::post('/login', [AuthController::class,'login'])->name('login.post');

});

Route::middleware('auth')->group(function () {
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');
});