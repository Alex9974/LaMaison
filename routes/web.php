<?php

// Routes de l'Authentification et gestion du compte

Auth::routes();

Route::get('/compte', 'HomeController@index')->name('compte');

// Routes de la boutique et la gestion des produits

Route::get('/', 'ProductController@index')->name('product.index');
Route::get('/produit/{product}', 'ProductController@show')->name('product.show');
Route::get('/homme', 'ProductController@showMen')->name('product.showMen');
Route::get('/femme', 'ProductController@showWomen')->name('product.showWomen');
Route::get('/solde', 'ProductController@showSolds')->name('product.showSolds');

Route::resource('/admin', 'ProductController')->except('index', 'show', 'showMen', 'showWomen', 'showSolds'); 




