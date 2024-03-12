<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Adminpanel\UserController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

//RAJITHA///////////////////////
use App\Http\Controllers\Adminpanel\Home\MainSliderController;
use App\Http\Controllers\DealersContoller;
use App\Http\Controllers\masterdata\RegionContoller;
use App\Http\Controllers\masterdata\TerritoryContoller;
use App\Http\Controllers\masterdata\TownContoller;
use App\Http\Controllers\masterdata\CategoryContoller;
use App\Http\Controllers\masterdata\MakeContoller;
use App\Http\Controllers\masterdata\ModelContoller;
use App\Http\Controllers\masterdata\TyresizeContoller;
use App\Http\Controllers\masterdata\DesignnameContoller;
use App\Http\Controllers\masterdata\DesigncodeContoller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CompletedOrderController;
use App\Http\Controllers\CancelledOrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\masterdata\BankContoller;


use App\Http\Controllers\ProductController;


Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->middleware('auth')
    ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
    ->middleware('auth');

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::get('role-list',[RoleController::class,'index'])->name('role-list');
    Route::put('update-role', [RoleController::class, 'update'])->name('update-role');
    Route::get('/status-role/{id}', [RoleController::class, 'activation'])->name('status-role');
    Route::resource('users', UserController::class);
    Route::get('users-list',[UserController::class,'list'])->name('users-list');
    Route::put('save-user', [UserController::class, 'update'])->name('save-user');
    Route::get('changestatus-user/{id}', [UserController::class, 'activation'])->name('changestatus-user');
    Route::get('blockuser/{id}', [UserController::class, 'block'])->name('blockuser');
    Route::post('checkEmailAvailability', [UserController::class, 'checkEmailAvailability'])->name('checkEmailAvailability');
    Route::resource('products', ProductController::class);

     //////////////////HOME DATA //////////////////////////////////////////

