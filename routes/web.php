<?php

use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BlankPage;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\UserController;
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


Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/auth', [LoginController::class, 'authenticate'])->name('auth')->middleware('guest');

// admin
Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard')->middleware(['cekrole:admin']);
Route::get('/blank-page', [BlankPage::class, 'index'])->name('blank-page')->middleware(['cekrole:admin']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware(['cekrole:admin']);
Route::get('/dashboard/nominal_transaksi/', [Dashboard::class, 'nominal_transaksi'])->name('nominal_transaksi')->middleware(['cekrole:admin']);

// Data User
Route::get('/user', [UserController::class, 'index'])->name('user')->middleware(['cekrole:admin']);
Route::post('/user-insert-data', [UserController::class, 'insert_data'])->name('user.insert.data')->middleware(['cekrole:admin']);
Route::post('/user-edit-data', [UserController::class, 'edit'])->name('user.edit.data')->middleware(['cekrole:admin']);
Route::post('/user-update-data', [UserController::class, 'update'])->name('user.update.data')->middleware(['cekrole:admin']);
Route::post('/user-delete-data', [UserController::class, 'destroy'])->name('user.delete.data')->middleware(['cekrole:admin']);
Route::get('/data-peserta/cetak/{id}', [UserController::class, 'cetak'])->name('data.peserta.cetak')->middleware(['cekrole:admin']);
Route::get('/surat-pernyataan/cetak/{id}', [UserController::class, 'pernyataan'])->name('seruat.pernyataan.cetak')->middleware(['cekrole:admin']);

// Data User Admin
Route::get('/useradmin', [UserAdminController::class, 'index'])->name('useradmin')->middleware(['cekrole:admin']);
Route::post('/useradmin-insert-data', [UserAdminController::class, 'insert_data'])->name('useradmin.insert.data')->middleware(['cekrole:admin']);
Route::post('/useradmin-edit-data', [UserAdminController::class, 'edit'])->name('useradmin.edit.data')->middleware(['cekrole:admin']);
Route::post('/useradmin-update-data', [UserAdminController::class, 'update'])->name('useradmin.update.data')->middleware(['cekrole:admin']);
Route::post('/useradmin-delete-data', [UserAdminController::class, 'destroy'])->name('useradmin.delete.data')->middleware(['cekrole:admin']);

// Data Prdouk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk')->middleware(['cekrole:admin']);
Route::post('/produk-insert-data', [ProdukController::class, 'insert_data'])->name('produk.insert.data')->middleware(['cekrole:admin']);
Route::post('/produk-edit-data', [ProdukController::class, 'edit'])->name('produk.edit.data')->middleware(['cekrole:admin']);
Route::post('/produk-update-data', [ProdukController::class, 'update'])->name('produk.update.data')->middleware(['cekrole:admin']);
Route::post('/produk-delete-data', [ProdukController::class, 'destroy'])->name('produk.delete.data')->middleware(['cekrole:admin']);

// Data Customer
Route::get('/customer', [CustomerController::class, 'index'])->name('customer')->middleware(['cekrole:admin']);
Route::post('/customer-insert-data', [CustomerController::class, 'insert_data'])->name('customer.insert.data')->middleware(['cekrole:admin']);
Route::post('/customer-edit-data', [CustomerController::class, 'edit'])->name('customer.edit.data')->middleware(['cekrole:admin']);
Route::post('/customer-update-data', [CustomerController::class, 'update'])->name('customer.update.data')->middleware(['cekrole:admin']);
Route::post('/customer-delete-data', [CustomerController::class, 'destroy'])->name('customer.delete.data')->middleware(['cekrole:admin']);

// Data Barang Masuk
Route::get('/barang_masuk', [BarangMasukController::class, 'index'])->name('barang_masuk')->middleware(['cekrole:admin']);
Route::post('/barang_masuk-insert-data', [BarangMasukController::class, 'insert_data'])->name('barang_masuk.insert.data')->middleware(['cekrole:admin']);
Route::post('/barang_masuk-delete-data', [BarangMasukController::class, 'destroy'])->name('barang_masuk.delete.data')->middleware(['cekrole:admin']);
Route::post('/topup-user-card-select', [BarangMasukController::class, 'getUserCard'])->name('topup.usercard.select')->middleware(['cekrole:admin']);
Route::post('/produk-user-card-select', [BarangMasukController::class, 'getProduk'])->name('produk.usercard.select')->middleware(['cekrole:admin']);

// Data Barang Keluar
Route::get('/barang_keluar', [BarangKeluarController::class, 'index'])->name('barang_keluar')->middleware(['cekrole:admin']);
Route::post('/barang_keluar-insert-data', [BarangKeluarController::class, 'insert_data'])->name('barang_keluar.insert.data')->middleware(['cekrole:admin']);
Route::post('/barang_keluar-delete-data', [BarangKeluarController::class, 'destroy'])->name('barang_keluar.delete.data')->middleware(['cekrole:admin']);
Route::post('/barang_keluarku-user-card-select', [BarangKeluarController::class, 'getUserCard'])->name('barang_keluarku.usercard.select')->middleware(['cekrole:admin']);
Route::post('/barang_keluar-user-card-select', [BarangKeluarController::class, 'getProduk'])->name('barang_keluar.usercard.select')->middleware(['cekrole:admin']);
Route::post('/cust-user-card-select', [BarangKeluarController::class, 'getCust'])->name('cust.usercard.select')->middleware(['cekrole:admin']);
Route::post('/custku-user-card-select', [BarangKeluarController::class, 'getCustku'])->name('custku.usercard.select')->middleware(['cekrole:admin']);