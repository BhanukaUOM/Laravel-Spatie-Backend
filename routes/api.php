<?php
use Illuminate\Http\Request;


Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('signup/activate/{token}', 'AuthController@signupActivate');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::group([
    'namespace' => 'Auth',
    'middleware' => 'api',
    'prefix' => 'password'
], function () {
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
    Route::post('users/pause', 'UsersController@pause');
});

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::resource('roles', 'RolesController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
    Route::get('role', 'RolesController@allRoles');
});

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::resource('permissions', 'PermissionsController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
    Route::get('permission', 'PermissionsController@allPermissions');
});
