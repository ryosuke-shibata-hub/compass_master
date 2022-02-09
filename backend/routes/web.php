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

//ログアウト時の画面
Route::group(['middleware' => ['guest']], function() {

    Route::get('/', function () {
    return view('welcome');
});

    Route::namespace('Auth')->group(function() {
        Route::namespace('Login')->group(function() {
            //ログイン画面
            Route::get('/login','LoginController@loginForm')->name('loginForm');
            Route::post('/login','LoginController@login')->name('login');
        });
        Route::namespace('Register')->group(function() {
            //登録画面
           Route::get('/register/form','RegisterController@registerForm')->name('register.form');
           Route::post('/register','RegisterController@register')->name('register');
           Route::get('/register/added','RegisterController@registerAdded')->name('register.added');
        });
    });
});
//ログイン時の画面
Route::group(['middleware' => ['auth']],function() {
    //管理者画面
    Route::group(['middleware' => ['can:admin']],function() {
        Route::namespace('Admin')->group(function() {
            Route::namespace('Post')->group(function(){
                Route::get('/post_category','PostsController@index')
                ->name('postCategory.index');
                Route::resource('post_main_category','PostMainCategoriesController',['only'=>['store','destroy']]);
                Route::resource('post_sub_category','PostSubCategoriesController',['only'=>['store','destroy']]);

        });
        });
    });

    //一般ユーザー、管理者共通画面
Route::group(['middleware' => ['can:user']],function() {

        Route::namespace('Auth')->group(function() {
            Route::namespace('Login')->group(function(){
                //ログアウト処理
                Route::get('/logout','LoginController@logout')
                ->name('logout');
            });
        });
        Route::namespace('User')->group(function() {
            Route::namespace('Post')->group(function() {
                //一覧表示
                Route::get('/post/index/{category?}','PostsController@index')
                ->name('userPostIndex');
                //投稿、編集、削除処理
                Route::resource('post','PostsController',['only'=>['create','store','edit','update','destroy']]);
                //投稿詳細ページ
                //view数カウント
                Route::group(['middleware' => ['post_show']],function() {
                Route::get('/post/{post}','PostsController@show')
                ->name('post_show');
                 });

                Route::post('/post_comment/{post_comment}','PostCommentsController@store')->name('post_comment_store');
                Route::resource('post_comment','PostCommentsController',['only'=>['edit','update','destroy']]);

                Route::post('/post_favorite','PostFavoritesController@postFavorite')
                ->name('post_favorite');

                Route::post('/post_comment_favorite','PostCommentFavoritesController@postCommentFavorite')
                ->name('post_comment_favorite');
                });
            });
        });
});