//    Route::get('adminpanel/main-slider',[MainSliderController::class,'index'])->name('main-slider');
//    Route::post('new-main-slider', [MainSliderController::class, 'store'])->name('new-main-slider');
//    Route::get('adminpanel/main-slider-list',[MainSliderController::class,'list'])->name('main-slider-list');
//    Route::get('/edit-main-slider/{id}', [MainSliderController::class, 'edit'])->name('edit-main-slider');
//    Route::put('save-main-slider', [MainSliderController::class, 'update'])->name('save-main-slider');
//    Route::get('adminpanel/changestatus-mainslider/{id}', [MainSliderController::class, 'activation'])->name('changestatus-mainslider');
//    Route::get('adminpanel/blockmainslider/{id}', [MainSliderController::class, 'block'])->name('blockmainslider');
    
    //////////////////End MASTER DATA //////////////////////////////////////////
    
    
    /////////////////DEALERS///////////////////////////////////////
    
    Route::get('new-dealers', [DealersContoller::class, 'index'])->name('new-dealers');
    Route::post('new-dealers', [DealersContoller::class, 'store'])->name('new-dealers');
    Route::get('dealers-list', [DealersContoller::class, 'datalist'])->name('dealers-list');
    Route::get('/edit-dealers/{id}', [DealersContoller::class, 'edit'])->name('edit-dealers');
    Route::get('/status-dealers/{id}', [DealersContoller::class, 'activation'])->name('status-dealers');
    Route::post('get-state-cities', [DealersContoller::class, 'get_state_cities']) ->name('get-state-cities');
    Route::post('get-dealer-territories', [DealersContoller::class, 'get_dealer_territories']) ->name('get-dealer-territories');
    Route::get('/check_existing_dealercode_edit', [DealersContoller::class, 'check_existing_dealercode_edit'])->name('check_existing_dealercode_edit');
    //dealers user
    Route::get('new-dealer-user/{id}', [DealersContoller::class, 'add_dealer_user'])->name('new-dealer-user');
    Route::post('save-dealer-user', [DealersContoller::class, 'save_dealer_user'])->name('save-dealer-user');
    Route::post('checkEmail_dealeruser', [DealersContoller::class, 'checkEmail_dealeruser'])->name('checkEmail_dealeruser');
    Route::get('dealer-user-list/{id}', [DealersContoller::class, 'dealer_user_list'])->name('dealer-user-list');
    Route::get('/edit-dealer-user/{id}', [DealersContoller::class, 'edit_dealeruser'])->name('edit-dealer-user');
    Route::get('/status-dealer-user/{id}', [DealersContoller::class, 'status_dealer_user'])->name('status-dealer-user');
    
    /////////////////////////// Region master //////////////////
    Route::get('new-region', [RegionContoller::class, 'index'])->name('new-region');
    Route::post('new-region', [RegionContoller::class, 'store'])->name('new-region');
    Route::get('region-list', [RegionContoller::class, 'datalist'])->name('region-list');    
    Route::get('/edit-region/{id}', [RegionContoller::class, 'edit'])->name('edit-region');
    Route::get('/status-region/{id}', [RegionContoller::class, 'activation'])->name('status-region');
    
    /////////////////////////// territory master //////////////////
    Route::get('new-territory', [TerritoryContoller::class, 'index'])->name('new-territory');
    Route::post('new-territory', [TerritoryContoller::class, 'store'])->name('new-territory');
    Route::get('territory-list', [TerritoryContoller::class, 'datalist'])->name('territory-list');    
    Route::get('/edit-territory/{id}', [TerritoryContoller::class, 'edit'])->name('edit-territory');
    Route::get('/status-territory/{id}', [TerritoryContoller::class, 'activation'])->name('status-territory');
    
    /////////////////////////// town master //////////////////
    Route::get('new-town', [TownContoller::class, 'index'])->name('new-town');
    Route::post('new-town', [TownContoller::class, 'store'])->name('new-town');
    Route::get('town-list', [TownContoller::class, 'datalist'])->name('town-list');    
    Route::get('/edit-town/{id}', [TownContoller::class, 'edit'])->name('edit-town');
    Route::get('/status-town/{id}', [TownContoller::class, 'activation'])->name('status-town');
    Route::get('get-region-territories', [TownContoller::class, 'get_region_territories']) ->name('get-region-territories');
    
    
    /////////////////////////// category master //////////////////
    Route::get('new-category', [CategoryContoller::class, 'index'])->name('new-category');
    Route::post('new-category', [CategoryContoller::class, 'store'])->name('new-category');
    Route::get('category-list', [CategoryContoller::class, 'datalist'])->name('category-list');    
    Route::get('/edit-category/{id}', [CategoryContoller::class, 'edit'])->name('edit-category');
    Route::get('/status-category/{id}', [CategoryContoller::class, 'activation'])->name('status-category');
    
    /////////////////////////// make master //////////////////
    Route::get('new-make', [MakeContoller::class, 'index'])->name('new-make');
    Route::post('new-make', [MakeContoller::class, 'store'])->name('new-make');
    Route::get('make-list', [MakeContoller::class, 'datalist'])->name('make-list');    
    Route::get('/edit-make/{id}', [MakeContoller::class, 'edit'])->name('edit-make');
    Route::get('/status-make/{id}', [MakeContoller::class, 'activation'])->name('status-make');
    
    /////////////////////////// model master //////////////////
    Route::get('new-model', [ModelContoller::class, 'index'])->name('new-model');
    Route::post('new-model', [ModelContoller::class, 'store'])->name('new-model');
    Route::get('model-list', [ModelContoller::class, 'datalist'])->name('model-list');    
    Route::get('/edit-model/{id}', [ModelContoller::class, 'edit'])->name('edit-model');
    Route::get('/status-model/{id}', [ModelContoller::class, 'activation'])->name('status-model');
    
    /////////////////////////// tyresize master //////////////////
    Route::get('new-tyresize', [TyresizeContoller::class, 'index'])->name('new-tyresize');
    Route::post('new-tyresize', [TyresizeContoller::class, 'store'])->name('new-tyresize');
    Route::get('tyresize-list', [TyresizeContoller::class, 'datalist'])->name('tyresize-list');    
    Route::get('/edit-tyresize/{id}', [TyresizeContoller::class, 'edit'])->name('edit-tyresize');
    Route::get('/status-tyresize/{id}', [TyresizeContoller::class, 'activation'])->name('status-tyresize');
    
    /////////////////////////// design name master //////////////////
    Route::get('new-designname', [DesignnameContoller::class, 'index'])->name('new-designname');
    Route::post('new-designname', [DesignnameContoller::class, 'store'])->name('new-designname');
    Route::get('designname-list', [DesignnameContoller::class, 'datalist'])->name('designname-list');    
    Route::get('/edit-designname/{id}', [DesignnameContoller::class, 'edit'])->name('edit-designname');
    Route::get('/status-designname/{id}', [DesignnameContoller::class, 'activation'])->name('status-designname');
    
    /////////////////////////// design code master //////////////////
    Route::get('new-designcode', [DesigncodeContoller::class, 'index'])->name('new-designcode');
    Route::post('new-designcode', [DesigncodeContoller::class, 'store'])->name('new-designcode');
    Route::get('designcode-list', [DesigncodeContoller::class, 'datalist'])->name('designcode-list');    
    Route::get('/edit-designcode/{id}', [DesigncodeContoller::class, 'edit'])->name('edit-designcode');
    Route::get('/status-designcode/{id}', [DesigncodeContoller::class, 'activation'])->name('status-designcode');
    
     /////////////////////////// bank master //////////////////
     Route::get('new-bank', [BankContoller::class, 'index'])->name('new-bank');
     Route::post('new-bank', [BankContoller::class, 'store'])->name('new-bank');
     Route::get('bank-list', [BankContoller::class, 'datalist'])->name('bank-list');    
     Route::get('/edit-bank/{id}', [BankContoller::class, 'edit'])->name('edit-bank');
     Route::get('/status-bank/{id}', [BankContoller::class, 'activation'])->name('status-bank');
  
    /////////////////PRODUCT///////////////////////////////////////
    
    Route::get('new-product', [ProductController::class, 'index'])->name('new-product');
    Route::post('new-product', [ProductController::class, 'store'])->name('new-product');
    Route::get('product-list', [ProductController::class, 'datalist'])->name('product-list');
    Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('edit-product');
    Route::get('/status-product/{id}', [ProductController::class, 'activation'])->name('status-product');
    Route::get('/check_existing_productcode', [ProductController::class, 'check_existing_productcode'])->name('check_existing_productcode');
    Route::get('/check_existing_productcode_edit', [ProductController::class, 'check_existing_productcode_edit'])->name('check_existing_productcode_edit');
    Route::post('adminpanel/get-subcategory', [ProductController::class, 'get_subcategory'])->name('get-subcategory');
    
    /////////////////////////// ORDER /////////////////////////////////
    
    Route::get('order-list', [OrderController::class, 'datalist'])->name('order-list');
    Route::get('pending-order-details/{id}', [OrderController::class, 'edit'])->name('pending-order-details');
    Route::get('completed-order-list', [CompletedOrderController::class, 'datalist'])->name('completed-order-list');
    Route::get('completed-order-details/{id}', [CompletedOrderController::class, 'edit'])->name('completed-order-details');
    Route::get('cancelled-order-list', [CancelledOrderController::class, 'datalist'])->name('cancelled-order-list');
    Route::get('cancelled-order-details/{id}', [CancelledOrderController::class, 'edit'])->name('cancelled-order-details');
    
    Route::get('report-list', [ReportController::class, 'index'])->name('report-list');
    Route::get('dealer-commission-report', [ReportController::class, 'dealer_commission'])->name('dealer-commission-report');
    Route::post('dealer-commission-report-excel', [ReportController::class, 'dealer_commission_report_excel'])->name('dealer-commission-report-excel');
    
});
