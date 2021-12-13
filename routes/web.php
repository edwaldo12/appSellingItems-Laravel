<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GoodController;
use App\Http\Controllers\HalamanUtamaController;
use App\Http\Controllers\PreOrderController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\PrintContainerController;
use App\Http\Controllers\PrintSendingItemsController;
use App\Http\Controllers\SendingItemsController;
use App\Http\Controllers\SupplierController;
use App\Models\PreOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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


Route::group(['middleware' => 'auth'], function () {
    Route::resource('goods', GoodController::class);
    Route::resource('users', UserController::class);
    Route::resource('containers', ContainerController::class);
    Route::resource('sendingItems', SendingItemsController::class);
    Route::resource('halaman_utama', HalamanUtamaController::class);

    Route::get('/', function () {
        return redirect::to('halaman_utama');
    });

    Route::resource('print', PrintController::class);
    Route::get('printpage/{good_id}', [PrintController::class, 'print'])->name('print.printpage');
    Route::get('printpageall', [PrintController::class, 'printall'])->name('print.printpageall');

    Route::resource('printContainer', PrintContainerController::class);
    Route::get('printpagecontainer/{container_id}', [PrintContainerController::class, 'print'])->name('print.printpagecontainer');
    Route::get('printcontainerall', [PrintContainerController::class, 'printcontainerall'])->name('print.printcontainerall');

    Route::resource('printSendingItem', PrintSendingItemsController::class);
    Route::get('printSendingItemPage/{sendingItem_id}', [PrintSendingItemsController::class, 'print'])->name('print.printpageitem');
    Route::get('printSendingItemAll', [PrintSendingItemsController::class, 'printSendingItemAll'])->name('print.printallpageitem');

    // Route::get('doneOrder/{id}', [PreOrderController::class, 'done'])->name('doneOrder');
    // Route::get('cancelOrder/{id}', [PreOrderController::class, 'cancel'])->name('cancelOrder');

    Route::get('/logout', function () {
        Auth::logout();
        return Redirect::to('login');
    });

    Route::get('good_foto/{id}', [GoodController::class, 'getFoto']);
    Route::get('pengiriman_foto/{id}', [SendingItemsController::class, 'getFoto']);
    Route::get('container_foto/{id}', [ContainerController::class, 'getFoto']);

    Route::get('hapus_good_foto/{id}', [GoodController::class, 'hapusFoto']);
    Route::get('hapus_pengiriman_foto/{id}', [SendingItemsController::class, 'hapusFoto']);
    Route::get('hapus_container_foto/{id}', [ContainerController::class, 'hapusFoto']);
});



require __DIR__ . '/auth.php';
