<?php


Auth::routes();

Route::get('/', 'PuzzlesController@games');
Route::get('/home', 'PuzzlesController@games');
Route::get('/games', 'PuzzlesController@games')->name('games');
Route::get('/game_id/{image_id}', 'PuzzlesController@game_id')->name('game_id');

/* === Puzzles === */

Route::group(['middleware' => ['auth:web', 'fitter:web']], function () {

    Route::get('/load_image', 'Puzzles\PuzzlesController@load_image')->name('load_image');
    Route::post('/image_update', 'Puzzles\PuzzlesController@image_update')->name('image_update');
    Route::get('/image_select/{image_id}', 'Puzzles\PuzzlesController@image_select')->name('image_select');
    Route::post('/image_cut', 'Puzzles\PuzzlesController@image_cut')->name('image_cut');
    Route::post('/image_cut_delete', 'Puzzles\PuzzlesController@image_cut_delete')->name('image_cut_delete');
    Route::post('/image_cut_change', 'Puzzles\PuzzlesController@image_cut_change')->name('image_cut_change');
    Route::get('/game_list', 'Puzzles\PuzzlesController@game_list')->name('game_list');
    Route::get('/game_list_id/{image_id}', 'Puzzles\PuzzlesController@game_list_id')->name('game_list_id');
    Route::get('/delete_game/{image_id}', 'Puzzles\PuzzlesController@delete_game')->name('delete_game');
    Route::post('/game/visible', 'Puzzles\PuzzlesController@game_visible_post')->name('game_visible_post');

    Route::get('/fit/profile', 'Puzzles\PuzzlesController@profile')->name('fit_profile');
    Route::post('/fit/profile/update', 'Puzzles\PuzzlesController@profile_update')->name('fit_profile_form');

});


/* === ADMIN === */

Route::group(['middleware' => ['auth:web', 'admin:web']], function () {

    Route::get('/admin', 'Admin\AdminUsersController@index')->name('admin_users');
    Route::get('/admin/users', 'Admin\AdminUsersController@index')->name('admin_users');
    Route::get('/admin/user/new', 'Admin\AdminUsersController@admin_user_new')->name('admin_user_new');
    Route::post('/admin/user/insert', 'Admin\AdminUsersController@admin_user_new_form')->name('admin_user_new_form');
    Route::get('/admin/user/edit/{id}', 'Admin\AdminUsersController@admin_user_edit')->name('admin_user_edit');
    Route::post('/admin/user/update', 'Admin\AdminUsersController@admin_user_update_form')->name('admin_user_update_form');
    Route::post('/admin/user/delete', 'Admin\AdminUsersController@admin_user_delete')->name('admin_user_delete');

    Route::get('/admin/profile', 'Admin\AdminUsersController@profile')->name('admin_profile');
    Route::post('/admin/profile/update', 'Admin\AdminUsersController@profile_update')->name('admin_profile_form');

    Route::post('/admin/check_pictures', 'Admin\AdminPictureController@admin_pictures_check')->name('admin_pictures_check');

});

