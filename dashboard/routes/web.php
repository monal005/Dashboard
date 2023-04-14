<?php

use App\Http\Controllers\BlogsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Models\Blogs;
use App\Models\User;
use App\Models\UserRelation;
use App\Models\Users;
use Illuminate\Support\Facades\Route;

Route::get('/tenant',function(){
   return view('tenant');
});

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/dashboard',function(){
//     return view('dashboard_page');
// });
Route::get('/home',function(){
    return view('dashboard_page');
});

Route::resource('users', UserController::class);
// Route::resource('view', PostController::class);

Route::get('/login', function () {
    return view('auth.login');
});

// Route::get('/user/destroy/{id}',[UserController::class,'destroy'])->name('users.destroy');
Route::get('/user/edit/{id}', [UserController::class, 'edit']);

Route::post('/login', [UserController::class, 'login']);

Route::get('logout', [UserController::class, 'logout']);
// Route::get('/register',function(){
//     return view('auth.register');
// });  

// Route::get('/view',[PostController::class,'index']);


Route::group(['middleware' => 'guest'], function () {

    Route::get('login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [UserController::class, 'login']);

    Route::get('/register', function () {
        return view('auth.register');
    });

    Route::post('/register', [UserController::class, 'register']);
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [UserController::class, 'index']);
    // Route::post('',[UserController::class,'index'])
    Route::get('logout', [UserController::class, 'logout']);
});



Route::get('user/post/view/{user_id?}', [PostController::class, 'index'])->name('view.index');

Route::get('user/post', [PostController::class, 'show'])->name('view.show');

Route::post('user/post', [PostController::class, 'store'])->name('view.store');
Route::post('user/store', [UserController::class, 'store'])->name('users.store');
Route::get('/post/edit/{id}', [PostController::class, 'edit']);

Route::post('user/post/delete/{id}',[PostController::class,'destroy']);

Route::get('/relation',[UserController::class,'showRelation']);

Route::get('/blogs',[BlogsController::class,'index'])->name('blogs.index');
Route::get('/blogsIndex',[BlogsController::class,'index'])->name('blogs.index');

Route::post('blog/store', [BlogsController::class, 'store'])->name('blogs.store');
Route::get('/blog/edit/{id}', [BlogsController::class, 'edit']);
Route::get('/find',[BlogsController::class,'findings']);

Route::get('/newUser',[PostController::class,'newRelation']);

// Route::get('/blogIndex',[BlogsController::class,'index']);
// ******************** 3rd Party Login Auths routes **********************

Route::get('authorized/google', [LoginController::class, 'redirectToGoogle']);
Route::get('authorized/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('authorized/facebook', [LoginController::class, 'redirectToFacebook']);
Route::get('authorized/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

