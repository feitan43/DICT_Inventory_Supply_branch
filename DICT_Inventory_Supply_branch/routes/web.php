<?php

use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserManagementController;
use App\Exports\ReportExport;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\LogTransactionController;
use App\Http\Controllers\UnitOfMeasureController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\RecipientController;


use App\Http\Controllers\ActivityLogController;
use App\Models\Product;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

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



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin', [AdminController::class, 'showAppView'])->middleware('role:admin');
Route::resource('log_transactions', LogTransactionController::class);


Route::group(['middleware'=>['auth']],function(){

  //  Route::prefix('user-management')->group(function () {
   //     Route::get('/', [UserManagementController::class, 'index'])->name('user-management.index');
    //    Route::get('/users', [UserManagementController::class, 'users'])->name('user-management.users');
    //    Route::get('/create', [UserManagementController::class, 'create'])->name('user-management.create');
      //  Route::post('/store', [UserManagementController::class, 'store'])->name('user-management.store');
      //  Route::delete('/users/{id}', [UserManagementController::class, 'destroy'])->name('user-management.destroy');
        
   // });
   
    Route::resource('recipients', RecipientController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('withdrawals', WithdrawalController::class);
    Route::resource('reports', ReportController::class);
    Route::post('/reports', [ReportController::class, 'generate'])->name('reports.generate');




    Route::resource('products', ProductController::class);
    Route::resource('activity-log', ActivityLogController::class);
    Route::resource('delivery', DeliveryController::class);
    Route::resource('change-password', ChangePasswordController::class);
    Route::resource('delivery', DeliveryController::class);
    Route::resource('log_transactions', LogTransactionController::class);
    Route::get('/admin', [AdminController::class, 'index'])->name('adminHome');
    Route::resource('unit_of_measures', UnitOfMeasureController::class);

    Route::get('change-password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('change-password.form');
    Route::post('change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');
    
    
 //Route::post('/product/adjust-quantity/{id}', [ProductController::class, 'adjustQuantity'])->name('products.adjustQuantity');
 //Route::get('/product/{id}/adjustment', [ProductController::class, 'showAdjustmentForm'])->name('products.adjustment');
 
 //Route::post('/log-transactions', [LogTransactionController::class, 'store'])->name('log_transactions.store');
 
 //Route::get('/log_transactions', [LogTransactionController::class, 'index'])->name('log_transactions.index');




    
  
// Display a listing of products
//Route::get('/products', [ProductController::class, 'index'])->name('product.index');



// Show the form for creating a new product


// Store a newly created product in storage
// Route::post('/products', [ProductController::class, 'store'])->name('product.store');

// Show the form for editing a specific product
// Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');

// Update the specified product in storage
// Route::put('/products/{product}', [ProductController::class, 'update'])->name('product.update');

// Delete the specified product
//Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
//Route::post('users/change-password', [UserController::class, 'changePassword'])->name('users.changePassword');

    
//Route::get('/search', [SearchController::class, 'index'])->name('search');

//Route::get('/download-excel-file', [ExportController::class, 'downloadExcelFile'])->name('export.download');

/*Route::get('/products/{id}', function ($id) {
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    return response()->json([
        'quantity' => $product->quantity
    ]);
})->name('products.show');
*/



//Route::get('/products', 'ProductController@index')->name('products.index');

//admin route
//Route::get('/admin', [AdminController::class, 'index'])->name('adminHome');
//language route
// Route::get('/admin/home/{lang}', [LanguageController::class, 'index'])->name('admin.home.lang');

    //category
  //  Route::resource('category', CategoryController::class);

  //  Route::resource('usermanagement', UserManagementController::class);

    //product


    //delivery
//    Route::resource('delivery', DeliveryController::class);
  //  Route::get('/deliveries', 'DeliveryController@index')->name('deliveries.index');
  //  Route::get('activity-log', [ActivityLogController::class, 'index'])->name('activity-log.index');

   

// Logout Route


 

});


