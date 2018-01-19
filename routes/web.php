<?php

//alias for welcome page
Route::get('login', function () {
    return view('welcome');
})->middleware('guest');

Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('welcome');

Route::resource('serials', 'SerialNumbersController');

Route::post('/login', "Auth\LoginController@login")->name('login');

Route::get('/logout', "Auth\LoginController@logout")->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

/*fielders*/
Route::get('fielders/{fielder}/avatar', 'FieldersController@avatar')->name('avatar.create');
Route::post('fielders/{fielder}/avatar', 'FieldersController@uploadAvatar')->name('avatar.store');
Route::get('fielders/search', 'FieldersController@search')->name('fielders.search');
Route::resource('/fielders', 'FieldersController');

Route::resource('/stock', 'StocksController');
Route::resource('/payments', 'PaymentsController');

//repots

Route::get('/reports', 'ReportsController@index')->name('reports.index');

Route::post('/reports', 'ReportsController@data')->name('reports.data');
Route::post('/reports/daily', 'ReportsController@daily')->name('reports.data');
Route::get('/reports/daily', 'ReportsController@daily')->name('reports.data');

Route::post('loadingDetails', function () {
    cache()->flush();

    return app(App\Defaults::class)->loadingDetails();
});

Route::get('/purchases/percentages', function () {
    return response()->json(\App\Store::loading());
});

Route::get('/test', function () {
    throw new \Exception('message');
});

Route::resource('purchases', 'PurchasesController');

Route::resource('configurations', 'ConfigurationsController');

//transactions
Route::get('transactions/data', 'TransactionsController@data');
Route::resource('/transactions', 'TransactionsController');

//statements

Route::resource('/statements', 'StatementsController');

Route::resource('/savings', 'SavingsController');

Route::get('docs', function () {
    return view('docs.index');
})->name('docs');
