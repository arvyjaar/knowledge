<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('appeals', 'AppealsController', ['except' => ['create', 'edit']]);

        Route::resource('questions', 'QuestionsController', ['except' => ['create', 'edit']]);

        Route::resource('comments', 'CommentsController', ['except' => ['create', 'edit']]);

        Route::resource('documents', 'DocumentsController', ['except' => ['create', 'edit']]);

});
