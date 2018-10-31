<?php

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('coba/login', 'coba@index' );
Route::post('tes/validasi', 'coba@validasi' );

Route::get('/', 'AdminController@index');
Route::get('/content', 'AdminController@content');
Route::get('/content/{id}', 'ContentController@show');
Route::get('/404', function(){
	return view('errors/404');
});
//Route::get('/crawler', 'BlogController@index');
Route::post('/crawler/urldefine', 'CrawlerController@urldefine');
Route::post('/crawler/browse', 'CrawlerController@browse');
Route::post('/crawler/crawl', 'CrawlerController@crawl');
Route::post('/crawler/detail', 'CrawlerController@selectBlock');
Route::post('/crawler/scrap', 'ScrapController@index');
Route::get('/admin/{user}', 'BlogController@admin');
Route::get('/content/history/trash', 'ContentController@showTrash');
Route::put('/content/edit', 'ContentController@update');
Route::get('/postajax/kategori','NaviController@kategori');
Route::post('/postajax/kategori','NaviController@kategori');
Route::get('/postajax/site','NaviController@site');
Route::post('/postajax/site','NaviController@site');
// Route::get('/login', function(){
// 	return view('/admin/login');
// });

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

