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

use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

Route::get('/', function () {
    return view('test');
});

Auth::routes();

Route::resource('role', 'RoleController', ['except' => 'show']);

Route::get('user/{id}/profile', 'UserController@editProfile');
Route::patch('user/{id}/profile', 'UserController@updateProfile');
Route::post('user/{id}/saveAvatar', 'UserController@saveAvatar');
Route::delete('user/{id}/deleteAvatar', 'UserController@deleteAvatar');
Route::resource('user', 'UserController', ['except' => ['create', 'store']]);

Route::resource('category', 'CategoryController');

Route::resource('product', 'ProductController');
Route::resource('characteristicProduct', 'CharacteristicProductController', ['except' => ['show']]);
Route::resource('moreCharacteristicProduct', 'MoreCharacteristicProductController', ['except' => ['show']]);
Route::post('product/{id}/saveImage', 'ProductController@saveImage');
Route::delete('product/{id}/deleteImage', 'ProductController@deleteImage');
Route::post('product/setMainImage', 'ProductController@setMainImage');

Route::get('imagecache', function ()
{
    $src = Input::get('src');
    $cacheimage = Image::cache(function($image) use ($src) {
        return $image->make($src);
    });

    return Response::make($cacheimage, 200, ['Content-Type' => 'image/jpeg']);
});

Route::get('admin', function () {
    return view('layouts/admin');
});

Route::get('/home', 'HomeController@index')->name('home');
