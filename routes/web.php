<?php

use Illuminate\Support\Facades\Route;
// Admin Dashboard
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\CreditController;
use App\Http\Controllers\Admin\LeadServiceController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\LocationSearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\EmployeeController;


// users Dashboard
use App\Http\Controllers\customer\DashboardController as customerDashboardController;
use App\Http\Controllers\users\UsersController;

// Vendor Dashboard
use App\Http\Controllers\company\DashboardController as companyDashboardController;
use App\Http\Controllers\company\VendorController;
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
    Route::get('/json/countries', function () {
        $path = base_path('countries.json');
        return response()->file($path);
    });
    
    Route::get('/json/states', function () {
        $path = base_path('states.json');
        return response()->file($path);
    });
    
    Route::get('/json/cities', function () {
        $path = base_path('cities.json');
        return response()->file($path);
    });
    
    Route::get('/signup', [RegisterController::class, 'register_form'])->name('signup');
    Route::get('logout', [LoginController::class, 'logout']);
    Route::get('account/verify/{token}', [LoginController::class, 'verifyAccount'])->name('users.verify');
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/', [HomeController::class,'login']);
    Route::get('/', [HomeController::class,'index']);
    Route::get('about-us', [HomeController::class,'about_us']);
    Route::get('contact-us', [HomeController::class,'contact_us']);
    Route::get('faqs', [HomeController::class,'faqs']);
    Route::get('service', [HomeController::class,'service']);
    Route::get('/search-service', [HomeController::class, 'search'])->name('search.service');
    Route::post('/lead-genrate', [HomeController::class,'lead_genrate'])->name('lead_genrate');
    Route::get('/get-service-form-data/{serviceType}', [HomeController::class, 'getServiceFormData'])->name('service.form');
    // Socailite Start
    Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle']);
    Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

    Route::get('auth/facebook', [SocialiteController::class, 'redirectToFacebook']);
    Route::get('auth/facebook/callback', [SocialiteController::class, 'handleFacebookCallback']);
    // Socailite End
    // Employee Register
    Route::get('/employee/register', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employee/register', [EmployeeController::class, 'store'])->name('employees.store');
    // End Employee
    // Socailite End
    // Auth::routes();
    Auth::routes(['verify' => true]); 
    //Admin
    Route::group(['prefix' => 'admin','middleware'=> ['auth', 'verified']], function(){
        Route::get('/change/password', [DashboardController::class, 'change_password'])->name('change_password');
        Route::post('/store_change_password', [DashboardController::class, 'store_change_password'])->name('store_change_password');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('roles', RoleController::class);
        Route::resource('permission', PermissionController::class);
        Route::resource('users', UserController::class);
        Route::resource('package', PackageController::class);
        Route::resource('companies', CompanyController::class);
        Route::resource('leads', LeadController::class);
        // Route::resource('employees/index', EmployeeController::class);
        Route::get('employees/index', [EmployeeController::class, 'index'])->name('employees.index');
        Route::resource('lead-services', LeadServiceController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('sliders', SliderController::class);
        Route::resource('services', ServiceController::class);
        Route::post('bulk-update-page', [ServiceController::class, 'bulkUpdatePage'])->name('services.bulkUpdatePage');
        Route::get('service/delete/{id}', [ServiceController::class,'destroy'])->name('services.destroy');
        Route::put('sbulk-update', [ServiceController::class, 'bulkUpdate'])->name('admin.services.bulkUpdate');


        Route::get('leads/show/{id}', [LeadController::class,'show'])->name('admin.leads.show');
        // Route::resource('credit', CreditController::class);
        Route::get('/profile', [DashboardController::class, 'admin_profile'])->name('profile.index');
        // Storage
        Route::get('/document', [DashboardController::class, 'document'])->name('document');
        Route::get('/signature', [DashboardController::class, 'signature'])->name('signature');
        Route::post('profile/update/{section}', [DashboardController::class, 'update'])->name('profile.update');
        Route::resource('general_setting',GeneralSettingController::class);
        // Routes for work
        // Route::resource('location', LocationSearchController::class);
        Route::get('/location', [LocationSearchController::class, 'index'])->name('location.index');
        Route::post('/location/search', [LocationSearchController::class, 'searchLocations'])->name('location.search');
        Route::post('/location/details', [LocationSearchController::class, 'getPlaceDetails'])->name('location.details');
        Route::get('/places/{placeId}/view', [LocationSearchController::class, 'viewPlace'])->name('places.view');
        Route::get('/places/{placeId}/review', [LocationSearchController::class, 'ReviewPlace'])->name('places.review');
        Route::post('/submit-review', [LocationSearchController::class, 'RivewStore'])->name('review.store');
    });
    //Customer
    Route::group(['prefix' => 'customer','middleware'=> ['auth', 'verified']], function(){
        Route::get('/leads-genrate', [customerDashboardController::class,'customer_leads_genrate'])->name('customer.lead_genrate');
        Route::post('/assign-to-company', [customerDashboardController::class,'assign_company'])->name('customer.assign_to_company');
        Route::get('/change/password', [customerDashboardController::class, 'users_change_password'])->name('customer.change_password');
        Route::post('/store/change/password', [customerDashboardController::class, 'users_store_change_password'])->name('customer.store_change_password');
        Route::get('/dashboard', [customerDashboardController::class, 'index'])->name('customer.dashboard');
        //users Profile
        Route::get('/profile', [customerDashboardController::class, 'profile'])->name('customer.profile');
        Route::post('/update/profile/{section}', [customerDashboardController::class, 'usersProfileUpdate'])->name('customer.profile.update');
        Route::post('/edit/profile', [customerDashboardController::class, 'user_edit_profile'])->name('customer.edit.profile');
        Route::post('/bank/detail', [customerDashboardController::class, 'usersBankDetail'])->name('customer.bank.detail');
    });
    //Company
    Route::group(['prefix' => 'company','middleware'=> ['auth', 'verified']], function(){
        Route::get('/dashboard', [companyDashboardController::class, 'index'])->name('company.dashboard');
        // Leads and Lead Pick
        // Route::get('/leads', [companyDashboardController::class, 'index'])->name('leads.index');
        Route::post('/leads/pick', [companyDashboardController::class, 'pick'])->name('leads.pick');

        Route::get('/leads', [companyDashboardController::class, 'LeadIndex'])->name('company.leads.index');
        Route::get('/leads-genrate', [companyDashboardController::class,'company_leads_genrate'])->name('company.lead_genrate');
        Route::get('leads/show/{id}', [companyDashboardController::class,'company_show'])->name('company.leads.show');
        Route::get('/change/password', [companyDashboardController::class, 'company_change_password'])->name('company.change_password');
        Route::post('/store/change/password', [companyDashboardController::class, 'company_store_change_password'])->name('company.store_change_password');
        Route::get('/profile', [companyDashboardController::class, 'companyProfile'])->name('company.profile');
        Route::post('/update/profile/{section}', [companyDashboardController::class, 'companyProfileUpdate'])->name('company.profile.update');
        Route::post('/edit/profile', [companyDashboardController::class, 'companyEditProfile'])->name('company.edit.profile');
        Route::post('/bank/detail', [companyDashboardController::class, 'companyBankDetail'])->name('company.bank.detail');
        Route::get('/puchase/package/{id}', [companyDashboardController::class, 'purchasePackageCreate'])->name('company.purchase.package');
        // Purchase Leads
        Route::get('/puchase/leads/assign/{id}', [companyDashboardController::class, 'leadPick'])->name('company.lead_pick');
        Route::get('/puchase/leads/not-intrested/{id}', [companyDashboardController::class, 'leadNotPick'])->name('company.lead_not_pick');

        Route::get('/puchase/leads', [companyDashboardController::class, 'purchaseleads'])->name('company.purchase_lead');

        Route::post('/stripe', [companyDashboardController::class, 'stripePost'])->name('company.stripe.post');
    });
