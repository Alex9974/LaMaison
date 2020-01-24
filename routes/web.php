<?php

// Routes de l'Authentification et gestion du compte //////////////////////////////

    Auth::routes();

    // Page d'accueil du back office (back office accessible uniquement aux membres administrateurs)
    Route::get('/admin', 'HomeController@index')->name('compte');    
    

// Routes de la boutique et la gestion des produits //////////////////////////////

    // Page d'accueil du site qui affiche tous les produits en ligne (front accessible à tous)
    Route::get('/', 'ProductController@index')->name('product.index');

    // Page qui affiche un produit en particulier (front accessible à tous)
    Route::get('/produit/{product}', 'ProductController@show')->name('product.show');

    // Page pour permuter l'image principale d'un produit en particulier (front accessible à tous)
    Route::get('/switchpict/{product}', 'ProductController@switchPicture')->name('product.switchpicture');

    // Page qui affiche tous les produits en ligne de la catégorie Homme (front accessible à tous)
    Route::get('/homme', 'ProductController@showMen')->name('product.showMen');

    // Page qui affiche tous les produits en ligne de la catégorie Femme (front accessible à tous)
    Route::get('/femme', 'ProductController@showWomen')->name('product.showWomen');

    // Page qui affiche tous les produits en ligne soldés (front accessible à tous)
    Route::get('/solde', 'ProductController@showSolds')->name('product.showSolds');

    // Page pour la suppression d'un produit (back office accessible uniquement aux membres administrateurs)
    Route::get('/admin/{admin}/destroy', 'ProductController@editDestroy')->name('admin.editdestroy');

    // Pages pour accéder au CRUD (back office accessible uniquement aux membres administrateurs)
    Route::resource('/admin', 'ProductController')->except('index', 'show', 'showMen', 'showWomen', 'showSolds', 'switchPicture'); 




