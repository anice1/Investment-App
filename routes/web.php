<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;                
use App\Http\Controllers\adminController;
use App\Http\Controllers\MailController;

use App\Models\User;
use App\Models\Referal;

use Illuminate\Support\Facades\Hash;

Auth::routes(['verify'=>true]);

// Route::get('/clear-cache', function() {
//     Artisan::call('cache:clear');
//     return "Cache is cleared";
// });

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/test', function(Referal $referal){
//     $ref_code = auth()->user()->referal_detail->first()->ref_code;

//     $referals = $referal->all()->where('user_id',3);
//     return $referals;
// });

// Route::get('/send-email', 'MailController@sendEmail');

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard', 'HomeController@index');

    // Get User Referals
    Route::get('/referals', 'ReferalController@index');

    // Get User profile
    Route::get('/profile', 'UserController@userProfile');
    Route::post('/profile/edit/{id}','UserController@store');

});


Route::group(['prefix'=>'verification'], function(){
    Route::post('send', 'AccountVerifyController@sendVerificationEmail')->name('send');
    Route::get('verify', 'AccountVerifyController@verify')->name('verify');

});

    Route::middleware(['admin'])->group(function(){
    Route::get('/users', 'UserController@index');
    // Route::get('/users/{id}', 'UserController@getUser');

    // Blocking Users routes
    Route::get('users/delete/{id}', 'UserController@delete')->name('block_user');
    Route::get('users/blocked', 'UserController@blocked')->name('blocked');
    Route::get('users/restore/{id}', 'UserController@unblock')->name('unblock');

    //Payments
    Route::get('admin/view/deposit/settings', 'adminController@deposit_sett')->name('deposit_settings');
    Route::post('admin/update/deposit/settings', 'adminController@deposit')->name('deposit_update');
    Route::get('admin/view/deposit/history','adminController@deposit_history' )->name('history');

    Route::get('/admin/user/add/fund/{id}', 'adminController@admin_addfund');
   
    
    Route::get('/admin/reject/user/payment/{id}', 'adminController@rejectDep');
    Route::get('/admin/approve/user/payment/{id}', 'adminController@approveDep');
    Route::get('/admin/delete/user/payment/{id}', 'adminController@deleteDep');
});


Route::get('/{username}/wallet', function () {
    return view('user.load_wallet');
})->middleware('auth')->name('wallet');

Route::group(
    [
        'prefix' => 'drt',
        'as'     => 'drt.'

    ],
    function (){
        Route::get('/','UserController@pay_with_drt_btc')->name('index');
        Route::post('/pay_drt_amt', 'UserController@pay_drt_amt')->name('pay_drt_amt');
        Route::post('/receipt','UserController@receipt_upload')->name('rec_Upload');
    }

);


Route::group(
    [
        'prefix' => 'coinbase',
        'as'     => 'coinbase.'
    ],
    function () {
        Route::get('/', 'UserController@pay_with_coinbase_btc')->name('index');
        Route::post('/amt', 'UserController@pay_btc_coinbase_amt')->name('paybtcamt');
        Route::get('/{id}', 'UserController@coinbase_btc_confirm')->name('confirm');
        Route::get('/cron/btc/deposit', 'UserController@coinbase_cron_btc_deposit')->name('cron_btc_deposit');
    }
);



Route::group(
    [
        'prefix' => 'bcm',
        'as'     => 'bcm.'
    ],
    function () {
        Route::get('/', 'UserController@pay_with_bcm_btc')->name('index');
        Route::post('/pay_bcm_amt', 'UserController@pay_bcm_amt')->name('pay_bcm_amt');
        Route::get('/receive', 'UserController@payment_receive')->name('payment_receive');
        Route::get('/cb', 'UserController@bcm_btc_cb')->name('bcm_cb');
    }
);


Route::group(
    [
        'prefix' => 'coinpayment',
        'as'     => 'btc.'
    ],
    function () {
        Route::get('/', 'UserController@pay_with_btc')->name('index');
        Route::post('/amt', 'UserController@pay_btc_amt')->name('paybtcamt');
        Route::post('/confirm', 'UserController@btc_confirm')->name('confirm');
    }
);



Route::get('/deposit', 'DepositController@index');
