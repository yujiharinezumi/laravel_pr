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

//ブログ一覧画面表示
Route::get('/','BlogController@showList')->name
('blogs');


//詳細画面の上に作ること
//登録画面の表示
Route::get('/blog/create','BlogController@showCreate')->name
('create');

//ブログ登録
Route::post('/blog/store','BlogController@exeStore')->name
('store');


//ブログ詳細画面表示
Route::get('/blog/{id}','BlogController@showDetail')->name
('show');


//ブログ編集画面表示
Route::get('/blog/edit/{id}','BlogController@showEdit')->name
('edit');

//ブログの内容を更新する　
Route::post('/blog/update','BlogController@exeUpdate')->name
('update');


//ブログ削除
Route::post('/blog/delete/{id}','BlogController@exeDelete')->name
('delete');


