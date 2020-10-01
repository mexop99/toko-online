<?php

use Illuminate\Support\Facades\Route;

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
    // return view('welcome');
    return view('auth.login');
});

Auth::routes();

Route::match(["GET", "POST"], "register", function(){
    return redirect("/login");
})->name("register");

Route::get('/home', 'HomeController@index')->name('home');

Route::resource("users", "UserController");

/**
 * route untuk category
 * =================================================================================================
 */
Route::get('/categories/trash', 'CategoryController@trash')->name('categories.trash');
Route::get('categories/{id}/restore', 'CategoryController@restore')->name('categories.restore');
Route::delete('categories/{category}/delete-permanent', 'CategoryController@deletePermanent')->name('categories.delete-permanent');

Route::get('/ajax/categories/search', 'CategoryController@ajaxSearch');
Route::resource("categories", "CategoryController");
/**
 * =================================================================================================
 */


/**
 * Route untuk Products
 */
Route::get('/products/trash', 'ProductController@trash')->name('products.trash');
Route::get('/products/{product}/restore', 'ProductController@restore')->name('products.restore');
Route::delete('/products/{id}/delete-permanent', 'ProductController@deletePermanent')->name('products.delete-permanent');
Route::resource('products', 'ProductController');

/**
 * route untuk Order
 */
Route::resource('orders', 'OrderController');
