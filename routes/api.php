<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

Route::get('articles', "ArticleController@getAllArticle")->name('getAllArticle');
Route::get('articles/{article}', "ArticleController@getArticle")->name('getArticle');

// to protect a group of api route
Route::middleware('auth:api')->group(function () {

    Route::put('articles/{id}', "ArticleController@updateArticle")->name('updateArticle');
    Route::delete('articles/{id}', "ArticleController@deleteArticle")->name('deleteArticle');
});
// similerly to protect a single api route. Both are same
Route::post('articles', "ArticleController@createArticales")->name('createArticales')->middleware('auth:api');


// to ger access authenticated api without authenticate (on your browser user after api/user?api_token=your api token)
Route::middleware('auth:api')->get('/user', function(Request $request) {
    return $request->user();
});



Route::get('/create', function () {

    User::forceCreate([
        'name' => 'Jone Doe',
        'email' => 'jone@doe.com',
        'password' => Hash::make('jone@doe')
    ]);
    User::forceCreate([
        'name' => 'Jene Doe',
        'email' => 'jene@doe.com',
        'password' => Hash::make('jene@doe')
    ]);
});

Route::get('/tokenc', function () {
    $user = User::find(1);
    $user->api_token = Str::random(60);
    $user->save();

    $user = User::find(2);
    $user->api_token = Str::random(60);
    $user->save();
});
