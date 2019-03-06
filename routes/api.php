<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([
    'prefix' => 'api-media',
], function () {
    //Js Tree Api
    Route::post('/jstree', 'Admin\Media\MediaApiController@getFolderChildrenJsTree');
    Route::post('/get-folder-childs', 'Admin\Media\MediaApiController@getFolderChilds');
    Route::post('/get-create-folder-child', 'Admin\Media\MediaApiController@getCreateFolderChild');
    Route::post('/get-edit-folder', 'Admin\Media\MediaApiController@getEditFolder');
    Route::post('/get-edit-folder-settings', 'Admin\Media\MediaApiController@getEditFolderSettings');
    Route::post('/get-folder-info', 'Admin\Media\MediaApiController@getFolderInfo');
    Route::post('/get-sort-folder', 'Admin\Media\MediaApiController@getSortFolder');
    Route::post('/get-remove-folder', 'Admin\Media\MediaApiController@getRemoveFolder');
    Route::post('/get-media-uploaders-settings', 'Admin\Media\MediaApiController@getUploaderSettings');
    Route::post('/get-media-uploader-rendered', 'Admin\Media\MediaApiController@getFolderUploader');
    Route::post('/download-folder', 'Admin\Media\MediaApiController@getDownload');
//ITEMS API
    Route::post('/get-sort-item', 'Admin\Media\MediaItemsApiController@getSortItems');
    Route::post('/get-remove-item', 'Admin\Media\MediaItemsApiController@getDeleteItems');
    Route::post('/upload', 'Admin\Media\MediaItemsApiController@uploadFile')->name('media_upload');
    Route::post('/replace-item', 'Admin\Media\MediaItemsApiController@replaceFile');
    Route::post('/rename-item', 'Admin\Media\MediaItemsApiController@renameFile');
    Route::post('/copy-item', 'Admin\Media\MediaItemsApiController@getCopyItems');
    Route::post('/transfer-item', 'Admin\Media\MediaItemsApiController@getTransferItems');
    Route::post('/get-item-details', 'Admin\Media\MediaItemsApiController@getItemDetalis');
    Route::post('/save-seo', 'Admin\Media\MediaItemsApiController@getSaveSeo');
});
