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
            Route::namespace('User')->group(function(){
                Route::get('admin/index','UserAdminController@index')
                ->name('Administrator');
                Route::get('admin/create/new/user','UserAdminController@create')
                ->name('user_create');
                Route::post('admin/create/new/user/register','UserAdminController@store')
                ->name('user_create_register');
                Route::get('admin/user/show','UserAdminController@addmin_user_edit')
                ->name('Admin_user_show');
                Route::get('admin/user/edit/{id}','UserAdminController@edit')
                ->name('Admin_user_edit');
                Route::resource('admin_user','UserAdminController',['only'=>['edit','destroy','update']]);
                Route::get('/csv_download','UserAdminController@csv_download')
                ->name('csv_download');

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
            Route::get('/mypage','UserController@index')->name('mypage');

            Route::get('mypage/edit','UserController@edit')->name('mypage_edit');
            Route::Post('mypage/edit', 'UserController@update')->name('mypage_update');

            Route::get('/user/all_user_list','UserController@show')->name('all_user_list');

            Route::namespace('Post')->group(function() {
                //トップページ
                Route::GET('/top','PostsController@top')->name('top_main');
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
                // Route::group(['middleware' => ['question_show']],function() {
                //     Route::get('/question/{question}','QuestionBoxController@show')
                //     ->name('question_show');
                // });

                Route::post('/post_comment/{post_comment}','PostCommentsController@store')->name('post_comment_store');
                Route::resource('post_comment','PostCommentsController',['only'=>['edit','update','destroy']]);

                Route::post('replies/{comment_replies}','PostCommentRepliesController@store')
                ->name('comment_replies');
                Route::resource('comment_replies','PostCommentRepliesController',['only'=>['edit','destroy']]);

                Route::post('/post_favorite','PostFavoritesController@postFavorite')
                ->name('post_favorite');

                Route::post('/post_comment_favorite','PostCommentFavoritesController@postCommentFavorite')
                ->name('post_comment_favorite');
                });

                Route::namespace('QuestionBox')->group(function() {
                    Route::get('/QuestionBox/{question_tag?}','QuestionBoxController@index')
                    ->name('question_index');
                    Route::get('/question/detail/{question}','QuestionBoxController@show')
                    ->name('question_detail');
                    Route::post('/question/detail/update/{question}','QuestionBoxController@update')
                    ->name('question_detail_update');

                    Route::get('/question_post','QuestionBoxController@create')
                    ->name('create_question');
                    Route::post('/question_post/store','QuestionBoxController@store')
                    ->name('store_question');
                    Route::post('/question/comment/{question_comment}','QuestionCommentController@store')
                    ->name('question_comment');
                    Route::post('/question/comment/replies/{question_comment_id}','QuestionBoxRepliesController@store')
                    ->name('question_replies_store');
                });
                Route::namespace('Chat')->group(function() {
                    Route::get('chat','ChatController@index')
                    ->name('chat_page');
                    Route::get('/chat/{user_id}','ChatController@show')
                    ->name('chat_room');
                    Route::post('/chat/send','ChatController@store')
                    ->name('chat_store');
                    // Route::get('/chat/result/ajax','ChatController@getChatData')
                    // ->name('chat_json');
                });
            });
        });
});