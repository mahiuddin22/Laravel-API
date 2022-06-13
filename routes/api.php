<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('articles',"ArticleController@getAllArticle")->name('getAllArticle');
Route::get('articles/{id}',"ArticleController@getArticle")->name('getArticle');
Route::post('articles/{id}',"ArticleController@createArticales")->name('createArticales');
Route::put('articles/{id}',"ArticleController@updateArticle")->name('updateArticle');
Route::delete('articles/{id}',"ArticleController@deleteArticle")->name('deleteArticle');


Route::get('/create', function(){

    User::forceCreate([
        'name'=>'Jone Doe',
        'email'=>'jone@doe.com',
        'password'=>Hash::make('jone@doe')
    ]);
    User::forceCreate([
        'name'=>'Jene Doe',
        'email'=>'jene@doe.com',
        'password'=>Hash::make('jene@doe')
    ]);

});