<?php

use App\Http\Controllers\AjaxController;

Route::get('robots.txt', 'PageController@robots')->name('robots');

Route::group(
    ['prefix' => 'ajax', 'as' => 'ajax.'],
    function () {
        Route::post('callback', 'AjaxController@postCallback')->name('callback');
        Route::post('request', 'AjaxController@postRequest')->name('request');
    }
);

Route::group(
    ['middleware' => ['redirects']],
    function () {
        Route::get('/', ['as' => 'main', 'uses' => 'WelcomeController@index']);

        Route::any('news', ['as' => 'news', 'uses' => 'NewsController@index']);
        Route::any('news/{alias}', ['as' => 'news.item', 'uses' => 'NewsController@item'])
            ->where('alias', '([A-Za-z0-9\-\/_]+)');

        Route::any('articles', ['as' => 'articles', 'uses' => 'ArticlesController@index']);
        Route::any('articles/{alias}', ['as' => 'articles.item', 'uses' => 'ArticlesController@item'])
            ->where('alias', '([A-Za-z0-9\-\/_]+)');


        Route::any('contacts', ['as' => 'contacts', 'uses' => 'PageController@contacts']);

        Route::any('ordering', ['as' => 'ordering', 'uses' => 'PageController@ordering']);

        Route::get('cart', ['as' => 'cart', 'uses' => 'CartController@getIndex']);

        Route::any('about', ['as' => 'about', 'uses' => 'PageController@about']);

        Route::any('policy', ['as' => 'policy', 'uses' => 'PageController@policy']);

        Route::any('catalog', ['as' => 'catalog.index', 'uses' => 'CatalogController@index']);
        Route::any('catalog/{alias}', ['as' => 'catalog.view', 'uses' => 'CatalogController@view'])
            ->where('alias', '([A-Za-z0-9\-\/_]+)');

        Route::any('{alias}', ['as' => 'default', 'uses' => 'PageController@page'])
            ->where('alias', '([A-Za-z0-9\-\/_]+)');
    }
);
