<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::group(['domain' => '{subdomain}.bentodelivery.com', ['middleware' => ['auth', 'domain']]], function () {
//     Route::get('/', function ($subdomain) {
//         // dd(['subdomains' => $subdomain]);
//         return $subdomain;
//     });
// });


Auth::routes();

Route::group(['domain' => '{subdomain}.bentodelivery.com', 'middleware' => ['auth', 'domain', 'accesswarehouse']], function() {
    // dd('suvbbb');


    Route::get('/', function ($subdomain) {
        return $subdomain;
    })->where('subdomain', 'www');

    Route::get('/racks/delete/{id}', 'Warehouse\Rack\RackController@deleteRack')->name('racks.delete');
    Route::post('/racks/{id}/edit-pick-seq', 'Warehouse\Rack\RackController@editPickSequence')->name('racks.editPickSeq');

    Route::resource('/racks', 'Warehouse\Rack\RackController'
    // , 
        // [
        //         'parameters' => [
        //             'subdomain' => $subdomain,
        //         ]
        // ]
    );

    Route::resource('/shelfs', 'Warehouse\Rack\ShelfController'
    // ,
        // [
        //         'parameters' => [
        //             'subdomain' => $subdomain,
        //         ]
        // ]

    );

    Route::get('/subshelfs/print', 'Warehouse\Rack\SubshelfController@print')->name('subshelfs.print');
    Route::resource('/subshelfs', 'Warehouse\Rack\SubshelfController'
    // ,
    // ['name' => [
    //     'print' => 'subshelfs.print'
    // ]
    // ]
    // ,
    //     [
    //             'parameters' => [
    //                 'subdomain' => $subdomain,
    //             ]
    //     ]

    );


});

Route::group(['middleware' => ['auth', 'domain']], function() {
    Route::get('/dashboard-datatable', 'Manage\Dashboard@index')->name('dashboard');

    Route::name('manage.users.datatable')->get('/users-datatable', 'Manage\ManageUserController@datatable');
    Route::resource('/users', 'Manage\ManageUserController');
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/user/{id}', 'UserController@show');

    // Route::name('manage.users')->get('/users', function () {
    //     return view('manage._manage_user');
    // });
    // Route::resource('/users', 'Manage\ManageUserController');

    // Route::get('/test', function() {
    //     return view('test');
    // });

    Route::get('/test', 'TestController@index')->name('test.test');

    Route::get('/dashboard', function () {
        return view('manage._dashboard', ['subdomain' => 'www']);
    })->name('manage.dashboard');

    Route::get('/choosewarehouse', 'Manage\ChooseWarehouseController@index')->name('manage.choosewarehouse');
});

