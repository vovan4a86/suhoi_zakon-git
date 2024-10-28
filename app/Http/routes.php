<?php

use App\Http\Controllers\AjaxController;

Route::get('robots.txt', 'PageController@robots')->name('robots');

Route::group(
    ['prefix' => 'ajax', 'as' => 'ajax.'],
    function () {
        Route::post('contact-us', 'AjaxController@postContactUs')->name('contact-us');
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

        Route::any('archive', ['as' => 'archive', 'uses' => 'ArchiveController@index']);
        Route::any('archive/{year}', ['as' => 'archive.item', 'uses' => 'ArchiveController@item'])
            ->where('year', '([0-9]+)');

        Route::any('magazines', ['as' => 'magazines', 'uses' => 'MagazinesController@index']);
        Route::any('magazines/{id}', ['as' => 'magazines.item', 'uses' => 'MagazinesController@item'])
            ->where('id', '([0-9]+)');

        Route::any('search', ['as' => 'search', 'uses' => 'PageController@search']);

        Route::any('policy', ['as' => 'policy', 'uses' => 'PageController@policy']);

        Route::any('{alias}', ['as' => 'default', 'uses' => 'PageController@page'])
            ->where('alias', '([A-Za-z0-9\-\/_]+)');
    }
);
