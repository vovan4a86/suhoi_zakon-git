<?php

use Fanky\Admin\Controllers\AdminCatalogController;

Route::group(['namespace' => 'Fanky\Admin\Controllers', 'prefix' => 'admin', 'as' => 'admin'], function () {
	Route::any('/', ['uses' => 'AdminController@main']);
	Route::group(['as' => '.pages', 'prefix' => 'pages'], function () {
		$controller  = 'AdminPagesController@';
		Route::get('/', $controller . 'getIndex');
		Route::get('edit/{id?}', $controller . 'getEdit')
			->name('.edit');

		Route::post('edit/{id?}', $controller . 'postEdit')
			->name('.edit');

		Route::get('get-pages/{id?}', $controller . 'getGetPages')
			->name('.get_pages');

		Route::post('save', $controller . 'postSave')
			->name('.save');

		Route::post('reorder', $controller . 'postReorder')
			->name('.reorder');

		Route::post('delete/{id}', $controller . 'postDelete')
			->name('.del');

		Route::post('top-view-del/{id}', $controller . 'postTopViewDel')
			->name('.top-view-del');

		Route::get('filemanager', [
			'as'   => '.filemanager',
			'uses' => $controller . 'getFileManager'
		]);

		Route::get('imagemanager', [
			'as'   => '.imagemanager',
			'uses' => $controller . 'getImageManager'
		]);

        Route::post('add-gost-file/{id}', [
            'as'   => '.addGostFile',
            'uses' => $controller . 'postAddGostFile'
        ]);

        Route::post('del-gost-file/{id}', [
            'as'   => '.delGostFile',
            'uses' => $controller . 'postDelGostFile'
        ]);

        Route::post('update-gost-file-order/{id}', [
            'as'   => '.updateGostFileOrder',
            'uses' => $controller . 'postUpdateGostFileOrder'
        ]);
	});

    Route::group(['as' => '.news', 'prefix' => 'news'], function () {
        $controller = 'AdminNewsController@';
        Route::get('/', $controller . 'getIndex');

        Route::get('edit/{id?}', $controller . 'getEdit')
            ->name('.edit');

        Route::post('save', $controller . 'postSave')
            ->name('.save');

        Route::post('delete/{id}', $controller . 'postDelete')
            ->name('.delete');

        Route::post('delete-image/{id}', $controller . 'postDeleteImage')
            ->name('.delete-image');

        Route::post('news-image-upload/{id}', $controller . 'postNewsImageUpload')
            ->name('.newsImageUpload');

        Route::post('news-image-delete/{id}', $controller . 'postNewsImageDelete')
            ->name('.newsImageDel');

        Route::post('news-image-order', $controller . 'postNewsImageOrder')
            ->name('.newsImageOrder');

        Route::post('image-edit/{id}', $controller . 'postImageEdit')
            ->name('.imageEdit');

        Route::post('image-data-save/{id}', $controller . 'postImageDataSave')
            ->name('.imageDataSave');
    });

    Route::group(['as' => '.articles', 'prefix' => 'articles'], function () {
        $controller = 'AdminArticlesController@';
        Route::get('/', $controller . 'getIndex');

        Route::get('edit/{id?}', $controller . 'getEdit')
            ->name('.edit');

        Route::post('save', $controller . 'postSave')
            ->name('.save');

        Route::post('delete/{id}', $controller . 'postDelete')
            ->name('.delete');

        Route::post('delete-image/{id}', $controller . 'postDeleteImage')
            ->name('.delete-image');

        Route::post('article-image-upload/{id}', $controller . 'postArticleImageUpload')
            ->name('.articleImageUpload');

        Route::post('article-image-delete/{id}', $controller . 'postArticleImageDelete')
            ->name('.articleImageDel');

        Route::post('article-image-order', $controller . 'postArticleImageOrder')
            ->name('.articleImageOrder');

        Route::post('image-edit/{id}', $controller . 'postImageEdit')
            ->name('.imageEdit');

        Route::post('image-data-save/{id}', $controller . 'postImageDataSave')
            ->name('.imageDataSave');
    });

    Route::group(['as' => '.archive', 'prefix' => 'archive'], function () {
        $controller = 'AdminArchiveController@';
        Route::get('/', $controller . 'getIndex');

        Route::get('edit/{id?}', $controller . 'getEdit')
            ->name('.edit');

        Route::post('save', $controller . 'postSave')
            ->name('.save');

        Route::post('delete/{id}', $controller . 'postDelete')
            ->name('.delete');

        Route::post('delete-image/{id}', $controller . 'postDeleteImage')
            ->name('.delete-image');
    });

    Route::group(['as' => '.reviews', 'prefix' => 'reviews'], function () {
        $controller = 'AdminReviewsController@';
        Route::get('/', $controller . 'getIndex');

        Route::get('edit/{id?}', $controller . 'getEdit')
            ->name('.edit');

        Route::post('save', $controller . 'postSave')
            ->name('.save');

        Route::post('reorder', $controller . 'postReorder')
            ->name('.reorder');

        Route::post('delete/{id}', $controller . 'postDelete')
            ->name('.del');

        Route::post('delete-image/{id}', $controller . 'postDeleteImage')
            ->name('.delImage');
    });

	Route::group(['as' => '.gallery', 'prefix' => 'gallery'], function () {
		$controller = 'AdminGalleryController@';
		Route::get('/', $controller . 'anyIndex');
		Route::post('gallery-save', $controller . 'postGallerySave')
			->name('.gallerySave');
		Route::post('gallery-edit/{id?}', $controller . 'postGalleryEdit')
			->name('.gallery_edit');
		Route::post('gallery-delete/{id}', $controller . 'postGalleryDelete')
			->name('.galleryDel');
		Route::any('items/{id}', $controller . 'anyItems')
			->name('.items');
		Route::post('image-upload/{id}', $controller . 'postImageUpload')
			->name('.imageUpload');
		Route::post('image-edit/{id}', $controller . 'postImageEdit')
			->name('.imageEdit');
		Route::post('image-data-save/{id}', $controller . 'postImageDataSave')
			->name('.imageDataSave');
		Route::post('image-del/{id}', $controller . 'postImageDelete')
			->name('.imageDel');
		Route::post('image-order', $controller . 'postImageOrder')
			->name('.order');
	});

    Route::group(['as' => '.feedbacks', 'prefix' => 'feedbacks'], function () {
        $controller = 'AdminFeedbacksController@';
        Route::get('/', $controller . 'getIndex');

        Route::post('read/{id?}',$controller . 'postRead')
            ->name('.read');
        Route::post('delete/{id?}', $controller . 'postDelete')
            ->name('.del');
    });

	Route::group(['as' => '.settings', 'prefix' => 'settings'], function () {
		$controller = 'AdminSettingsController@';
		Route::get('/', $controller . 'getIndex');

		Route::get('group-items/{id?}', $controller . 'getGroupItems')
			->name('.groupItems');

		Route::post('group-save', $controller . 'postGroupSave')
			->name('.groupSave');

		Route::post('group-delete/{id}', $controller . 'postGroupDelete')
			->name('.groupDel');

		Route::post('clear-value/{id}', $controller . 'postClearValue')
			->name('.clearValue');

		Route::any('edit/{id?}', $controller . 'anyEditSetting')
			->name('.edit');

		Route::any('block-params', $controller . 'anyBlockParams')
			->name('.blockParams');

		Route::post('edit-setting-save', $controller . 'postEditSettingSave')
			->name('.editSave');

		Route::post('save', $controller . 'postSave')
			->name('.save');
	});

	Route::group(['as' => '.redirects', 'prefix' => 'redirects'], function () {
		$controller = 'AdminRedirectsController@';
		Route::get('/', $controller . 'getIndex');

		Route::get('edit/{id?}', $controller . 'getEdit')
			->name('.edit');

		Route::get('delete/{id}', $controller . 'getDelete')
			->name('.delete');

		Route::post('save', $controller . 'postSave')
			->name('.save');
	});

	Route::group(['as' => '.users', 'prefix' => 'users'], function () {
		$controller = 'AdminUsersController@';
		Route::get('/', $controller . 'getIndex');

		Route::post('edit/{id?}', $controller . 'postEdit')
			->name('.edit');

		Route::post('save', $controller . 'postSave')
			->name('.save');

		Route::post('del/{id}', $controller . 'postDelete')
			->name('.del');
	});
});
