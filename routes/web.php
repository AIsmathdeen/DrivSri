<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LicenseHolderController;
use App\Http\Controllers\PoliceController;
use App\Http\Controllers\ChartController;
use App\Models\LicenseHolder;
use App\Mail\MyTestMail;

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

Auth::routes();

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);


//ADMIN SECTION

//---->LICENSE HOLDERS

//VIEWS


Route::group(['prefix' => '/admin','middleware' => ['role:admin']], function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'index']);
    Route::get('/view_license_holders', [\App\Http\Controllers\AdminController::class, 'viewLicensedHolders'])->name('admin.viewLicensedHolders');
    Route::get('/view_license_holder/{id}', [\App\Http\Controllers\AdminController::class, 'viewLicenseHolder']);
    Route::get('/add_license_holders', [\App\Http\Controllers\AdminController::class, 'addLicenseHolders']);
    Route::get('/update_license_holders/{id}', [\App\Http\Controllers\AdminController::class, 'viewupdateLicenseHolders']);
    Route::get('/view_certificate_list', [\App\Http\Controllers\AdminController::class, 'viewCertificateList']);
    Route::get('/notification/{id}', [\App\Http\Controllers\AdminController::class, 'sendCertifacate']);

    //REQUESTS
    Route::post('/save_license_holders', [\App\Http\Controllers\AdminController::class, 'storeLicenseHolder']);
    Route::delete('/delete_license_holders/{id}', [\App\Http\Controllers\AdminController::class, 'destroyLicenseHolder']);
    Route::post('/restore_license_holders/one/{id}',[\App\Http\Controllers\AdminController::class,'restoreLicenseHolder'])->name('admin.restoreLicensedHolders');
    Route::post('/edit_license_holders/{id}', [\App\Http\Controllers\AdminController::class, 'editLicensedHolder']);

    //---->POLICE OFFICERS

    //VIEWS
    Route::get('/view_police_officers', [\App\Http\Controllers\AdminController::class, 'viewPoliceOfficers'])->name('admin.viewPoliceOfficers');
    Route::get('/view_police_officer/{id}', [\App\Http\Controllers\AdminController::class, 'viewPoliceOfficer']);
    Route::get('/add_police_officers', [\App\Http\Controllers\AdminController::class, 'addPoliceOfficers']);
    Route::get('/update_police_officers/{id}', [\App\Http\Controllers\AdminController::class, 'updatePoliceOfficers']);

    //REQUESTS
    Route::post('/save_police_officers', [\App\Http\Controllers\AdminController::class, 'storePoliceOfficer']);
    Route::delete('/delete_police_officers/{id}', [\App\Http\Controllers\AdminController::class, 'destroyPoliceOfficer']);
    Route::post('/restore_police_officers/one/{id}',[\App\Http\Controllers\AdminController::class,'restorePoliceOfficers'])->name('admin.restorePoliceOfficers');
    Route::post('/edit_police_officers/{id}', [\App\Http\Controllers\AdminController::class, 'editPoliceOfficer']);


    //---->offences

    //VIEWS
    Route::get('/view_offences_list', [\App\Http\Controllers\AdminController::class, 'showOffencesList']);
    Route::get('/view_offence/{id}', [\App\Http\Controllers\AdminController::class, 'viewFine']);
    //Route::get('/add_offence', [\App\Http\Controllers\AdminController::class, 'showAddOffences']);
    Route::post('/calculate/fine', [\App\Http\Controllers\AdminController::class, 'calculateAmount']);
  //  Route::post('/save_offence', [\App\Http\Controllers\AdminController::class,'saveOffence']);


    //REQUESTS
     Route::delete('/delete_offence/{id}', [\App\Http\Controllers\AdminController::class, 'destroyFine']);
   // Route::post('/edit_fines/{id}', [\App\Http\Controllers\AdminController::class, 'editFine']);



    //---->OFFENSES

    //VIEWS
    Route::get('/view_fines', [\App\Http\Controllers\AdminController::class, 'showFineList']);
    Route::get('/view_fine/{id}', [\App\Http\Controllers\AdminController::class, 'showFine']);
   // Route::get('/view_add_fine', [\App\Http\Controllers\AdminController::class, 'showFine']);
    Route::get('/update_fine/{id}', [\App\Http\Controllers\AdminController::class, 'showUpdateFine']);
    Route::get('/view_add_fine', [\App\Http\Controllers\AdminController::class, 'showAddFine']);
    Route::POST('/add_fine/save', [\App\Http\Controllers\AdminController::class, 'storeFine']);
    Route::get('/search_fine', [\App\Http\Controllers\AdminController::class, 'searchFine']);
    Route::POST('/update_fine/update/{id}', [\App\Http\Controllers\AdminController::class, 'updateFine']);



    //Reports
    Route::get('/reports', [\App\Http\Controllers\AdminController::class, 'showReports']);
    Route::get('/reports/{type}', [\App\Http\Controllers\AdminController::class, 'showReportType']);
    Route::get('/reminders', [\App\Http\Controllers\AdminController::class, 'showReminder']);

    //REQUEST
    // Route::get('/view_offenses', [\App\Http\Controllers\AdminController::class, 'viewOffenses']);
    // Route::get('/add_offenses', [\App\Http\Controllers\AdminController::class, 'addOffenses']);
});
    Route::prefix('/policemen')->middleware('role:policeman')->group(function () {
    Route::get('/dashboard',[PoliceController::class,'index']);
    Route::get('/license_holders',[PoliceController::class,'showLicenHolders']);

    Route::get('/license_holder_details/{id}',[PoliceController::class,'showLicenHolderDetails']);
    Route::get('/view_add_offences',[PoliceController::class,'showAddOffences']);
    Route::get('/show_update_profile',[PoliceController::class,'showUpdateProfile']);
    Route::post('/update_profile/{id}',[PoliceController::class,'updateProfile']);

    Route::get('/view_offences_list',[PoliceController::class,'showOffencesList']);
    Route::post('/save_offence/{id}',[PoliceController::class,'saveOffence']);

    Route::post('/calculate/fine', [PoliceController::class, 'calculateAmount']);
    Route::post('/license_holder_name/find',[PoliceController::class,'findLicenseHolderName']);
    Route::get('/offences_all', [LicenseHolderController::class,'showAllOffences']);
});


Route::prefix('/licensed_holder')->middleware(['role:license-holder'])->group(function () {
    Route::get('/dashboard', [LicenseHolderController::class, 'index']);
    Route::get('/update_profile', [LicenseHolderController::class, 'showUpdateProfile']);
    Route::get('/offences_all', [LicenseHolderController::class,'showAllOffences']);
    Route::post('/offences/update_status', [LicenseHolderController::class, 'updatePaymentStatus']);
    Route::get('/offence/view/{id}', [LicenseHolderController::class, 'viewOffence']);
    Route::post('/update_license_holder',[LicenseHolderController::class,'updateLicenseHolder']);
    Route::get('/add_certificate',[LicenseHolderController::class,'showcertificatedetails']);
    Route::get('/save_certificate/{id}',[LicenseHolderController::class,'Viewcertificate']);
    Route::get('/view_fines', [LicenseHolderController::class, 'showFineList']);
});
// Route::get('chart', [ChartController::class, 'index']);
// Route::get('chart/numberofOffence', [ChartController::class, 'numberOfOffence']);
Route::post('payhere/notify', [\App\Http\Controllers\HomeController::class, 'payhereNotify']);
