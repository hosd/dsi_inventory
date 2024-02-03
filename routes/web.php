<?php

//use App\Models\Province;
use GuzzleHttp\Middleware;
//use App\Models\EstablishmentType;
//use App\Models\RegisterCoomplaint;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Adminpanel\LogActivityController;
use App\Http\Controllers\Adminpanel\DashboardController;
use App\Http\Controllers\Adminpanel\EventController;

use App\Http\Controllers\Frontend_dealer\DealerloginContoller;
use App\Http\Controllers\Frontend_dealer\ForgotPasswordController;
use App\Http\Controllers\API\AccessTokenController;

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

Route::get('/admin', function () {
    return view('auth.login');
    //return view('welcome');
});

Route::get('/', function () {
    return view('userpanel.index');
    //return view('welcome');
});

Route::get('/make-complaint', function () {
   // rename('index.html', 'index15-03-2022.html');
    return view('userpanel.index');
    //return view('welcome');
});

Route::get('/dealer-login', [DealerloginContoller::class, 'showLoginForm'])->name('dealer-login');

Route::post('/dealer-login', [DealerloginContoller::class, 'login'])
    ->middleware('dealer');


Route::get('/forgot-dealer-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->middleware('guest')
    ->name('forgot-dealer-password');
Route::post('/reset-dealer-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->middleware('guest')
    ->name('reset-dealer-password');

Route::get('/dealer-password-reset', [ForgotPasswordController::class, 'resetDealerPassword'])
    ->middleware('guest')
    ->name('dealer-password-reset');

Route::post('/dealer-password-reset', [ForgotPasswordController::class, 'reset'])
    ->middleware('guest')
    ->name('dealer-password-reset');

//Route::get('/main-dashboard', [DashboardController::class, 'mainDashboard'])->name('main-dashboard');


Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);


Route::get('/get-API-token', [AccessTokenController::class, 'getToken'])->name('get-API-token');

    /////////////////////////// DEALER LOGIN /////////////////////////////////
   
    // Route::middleware(['auth:dealer'])->group(function () {
    Route::group(['middleware' => ['auth:dealer', 'dealer']], function () {
    Route::get('dealer/dashboard', [DealerloginContoller::class, 'dashboard'])->name('dealer/dashboard');     
    
    //stocks
    Route::get('dealer/dealer-stock-list', [DealerloginContoller::class, 'stock_list'])->name('dealer/dealer-stock-list'); 
    Route::post('get-product-codes', [DealerloginContoller::class, 'get_product_codes']) ->name('get-product-codes');
    Route::post('save-dealer-stocks', [DealerloginContoller::class, 'store'])->name('save-dealer-stocks');
    Route::get('/status-dealer-stock/{id}', [DealerloginContoller::class, 'activation'])->name('status-dealer-stock');
    Route::get('dealer/reorder-stocks', [DealerloginContoller::class, 'reorder_stock_list'])->name('dealer/reorder-stocks'); 
    
    Route::get('dealer/user-list', [DealerloginContoller::class, 'user_list'])->name('dealer/user-list'); 
    Route::get('/dealer-user-status/{id}', [DealerloginContoller::class, 'dealer_user_status'])->name('dealer-user-status');
    Route::get('/dealer-user-edit/{id}', [DealerloginContoller::class, 'edit_dealeruser'])->name('dealer-user-edit');
    Route::post('/save-user-edit', [DealerloginContoller::class, 'save_dealeruser_edit'])->name('save-user-edit');
    
    Route::get('dealer/dealer-user-profile', [DealerloginContoller::class, 'dealer_user_profile'])->name('dealer/dealer-user-profile');
    Route::post('save_user_profile', [DealerloginContoller::class, 'save_user_profile'])->name('save_user_profile');
    Route::get('dealer-logout', [DealerloginContoller::class, 'logout'])->name('dealer-logout');
    
    Route::get('dealer/pending-orders', [DealerloginContoller::class, 'pending_orders'])->name('dealer/pending-orders'); 
    Route::get('dealer/completed-orders', [DealerloginContoller::class, 'completed_orders'])->name('dealer/completed-orders');     
    Route::get('dealer/cancelled-orders', [DealerloginContoller::class, 'cancelled_orders'])->name('dealer/cancelled-orders');     
    
    Route::get('/view-order-details/{id}', [DealerloginContoller::class, 'view_order_details'])->name('view-order-details');
    Route::post('/update-order-status', [DealerloginContoller::class, 'updateOrderStatus'] )->name('update-order-status');

    Route::get('dealer/commission-report', [DealerloginContoller::class, 'commission_report'] )->name('commission-report');
    Route::post('dealer/commission-report-excel', [DealerloginContoller::class, 'commission_report_excel'])->name('commission-report-excel');
});

Route::group(['middleware' => ['auth:web']], function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // });

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard-alloffices-summery', [DashboardController::class, 'officesSummery'])->name('dashboard-alloffices-summery');
    Route::get('dashboard-office-summery', [DashboardController::class, 'individualOfficeSummery'])->name('dashboard-office-summery');

    Route::view('profile', 'profile')->name('profile');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    });



require __DIR__ . '/auth.php';
