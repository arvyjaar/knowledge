<?php
Route::get('/', function () {
    return redirect('/admin/home');
});

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('tags', 'Admin\TagsController');
    Route::post('tags_mass_destroy', ['uses' => 'Admin\TagsController@massDestroy', 'as' => 'tags.mass_destroy']);
    Route::resource('results', 'Admin\ResultsController');
    Route::post('results_mass_destroy', ['uses' => 'Admin\ResultsController@massDestroy', 'as' => 'results.mass_destroy']);
    Route::resource('cities', 'Admin\CitiesController');
    Route::post('cities_mass_destroy', ['uses' => 'Admin\CitiesController@massDestroy', 'as' => 'cities.mass_destroy']);
    Route::resource('reasons', 'Admin\ReasonsController');
    Route::post('reasons_mass_destroy', ['uses' => 'Admin\ReasonsController@massDestroy', 'as' => 'reasons.mass_destroy']);
    Route::resource('appeals', 'Admin\AppealsController');
    Route::post('appeals_mass_destroy', ['uses' => 'Admin\AppealsController@massDestroy', 'as' => 'appeals.mass_destroy']);
    Route::post('appeals_restore/{id}', ['uses' => 'Admin\AppealsController@restore', 'as' => 'appeals.restore']);
    Route::delete('appeals_perma_del/{id}', ['uses' => 'Admin\AppealsController@perma_del', 'as' => 'appeals.perma_del']);
    Route::resource('court_decisions', 'Admin\CourtDecisionsController');
    Route::post('court_decisions_mass_destroy', ['uses' => 'Admin\CourtDecisionsController@massDestroy', 'as' => 'court_decisions.mass_destroy']);
    Route::resource('departments', 'Admin\DepartmentsController');
    Route::post('departments_mass_destroy', ['uses' => 'Admin\DepartmentsController@massDestroy', 'as' => 'departments.mass_destroy']);
    Route::post('departments_restore/{id}', ['uses' => 'Admin\DepartmentsController@restore', 'as' => 'departments.restore']);
    Route::delete('departments_perma_del/{id}', ['uses' => 'Admin\DepartmentsController@perma_del', 'as' => 'departments.perma_del']);
    Route::resource('categories', 'Admin\CategoriesController');
    Route::post('categories_mass_destroy', ['uses' => 'Admin\CategoriesController@massDestroy', 'as' => 'categories.mass_destroy']);
    Route::post('categories_restore/{id}', ['uses' => 'Admin\CategoriesController@restore', 'as' => 'categories.restore']);
    Route::delete('categories_perma_del/{id}', ['uses' => 'Admin\CategoriesController@perma_del', 'as' => 'categories.perma_del']);
    Route::resource('questions', 'Admin\QuestionsController');
    Route::post('questions_mass_destroy', ['uses' => 'Admin\QuestionsController@massDestroy', 'as' => 'questions.mass_destroy']);
    Route::post('questions_restore/{id}', ['uses' => 'Admin\QuestionsController@restore', 'as' => 'questions.restore']);
    Route::delete('questions_perma_del/{id}', ['uses' => 'Admin\QuestionsController@perma_del', 'as' => 'questions.perma_del']);
    Route::resource('comments', 'Admin\CommentsController');
    Route::post('comments_mass_destroy', ['uses' => 'Admin\CommentsController@massDestroy', 'as' => 'comments.mass_destroy']);
    Route::post('comments_restore/{id}', ['uses' => 'Admin\CommentsController@restore', 'as' => 'comments.restore']);
    Route::delete('comments_perma_del/{id}', ['uses' => 'Admin\CommentsController@perma_del', 'as' => 'comments.perma_del']);
    Route::resource('organisations', 'Admin\OrganisationsController');
    Route::post('organisations_mass_destroy', ['uses' => 'Admin\OrganisationsController@massDestroy', 'as' => 'organisations.mass_destroy']);
    Route::post('organisations_restore/{id}', ['uses' => 'Admin\OrganisationsController@restore', 'as' => 'organisations.restore']);
    Route::delete('organisations_perma_del/{id}', ['uses' => 'Admin\OrganisationsController@perma_del', 'as' => 'organisations.perma_del']);
    Route::resource('doccategories', 'Admin\DoccategoriesController');
    Route::post('doccategories_mass_destroy', ['uses' => 'Admin\DoccategoriesController@massDestroy', 'as' => 'doccategories.mass_destroy']);
    Route::post('doccategories_restore/{id}', ['uses' => 'Admin\DoccategoriesController@restore', 'as' => 'doccategories.restore']);
    Route::delete('doccategories_perma_del/{id}', ['uses' => 'Admin\DoccategoriesController@perma_del', 'as' => 'doccategories.perma_del']);
    Route::resource('documents', 'Admin\DocumentsController');
    Route::post('documents_mass_destroy', ['uses' => 'Admin\DocumentsController@massDestroy', 'as' => 'documents.mass_destroy']);
    Route::post('documents_restore/{id}', ['uses' => 'Admin\DocumentsController@restore', 'as' => 'documents.restore']);
    Route::delete('documents_perma_del/{id}', ['uses' => 'Admin\DocumentsController@perma_del', 'as' => 'documents.perma_del']);
    Route::post('/spatie/media/upload', 'Admin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'Admin\SpatieMediaController@destroy')->name('media.remove');
});
