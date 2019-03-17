<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();


// Route::resource('/team', 'TeamController');
// General Route

Route::prefix('api/v1')->group(function () {

    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    
    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
    
    // Password Reset Routes...
    // Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    // Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    // Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    // Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::get('user', 'UserController@checkUser');

});

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('api/v1')->middleware('auth')->group(function () {
    
    Route::get('/init', 'TodoController@init');
    Route::get('/team/my', 'TeamController@getMyTeams');
    Route::get('/team/{team}/members', 'TeamController@getMembers');
    Route::get('/team/{team}/todos', 'TodoController@getTodosFromTeam');
    Route::post('/team/{team}/todo/{todo}/reply', 'ReplyController@create');
    Route::get('/file', 'FileController@getMyFiles');
    Route::get('/file/{file}', 'FileController@getMySpecificFile');
    Route::post('/file', 'FileController@create');
    Route::get('/team/{team}/file/{file}', 'FileController@getFileFromTeam');
    Route::get('/team/{team}/file', 'FileController@getFileListFromTeam');
    Route::post('/reply/{reply}/file/{file}/toggle', 'FileController@toggleFileToReply');
    
    // Admin Route
    Route::get('/team/{team}/todo/{todo}/reply', 'TodoController@getRepliesFromTodo');
    Route::get('/team/{team}/member/{user}/toggle', 'TeamController@toggleMember');
    Route::post('/team/{team}/todos', 'TodoController@create');
    Route::post('/team', 'TeamController@store');
    Route::post('/team/{team}/todo/edit', 'TodoController@editTodo');
    Route::post('/team/{team}/file/{file}', 'FileController@toggleShareFileWithTeam');
    Route::get('/todo/{todo}/file/{file}', 'FileController@getFileFromTodo');
    Route::get('/todo/{todo}/replies', 'ReplyController@getRepliesFromTodo');

});    

