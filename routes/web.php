<?php

use App\Http\Controllers\ActiveController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CounterpartiesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user', [UserController::class, 'current']);
    Route::get('/roles', [UserController::class, 'getRoles']);

    Route::group(['prefix' => 'users'], function () {
        Route::get('/managers', [UserController::class, 'managersList']);
        Route::get('/admins', [UserController::class, 'adminsList']);
        Route::get('/investors', [UserController::class, 'investorsList']);

        Route::get('/', [UserController::class, 'index'])->name('users.list');
        Route::post('/', [UserController::class, 'store']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'delete']);
    });

    Route::group(['prefix' => 'providers'], function () {
        Route::get('/', [ProviderController::class, 'list']);
        Route::get('/orders', [ProviderController::class, 'order_list'])->name('orders.list');
        Route::get('/{id}', [ProviderController::class, 'show']);
//        Route::get('/detail/{id}', [ProviderController::class, 'detail_show']);
        Route::post('/', [ProviderController::class, 'store']);
        Route::put('/{id}', [ProviderController::class, 'update']);
        Route::delete('/{id}', [ProviderController::class, 'delete']);
    });

    Route::group(['prefix' => 'counterparties'], function () {
        Route::get('/', [CounterpartiesController::class, 'list'])->name('counterparties.list');
        Route::get('/orders', [CounterpartiesController::class, 'order_list'])->name('orders.list');
        Route::post('/', [CounterpartiesController::class, 'store']);
        Route::get('/{id}', [CounterpartiesController::class, 'show']);
        Route::get('/detail/{id}', [CounterpartiesController::class, 'detail_show']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'delete']);
    });
    Route::group(['prefix' => 'orders'], function () {

        Route::get('/{id}', [OrderController::class, 'show']);
        Route::get('/detail/{id}', [OrderController::class, 'detail_show']);
//        Route::get('/types', [OrderController::class, 'types']);
//        Route::get('/kinds', [OrderController::class, 'kinds']);
//        Route::get('/contract/{dealId}', [OrderController::class, 'contract']);
//        Route::get('/act/{dealId}', [OrderController::class, 'act']);
//        Route::get('/payments/{dealId}', [OrderController::class, 'payments']);
//        Route::post('/', [OrderController::class, 'store']);
//        Route::get('/active/{id}', [OrderController::class, 'activeDeals']);
//        Route::put('/arhive/{id}', [OrderController::class, 'arhiveDeals']);
//        Route::delete('/{id}', [OrderController::class, 'delete']);
//        Route::put('/{id}', [OrderController::class, 'update']);
    });

    Route::group(['prefix' => 'clients'], function () {
        Route::get('/', [ClientController::class, 'index']);
        Route::post('/', [ClientController::class, 'store']);
        Route::get('/{id}', [ClientController::class, 'show']);
        Route::put('/{id}', [ClientController::class, 'update']);
        Route::delete('/{id}', [ClientController::class, 'delete']);
        Route::post('/{id}/upload', [ClientController::class, 'upload']);
        Route::delete('/{id}/delete-file/{fileId}', [ClientController::class, 'deleteFile']);
    });

    Route::group(['prefix' => 'companies'], function () {
        Route::get('/', [CompanyController::class, 'index']);
        Route::post('/', [CompanyController::class, 'store']);
        Route::get('/{id}', [CompanyController::class, 'show']);
        Route::put('/{id}', [CompanyController::class, 'update']);
    });

    Route::group(['prefix' => 'branches'], function () {
        Route::get('/', [BranchController::class, 'list']);
        Route::get('/dict', [BranchController::class, 'dict']);
        Route::post('/', [BranchController::class, 'store']);
        Route::get('/{id}', [BranchController::class, 'show']);
        Route::put('/{id}', [BranchController::class, 'update']);
        Route::delete('/{id}', [BranchController::class, 'delete']);
    });

    Route::group(['prefix' => 'actives'], function () {
        Route::get('/', [ActiveController::class, 'list']);
        Route::get('/{id}/credits', [ActiveController::class, 'credits']);
        Route::post('/', [ActiveController::class, 'store']);
        Route::get('/{id}', [ActiveController::class, 'show']);
        Route::put('/{id}', [ActiveController::class, 'update']);
        Route::delete('/{id}', [ActiveController::class, 'delete']);
    });

    Route::group(['prefix' => 'operations'], function () {
        Route::get('/', [OperationController::class, 'index']);
        Route::get('/active', [OperationController::class, 'active']);
        Route::get('/types', [OperationController::class, 'types']);
        Route::post('/', [OperationController::class, 'store']);
        Route::get('/{id}', [OperationController::class, 'show']);
        Route::put('/{id}', [OperationController::class, 'update']);
    });

    Route::group(['prefix' => 'payments'], function () {
        Route::get('/types', [PaymentController::class, 'types']);
        Route::get('/{dealId}', [PaymentController::class, 'index']);
        Route::post('/', [PaymentController::class, 'store']);
        Route::put('/{id}', [PaymentController::class, 'update']);
        Route::delete('/{id}', [PaymentController::class, 'delete']);
    });



    Route::group(['prefix' => 'sources'], function () {
        Route::get('/', [SourceController::class, 'index']);
        Route::post('/', [SourceController::class, 'store']);
        Route::get('/{id}', [SourceController::class, 'show'])->withTrashed();
        Route::put('/{id}', [SourceController::class, 'update']);
    });

    Route::group(['prefix' => 'stats'], function () {
        Route::get('/payments', [StatsController::class, 'finOperationsStats']);
        Route::get('/actives', [StatsController::class, 'activesStats']);
        Route::post('/payments/export', [StatsController::class, 'exportPayments']);
        Route::post('/actives/export', [StatsController::class, 'exportActives']);
    });

    Route::get('/', [IndexController::class, 'index'])->name('dashboard');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Auth::routes();
