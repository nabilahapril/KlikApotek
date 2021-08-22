<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('supplier.index', 'SupplierController@index')->name('supplier.index');
    Route::post('supplier.store', 'SupplierController@store')->name('supplier.store');
    Route::post('supplier.edits', 'SupplierController@edits')->name('supplier.edits');
    Route::post('supplier.updates', 'SupplierController@updates')->name('supplier.updates');
    Route::post('supplier.hapus', 'SupplierController@hapus')->name('supplier.hapus');

    Route::get('obat.index', 'ObatController@index')->name('obat.index');
    Route::post('obat.store', 'ObatController@store')->name('obat.store');
    Route::post('obat.edits', 'ObatController@edits')->name('obat.edits');
    Route::post('obat.updates', 'ObatController@updates')->name('obat.updates');
    Route::post('obat.hapus', 'ObatController@hapus')->name('obat.hapus');
    
    Route::get('stock.index', 'StockObatController@index')->name('stock.index');
    Route::post('stock.store', 'StockObatController@store')->name('stock.store');
    

    Route::resource('penjualan', 'PenjualanController');
    Route::get('penjualan.dataTable', 'PenjualanController@dataTable')->name('penjualan.dataTable');
    Route::post('penjualan.store', 'PenjualanController@store')->name('penjualan.store');
    Route::post('penjualan.hapus', 'PenjualanController@hapus')->name('penjualan.hapusOrder');
    Route::get('penjualan.datajual', 'PenjualanController@datajual')->name('penjualan.datajual');

    Route::post('pembayaran.store', 'PembayaranController@store')->name('simpanPenjualan');
    Route::get('/cetaknota', 'PenjualanController@cetakNota');
    Route::get('cetak','PenjualanController@cetak')->name('cetak');
    Route::get('/export_excel', 'PenjualanController@export_excel');


require __DIR__.'/auth.php';
