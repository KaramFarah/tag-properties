<?php

use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\Dashboard\TagsController;
use App\Http\Controllers\Api\V1\Dashboard\UsersApiController;
use App\Http\Controllers\Api\V1\Dashboard\FloorsApiController;
use App\Http\Controllers\Api\V1\Dashboard\RangesApiController;
use App\Http\Controllers\Api\V1\Dashboard\PropertiesApiController;
use App\Http\Controllers\Api\V1\Dashboard\NearbyPlaceApiController;
use App\Http\Controllers\Api\V1\Dashboard\InstallmentsApiController;


Route::get('floors/new-floor', [FloorsApiController::class , 'newFloor'])->name('floor-plans');

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Dashboard', 'middleware' => ['auth:sanctum']], function () {
    
    Route::post('/properties/send-mail', 'PropertiesApiController@sendEmails')->name('mail');
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::get('users/new-favorite/{unit}', [UsersApiController::class , 'assignFavorite'])->name('new-favorite');
    Route::apiResource('users', 'UsersApiController');

    // Developers
    Route::apiResource('developers', 'DevelopersApiController');
    
    Route::apiResource('tags', 'TagsApiController');

    Route::get('floors/new-floor', [FloorsApiController::class , 'newFloor'])->name('floor-plans');
    Route::apiResource('floors', 'FloorsApiController');
    
    Route::apiResource('ranges', 'RangesApiController');

    Route::get('nearbyPlaces/new-place', [NearbyPlaceApiController::class , 'newPlace'])->name('nearby-places');
    Route::apiResource('nearbyPlaces', 'NearbyPlaceApiController');
   
    Route::apiResource('agents', 'AgentsApiController');

    Route::apiResource('campaigns', 'CampaignsApiController');

    Route::apiResource('leads', 'LeadsApiController');

    Route::apiResource('payments', 'InstallmentsApiController');

    Route::apiResource('projects', 'ProjectsApiController');

    Route::apiResource('media', 'MediaApiController');

    // Route::apiResource('media/delete-photos', 'MediaApiController')->name('deletePhotos', 'delete-photos');
    // Tags
});

