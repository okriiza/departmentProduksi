<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\JqueryAjaxController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Artisan;
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
//route group domain transaksi.okriiza.my.id 

// Route::domain('departmentproduksi.test')->group(function () {
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::resource('/customer', CustomerController::class)
    ->except('create', 'show', 'edit');
Route::resource('/item', ItemController::class)
    ->except('create', 'show', 'edit');

Route::get('/list-transaction', [TransactionController::class, 'index'])
    ->name('transaction.index');
Route::get('/list-transaction/transaction', [TransactionCOntroller::class, 'showTransaction'])
    ->name('transaction.showTransaction');
Route::get('add-item-cart', [TransactionController::class, 'addItemCart'])
    ->name('transaction.addItemCart');
Route::post('/list-transaction/transaction', [TransactionController::class, 'store'])
    ->name('transaction.store');
Route::patch('/update-item-cart', [TransactionController::class, 'update'])
    ->name('transaction.update');
Route::delete('/remove-item-cart', [TransactionController::class, 'destroy'])
    ->name('transaction.destroy');

Route::get('/getCustomer', [JqueryAjaxController::class, 'getCustomer'])
    ->name('jqueryAjax.getCustomer');

Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return 'optimize';
});
// });
