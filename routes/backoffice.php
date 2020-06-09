<?php

/*
|--------------------------------------------------------------------------
| Backoffice Routes
|--------------------------------------------------------------------------
|
| Here is where you can register bo routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::middleware(['web'])->group(function () {

    Route::get('password/forgot', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.forgot');
    // Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    // Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.token');
    // Route::post('password/reset', 'ResetPasswordController@reset');

    Auth::routes(['register' => false]);
    Route::group(['middleware' => ['auth']], function () {
        Route::resource('parametre', 'SettingController');
        Route::get('/dashboard', 'DashboardController@index')->name('get.dashboard');
        Route::get('/parametre', 'SettingController@index')->name('get.setting');
        Route::post('/parametre/{parametre}', 'SettingController@update');
        Route::get('/hotels', ['uses' => 'HotelController@index', 'as' => 'hotels.index']);
        Route::get('/hotels/datacollection', 'HotelController@getHotels')->name('get.collecteddata');
        Route::get('/hotels/{hotel}/reservationcollection', 'HotelController@getreservations')->name('get.collectres');
        Route::get('/reservations/allreservations', 'ReservationController@allreservations')->name('get.resers');
        Route::get('/hotels/{hotel}', 'HotelController@show')->name('hotel.show');
        Route::delete('/hotels/destroy/{hotel}', 'HotelController@destroy')->name('hotel.destroy');
        Route::get('/hotels/{hotel}/reservation/{payment}', 'ReservationController@show')->name('reservation.show');
        Route::get('/reservations', 'ReservationController@index')->name('reservation.index');
        Route::get('/paiements', 'SubscriptionController@index')->name('get.subscription');
        Route::get('/paiements/allsubscriptions', 'SubscriptionController@allsubscriptions')->name('get.subscriptions');
        Route::get('/history/{id}', 'SubscriptionController@show')->name('subscription.show');
        Route::match(['put', 'patch'], '/paiements/activate/{id}', 'SubscriptionController@update')->name('subscription.update');//
        Route::get('/paiements/sendreminder/{id}', 'SubscriptionController@sendReminder');
        // Route::get('/subscriptions/print/{id}', 'SubscriptionController@print');
        Route::get('/addhotel', 'HotelController@hotel')->name('add.show');
        Route::post('/addhotel', 'HotelController@uploadImage')->name('add.post.show');
        Route::get('/rooms', 'RoomController@index')->name('room.show');
        Route::get('/voyages', 'HotelController@voyage')->name('voyage.show');// get voyage show
        Route::get('/autocars', 'HotelController@autocars')->name('autocars.show');
        Route::get('/addVoyage', 'VoyageController@voyage')->name('addVoyage.show');
        Route::get('/voyages/allvoyages', 'VoyageController@allvoyages')->name('get.voyage');// get all voyages
        Route::delete('/voyage/destroy/{voyage}', 'VoyageController@destroy')->name('voyage.destroy');
        // Route::get('/voyage/edit/{id}', 'VoyageController@edit')->name('voyage.edit');
        // Route::get('/voyage/edit/{id}', 'VoyageController@showVoyage')->name('show.voyage');
        Route::post('voyage/update/{id}', 'VoyageController@update')->name('voyage.update');
        //Route::put('/voyage/edit','VoyageController@update')->name('voyage.update');
        Route::get('/voyage/{id}', 'VoyageController@getVoyage')->name('voyage.get');





        Route::get('/autocars/allautocars', 'AutocarController@allautocars')->name('get.autocars');
        Route::get('/addautocar', 'AutocarController@addAutocars')->name('addAutocar.show');
        Route::post('/addautocar', 'AutocarController@AddAutocar')->name('addA.post.show');
        Route::delete('/autocars/destroy/{autocar}', 'AutocarController@destroy');
        Route::get('/addvoyage', 'VoyageController@addVoyage')->name('addVoyage.show');
        Route::post('/addvoyage', 'VoyageController@voyageAdd')->name('added.post.show');
        // Route::get('/addprogramme/{voyage}', 'HotelController@addprogramme')->name('programme.add'); //button
        // Route::post('/addprogramme/insert', 'ProgrammeController@add')->name('add'); //insertion
        Route::get('/voyages/{voyage}', 'VoyageController@show')->name('voyages.show');
        Route::get('/showprogramme', 'ProgrammeController@showprog')->name('programme.show');
        Route::get('/programmes/allprogramme', 'ProgrammeController@allprogrammes')->name('get.programmes');
        Route::post('/updatePhoto/{id}', 'VoyageController@updateimg')->name('image.update');
        Route::delete('/voyage/deleteimage/{id}', 'VoyageController@deleteimg')->name('image.delete');
        Route::delete('/voyage/deletall/{voyage}', 'VoyageController@allimg')->name('allimage.delete');
        Route::post('/add/voyage/{voyage}', 'VoyageController@imageAdd')->name('image.add');
        Route::get('/Updateprogramme/{voyage}', 'ProgrammeController@updateProgramm')->name('programme.update');

        Route::get('/programme/{voyage}', 'HotelController@addprogramme')->name('programme'); //button
        Route::get('/program/fetch_data', 'ProgrammeController@fetch_data');
        Route::post('/programme/add_data', 'ProgrammeController@add_data')->name('programme.add_data');
        Route::post('/programme/update_data', 'ProgrammeController@update_data')->name('programme.update_data');
        Route::post('/programme/delete_data', 'ProgrammeController@delete_data')->name('programme.delete_data');
        
        Route::get('/voyage/fetch_data', 'VoyageController@fetch_data');

        Route::delete('/voyage/imagechecked', 'VoyageController@CheckImage')->name('CheckImage.delete');

        
        // Route::get('/programme/{voyage}', 'HotelController@addprogramme')->name('programme'); //button
        // Route::get('/programme/fetch_data', 'ProgrammeController@fetch_data');  
        // Route::post('/programme/add_data', 'ProgrammeController@add_data')->name('programme.add_data');
        // Route::post('/programme/update_data', 'ProgrammeController@update_data')->name('programme.update_data');
        // Route::post('/programme/delete_data', 'ProgrammeController@delete_data')->name('programme.delete_data');

        Route::get('/paiements/{id}', 'SubscriptionController@getReservation')->name('res.get');
        Route::get('/rooms/allrooms', 'RoomController@allrooms')->name('get.room');// get all rooms
        Route::delete('/rooms/destroy/{room}', 'RoomController@destroy')->name('room.destroy');
        Route::get('/room/{room}', 'RoomController@show')->name('room1.show');
        Route::get('/room/{room}/reservationcollection', 'RoomController@getreservations')->name('get.reservationRoom');
        Route::get('/room/{room}/reservation/{payment}', 'ReservationController@show')->name('reservation.show');



        // Route::get('googlemap', 'MapController@map');
        // Route::get('googlemap/direction', 'MapController@direction');

    });
});
