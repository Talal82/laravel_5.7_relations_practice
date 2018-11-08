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

Auth::routes(['verify' => true]);
Route::get('dashboard', 'HomeController@index') -> name('dashboard');

// admin routes
Route::prefix('admin') -> middleware(['auth', 'verified']) -> group(function(){

	Route::get('/', function(){
		return redirect() -> route('dashboard');
	});
	//admin categories routes
	Route::resource('categories', 'CategoryController') -> except('show');
	//delete multiple categories
	Route::delete('delete-multiple-categories', 'CategoryController@deleteMultiple') -> name('delete.multiple.categories');

	//admin sub_categories routes
	Route::get('categories/{slug}/{id}', 'SubCategoryController@index') -> name('sub_categories.index');
	Route::get('categories/{id}/create/sub', 'SubCategoryController@create') -> name('sub_categories.create');
	Route::post('categories/{id}/store/sub', 'SubCategoryController@store') -> name('sub_categories.store');
	Route::get('categories/sub/{id}/edit', 'SubCategoryController@edit') -> name('sub_categories.edit');
	Route::put('categories/sub/{id}/update', 'SubCategoryController@update') -> name('sub_categories.update');
	Route::delete('categories/sub/{id}/delete', 'SubCategoryController@destroy') -> name('sub_categories.destroy');
	//delete multiple sub-categories
	Route::delete('categories/{slug}/delete-multiple-sub-categories', 'SubCategoryController@deleteMultiple') -> name('delete.multiple.sub-categories');


	//admin routes for projects
	Route::get('categories/{projectable_type}/{projectable_id}/projects', 'ProjectController@index') -> name('projects.index');
	Route::get('categories/{projectable_type}/{projectable_id}/projects/create', 'ProjectController@create') -> name('projects.create');
	Route::post('categories/projects/store', 'ProjectController@store') -> name('projects.store');
	Route::get('categories/projects/{project_id}/edit', 'ProjectController@edit') -> name('projects.edit');
	Route::put('categories/projects/{project_id}/update', 'ProjectController@update') -> name('projects.update');

	Route::delete('categories/projects/{id}/delete', 'ProjectController@destroy') -> name('projects.destroy');
	
});
