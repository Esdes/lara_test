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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function(){
	Route::resource('/posts','PostController')->names('blog.posts');
});

//Blog admin 
$groupData = [
	'namespace' => 'Blog\Admin',
	'prefix' 	=> 'admin/blog',
];

Route::group($groupData, function(){
//Blog categories
	$methods = ['index', 'edit', 'update', 'create', 'store',];
	Route::resource('/categories', 'CategoryController')
		->only($methods)
		->names('admin.blog.categories');

//Blog posts
	Route::get('/posts/{post}/restore', 'PostController@restore')
		->name('admin.blog.posts.restore');

	Route::resource('/posts', 'PostController')
		->except(['show'])
		->names('admin.blog.posts');
});

//test ajax

Route::group(['prefix' => 'tasks', 'namespace' => 'Test'], function () {

    Route::get('/', [
        'uses' => 'TasksController@index',
        'as' => 'tasks.index',
    ]);

    Route::get('/{id}', [
        'uses' => 'TasksController@show',
        'as'   => 'tasks.show',
    ]);

    Route::post('/', [
        'uses' => 'TasksController@store',
        'as'   => 'tasks.store',
    ]);

    Route::put('/{id}', [
        'uses' => 'TasksController@update',
        'as'   => 'tasks.update',
    ]);

    Route::delete('/{id}', [
        'uses' => 'TasksController@destroy',
        'as'   => 'tasks.destroy',
    ]);
});