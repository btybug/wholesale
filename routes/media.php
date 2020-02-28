<?php

Route::middleware('admin')->group(function () {
    Route::post('/get-create-folder-child', 'Admin\Media\MediaApiController@getCreateFolderChild')->name('media_create_folder');
    Route::post('/get-edit-folder', 'Admin\Media\MediaApiController@getEditFolder')->name('media_edit_folder');
    Route::post('/get-edit-folder-settings', 'Admin\Media\MediaApiController@getEditFolderSettings')->name('media_edit_folder_settings');
    Route::post('/get-sort-folder', 'Admin\Media\MediaApiController@getSortFolder')->name('media_sort_folder');
    Route::post('/get-remove-folder', 'Admin\Media\MediaApiController@getRemoveFolder')->name('media_remove_folder');

    Route::post('/get-sort-item', 'Admin\Media\MediaItemsApiController@getSortItems');
    Route::post('/get-remove-item', 'Admin\Media\MediaItemsApiController@getDeleteItems')->name('media_remove_item');
    Route::post('/upload', 'Admin\Media\MediaItemsApiController@uploadFile')->name('media_upload');
    Route::post('/replace-item', 'Admin\Media\MediaItemsApiController@replaceFile');
    Route::post('/rename-item', 'Admin\Media\MediaItemsApiController@renameFile')->name('media_rename_item');
    Route::post('/copy-item', 'Admin\Media\MediaItemsApiController@getCopyItems')->name('media_copy_item');
    Route::post('/transfer-item', 'Admin\Media\MediaItemsApiController@getTransferItems')->name('media_transfer_item');
    Route::post('/save-seo', 'Admin\Media\MediaItemsApiController@getSaveSeo')->name('media_save_seo');
    Route::post('/empty-trash', 'Admin\Media\MediaApiController@emptuTrash')->name('media_empty_trash');
});

Route::post('/jstree', 'Admin\Media\MediaApiController@getFolderChildrenJsTree')->name('media_tree');
Route::post('/get-folder-childs', 'Admin\Media\MediaApiController@getFolderChilds')->name('media_folder_childs');
Route::post('/get-folder-info', 'Admin\Media\MediaApiController@getFolderInfo')->name('media_get_folder_info');

Route::post('/get-media-uploaders-settings', 'Admin\Media\MediaApiController@getUploaderSettings')->name('media_get_uploader_settings');
Route::post('/get-media-uploader-rendered', 'Admin\Media\MediaApiController@getFolderUploader');
Route::post('/download-folder', 'Admin\Media\MediaApiController@getDownload');
//ITEMS API

Route::post('/get-item-details', 'Admin\Media\MediaItemsApiController@getItemDetalis');

