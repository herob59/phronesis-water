<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\ProductionController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\LogisticController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\Admin\POSController;
use App\Http\Controllers\Admin\ReportController;
use Barryvdh\DomPDF\Facade\Pdf;

Route::prefix('admin')->middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        // Production
        Route::resource('production', ProductionController::class);

        Route::get('production/report/pdf', [ProductionController::class, 'exportPdf'])
            ->name('production.pdf');

        Route::resource('users', UserController::class);


                // Reports

        Route::prefix('reports')->group(function () {

            Route::get('/', [ReportController::class, 'index'])->name('reports.index');

            Route::get('/daily', [ReportController::class, 'daily'])->name('reports.daily');

            Route::get('/weekly', [ReportController::class, 'weekly'])->name('reports.weekly');

            Route::get('/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');

            Route::get('/sales', [ReportController::class, 'sales'])->name('reports.sales');

            Route::get('/production', [ReportController::class, 'production'])->name('reports.production');

            Route::get('/stock', [ReportController::class, 'stock'])->name('reports.stock');

            Route::get('/expenses', [ReportController::class, 'expenses'])->name('reports.expenses');

            Route::get('/profit', [ReportController::class, 'profit'])->name('reports.profit');
        });
    });


    /*
    |--------------------------------------------------------------------------
    | ADMIN + STAFF
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,staff')->group(function () {

        // Products
        Route::resource('products', ProductController::class);



        // Save sale
        Route::post('sales', [SaleController::class, 'store'])->name('sales.store');
        // History
        Route::get('sales', [SaleController::class, 'index'])->name('sales.index');

        Route::resource('stock', StockController::class);

        Route::resource('logistics', LogisticController::class);

        Route::resource('expenses', ExpenseController::class);

        // POS
        Route::get('sales/create', [SaleController::class, 'create'])->name('sales.create');
        
        Route::get('pos', [POSController::class, 'index'])
            ->name('pos.index');

     


        // Invoice
       

        Route::post( '/cart/add/{product}', [SaleController::class, 'addToCart'])->name('cart.add');

        Route::post('/cart/increase/{id}',[SaleController::class, 'increaseQty'])->name('cart.increase');

        Route::post('/cart/decrease/{id}', [SaleController::class, 'decreaseQty'])->name('cart.decrease');
    });

});

    Route::prefix('staff')->middleware(['auth', 'role:staff'])->group(function () {

    Route::get('dashboard',[StaffDashboardController::class, 'index'])->name('staff.dashboard');

});


