<?php

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\UnitsController;
use App\Http\Controllers\Dashboard\RangesController;
use App\Http\Controllers\Website\VerificationController;
use App\Http\Controllers\Website\PropertiesController;

Route::get('/home', function () {
    return redirect()->route('homepage');
});

Route::get('login' , [LoginController::class , 'showLoginForm'])->name('login');

Route::post('/otp/verify', [RegisterController::class , 'otpVerfication'])->name('opt-verifiy');
Route::post('/otp/resend', [RegisterController::class , 'otpResend'])->name('opt-resend');
Auth::routes();

// Route::redirect('/', '/welcome');
Route::group(['namespace' => 'Website'], function (){
    // Route::get('/', 'HomeController@holding')->name('holding');
    Route::get('/', 'HomeController@index')->name('homepage');
    Route::get('/about', 'HomeController@about')->name('about');
    Route::get('/faq', 'HomeController@questions')->name('faq');
    Route::get('/contact', 'HomeController@contact')->name('contact');
    Route::post('/contact', 'HomeController@sendContact')->name('contact-send');

    Route::get('/properties', 'PropertiesController@index')->name('properties');
    Route::get('/properties/list', 'PropertiesController@list')->name('property-list');
    Route::get('/properties/{unit:slug}', 'PropertiesController@show')->name('propertyShow');
    Route::get('/properties/print/{unit}', 'PropertiesController@print')->name('print');
    Route::post('/properties/send-mail', 'PropertiesController@sendEmails')->name('mail');
    Route::post('properties/create' , 'UnitsWebsiteController@store')->name('property-create');
    Route::post('/properties/collect-lead', 'PropertiesController@collectLead')->name('collect-lead');

    Route::get('/projects/{project:slug}', 'ProjectsWebsiteController@show')->name('projects.show');
    Route::get('/projects', 'ProjectsWebsiteController@index')->name('projects.index');
    
    Route::get('/developers', 'HomeController@developers')->name('developers.index');
    Route::get('/developers/{developer:slug}', 'HomeController@developersShow')->name('developers.show');
    
    Route::get('/blogs/details/{blog:slug}', 'BlogsWebsiteController@show')->name('blog.show');
    Route::get('/blogs/{tag:slug?}', 'BlogsWebsiteController@index')->name('blog.index');
    
    Route::get('/careers', 'CareersWebsiteController@index')->name('careers-list');
    Route::get('/careers/apply/{career}', 'CareersWebsiteController@apply')->name('apply-careers');
    Route::post('/careers/store', 'CareersWebsiteController@store')->name('apply-store');
});

// Route::group(['namespace' => 'Website', 'middleware' => ['auth']], function(){
    
// });

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'namespace' => 'Dashboard', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('clear-cache', 'HomeController@clearCache')->name('clear-cache');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Tags
    Route::delete('tags/destroy', 'TagsController@massDestroy')->name('tags.massDestroy');
    Route::get('/tags/massupdate', 'TagsController@massUpdate')->name('tags.massupdate');
    Route::resource('tags', 'TagsController');
    // Blogs
    Route::delete('blogs/destroy', 'BlogsController@massDestroy')->name('blogs.massDestroy');
    Route::resource('blogs', 'BlogsController');

    // Contacts
    Route::delete('contacts/destroy', 'ContactsController@massDestroy')->name('contacts.massDestroy');
    Route::post('/contacts/convert/{contact}', 'ContactsController@update')->name('contacts.create-convert');
    Route::get('contacts/index-auditlogs/{id}/{class}', 'ContactsController@indexAuditlogs')->name('contacts.index-auditlogs');
    Route::resource('contacts', 'ContactsController');
    
    // Leads
    Route::delete('leads/destroy', 'LeadsController@massDestroy')->name('leads.massDestroy');
    Route::get('leads/convert/{contact}', 'LeadsController@convert')->name('leads.convert');
    Route::get('leads/index-auditlogs/{id}/{class}', 'LeadsController@indexAuditlogs')->name('leads.index-auditlogs');
    Route::resource('leads', 'LeadsController');

    // comments
    Route::resource('comments', 'CommentsController');
    
    // Campaigns
    Route::delete('campaigns/destroy', 'CampaignsController@massDestroy')->name('campaigns.massDestroy');
    Route::resource('campaigns', 'CampaignsController');

    // Agents
    Route::delete('agents/destroy', 'AgentsController@massDestroy')->name('agents.massDestroy');
    Route::get('agents/index-auditlogs/{id}/{class}', 'AgentsController@indexAuditlogs')->name('agents.index-auditlogs');
    Route::resource('agents', 'AgentsController');

    // Calls
    Route::delete('actions/destroy', 'CallsController@massDestroy')->name('actions.massDestroy');
    Route::get('actions/add/{client}', 'CallsController@create')->name('actions.add');
    Route::get('actions/index-auditlogs/{id}/{class}', 'CallsController@indexAuditlogs')->name('actions.index-auditlogs');
    Route::get('actions/show-quick/{action}', 'CallsController@showQuick')->name('actions.show-quick');
    Route::resource('actions', 'CallsController');

    // Developers
    Route::delete('developers/destroy', 'DevelopersController@massDestroy')->name('developers.massDestroy');
    Route::get('developers/index-auditlogs/{id}/{class}', 'DevelopersController@indexAuditlogs')->name('developers.index-auditlogs');
    Route::resource('developers', 'DevelopersController');

    // MEDIA
    

    // Units
    Route::delete('units/destroy', 'UnitsController@massDestroy')->name('units.massDestroy');
    Route::delete('units/media-delete/{image}', 'UnitsController@deleteMedia')->name('units.deleteMedia');
    Route::get('units/index-auditlogs/{id}/{class}', 'UnitsController@indexAuditlogs')->name('units.index-auditlogs');
    Route::resource('units', 'UnitsController');

    //floors
    Route::delete('floors/destroy', 'FloorsController@massDestroy')->name('floors.massDestroy');
    Route::resource('floors', 'FloorsController');

    //Ranges
    Route::delete('ranges/destroy', 'RangesController@massDestroy')->name('ranges.massDestroy');
    Route::get('ranges/new', 'RangesController@newRange')->name('ranges.new-row');
    Route::resource('ranges', 'RangesController');

    // Projects
    Route::delete('projects/destroy', 'ProjectsController@massDestroy')->name('projects.massDestroy');
    Route::get('projects/index-auditlogs/{id}/{class}', 'ProjectsController@indexAuditlogs')->name('projects.index-auditlogs');
    Route::resource('projects', 'ProjectsController');

    // Installments
    // Route::delete('installments/destroy', 'InstallmentsController@massDestroy')->name('installments.massDestroy');
    // Route::resource('installments', 'InstallmentsController');

    // Media
    // Route::delete('media/destroy', 'MediaController@massDestroy')->name('media.massDestroy');
    // Route::resource('media', 'MediaController');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        
        //Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
    Route::get('/details/{user}', '\App\Http\Controllers\UserController@profile')->name('details');
});
